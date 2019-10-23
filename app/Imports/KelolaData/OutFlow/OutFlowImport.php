<?php

namespace App\Imports\KelolaData\Outflow;

use App\Models\KelolaData\Outflow;
use App\Models\Master\KodePecahan;
use App\Models\Master\Satker;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class OutflowImport implements ToModel, WithChunkReading, WithProgressBar
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
    private $categories  = ['Kas Keliling Keluar', 'Kas Titipan Keluar', 'Bayaran Bank', 'Bayaran Nonbank', 'Penukaran Keluar'];


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
                // $satker = $this->satker->where('name', $row[1])->first();
                $satker = array_search($row[1], $this->satker);

                if($satker){
                    foreach ($row as $code => $value) {
                        // $pecahan = $this->pecahan->where('code', $this->heading[$code])->first();
                        $pecahan = array_search($this->heading[$code], $this->pecahan);

                        if($pecahan && (!is_null($value) && $value > 0)){
                            array_push($model, new Outflow([
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
    
    public function chunkSize(): int
    {
        return 4000;
    }
}