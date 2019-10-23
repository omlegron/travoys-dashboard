<?php

namespace App\Imports\KelolaData\Inflow;

use App\Models\KelolaData\Inflow;
use App\Models\Master\KodePecahan;
use App\Models\Master\Satker;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class InflowImport implements ToModel, WithChunkReading, WithProgressBar //WithBatchInserts, 
{
    use Importable;

    private $tanggal     = null;
    private $startRow    = 5;
    private $currentRow  = 0;
    private $heading     = null;
    private $headingRow  = 4;
    private $pecahan     = null;
    private $satker      = null;
    private $category    = null;
    private $categories  = ['Kas Keliling Masuk', 'Kas Titipan Masuk', 'Penukaran Masuk', 'Setoran Bank'];

    public function __construct()
    {
        $this->pecahan = KodePecahan::pluck('code', 'id')->toArray();
        $this->satker = Satker::pluck('name', 'id')->toArray();
    }

    public function model(array $row)
    {
        $this->currentRow++;
        if(is_null($this->category)){
            $this->category = array_search($row[0], $this->categories);
        }

        $model = [];
        if($this->currentRow == $this->headingRow){
            $this->heading = $row;
        }
        if($this->currentRow >= $this->startRow)
        {
            try{
                if(!is_null($row[0])){
                    $date = Carbon::createFromFormat('d-M-Y', $row[0]);
                    $this->tanggal = $row[0];
                }
            } catch (\Exception $e){
                $this->tanggal = null;
                return null;
            }

            if(!is_null($this->tanggal)){
                $satker = array_search($row[1], $this->satker);
                // $satker = $this->satker->where('name', $row[1])->first();

                if($satker){
                    foreach ($row as $code => $value) {
                        $pecahan = array_search($this->heading[$code], $this->pecahan);
                        // $pecahan = $this->pecahan->where('code', $this->heading[$code])->first();
                        if($pecahan && (!is_null($value) && $value > 0)){
                            array_push($model, new Inflow([
                                'tanggal' => $this->tanggal,
                                'satker_id' => $satker,
                                'kode_pecahan_id' => $pecahan,
                                'value' => $value,
                                'category' => $this->category
                            ]));
                        }
                    }
                }

                return count($model) > 0 ? $model : null;
            }
        }

        return null;
    }
    
    // public function batchSize(): int
    // {
    //     return 100;
    // }
    
    public function chunkSize(): int
    {
        return 4000;
    }

    // public function collection(Collection $rows)
    // {
    //     $index = 0;
    //     $tanggal = NULL;
    //     $pecahan = $rows[2];
        
    //     foreach ($rows as $row) 
    //     {
    //         if($index>=3){
    //             if(!is_null($row[0]) && !is_null($row[1])){
    //                 if((int) $row[0] > 0){
    //                     $tanggal = Carbon::createFromFormat('d-M-Y',$row[0])->format('Y-m-d');
    //                 }
    //             }
    //             if(!is_null($tanggal) && !is_null($row[1])){
    //                 $idx = 0;
    //                 foreach ($pecahan as $kode) {
    //                     if(!is_null($kode)){
    //                         if(substr(strtolower($kode),0,1) == 'l' || substr(strtolower($kode),0,1) == 'k' ){
    //                             $satker = Satker::where('name','like','%'.$row[1].'%')->first();
    //                             $kodepecahan = KodePecahan::where('code','like','%'.$kode.'%')->first();
    //                             if($satker){
    //                                 if($kodepecahan){
    //                                     $cek = Inflow::where('tanggal',$tanggal)->where('satker_id',$satker->id)->where('kode_pecahan_id',$kodepecahan->id)->first();

    //                                         $x['tanggal'] = $tanggal;
    //                                         $x['satker_id'] = $satker->id;
    //                                         $x['kode_pecahan_id'] = $kodepecahan->id;
    //                                         $x['value'] = (float)((int) $row[$idx]);
    //                                     if($cek){
    //                                         $cek->fill($x);
    //                                         $cek->save();
    //                                     }else{
    //                                         Inflow::create($x);
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                     $idx++;
    //                 }
    //             }
    //         }
    //         $index++;
    //     }
    // }
}