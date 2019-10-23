<?php

namespace App\Imports\KelolaData\Uyd;

use App\Models\KelolaData\Uyd;
use App\Models\Master\KodePecahan;
use App\Models\Master\Satker;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class UydImport implements ToModel, WithChunkReading, WithProgressBar //WithBatchInserts, 
{
    use Importable;

    public function model(array $row)
    {
        try {
            return new Uyd([
                'tanggal' => $row[0],
                'uyd' => $row[1],
                'cob' => $row[2],
                'civ' => $row[3]
            ]);
        } catch (\Exception $e) {
            return null;
        }

    }

    public function chunkSize(): int
    {
        return 4000;
    }

    // public function collection(Collection $rows)
    // {
    //     // $column = $rows[1];
    //     //     // var_dump($rows[0]);
    //     // foreach ($rows as $row) 
    //     // {
    //     //     foreach ($column as $data) {  
    //     //     // var_dump($data);
    //     //         if(!is_null($data)){
    //     //             $cek = Uyd::where('tanggal',$row[0])->first();
    //     //             if ($cek) {
    //     //                 if(!is_null($row[0])){
    //     //                     Uyd::create([
    //     //                         'tanggal' => $row[0],
    //     //                         'uyd'     => $row[1],
    //     //                         'cob'     => $row[2],
    //     //                         'civ'     => $row[3],
    //     //                     ]);
    //     //                 }
    //     //             }
    //     //         }
    //     //     }
    //     // }
        
    //     $index = 0;
    //     $tanggal = NULL;
    //     $coloum = $rows[2];
    //     // dd($rows[1]);
    //     foreach ($rows as $row) 
    //     {
    //     // dd($row[0]);
    //         if($row[0] !== null and $row[0] !=="Tanggal"){
    //             $tanggal = Carbon::createFromFormat('d-M-Y',$row[0]);
    //         // if($index>=3){
    //             // if(!is_null($row[0]) && !is_null($row[1])){
    //             //     if((int) $row[0] > 0){
    //             //         $tanggal = Carbon::createFromFormat('d-M-Y',$row[0])->format('Y-m-d');
    //             //     }
    //             // }
    //             // if(!is_null($tanggal) && !is_null($row[1])){
    //                 $idx = 1;
    //                 foreach ($coloum as $kode) {
    //                     if(!is_null($kode)){
    //                         // if(substr(strtolower($kode),0,1) == 'l' || substr(strtolower($kode),0,1) == 'k' ){
    //                             // $satker = Satker::where('name','like','%'.$row[1].'%')->first();
    //                             // $kodepecahan = KodePecahan::where('code','like','%'.$kode.'%')->first();
    //                             // if($satker){
    //                                 // if($kodepecahan){
    //             // dd((float)((int) $row[$idx = 1]));
    //                                     $cek = Uyd::where('tanggal',$tanggal->format('Y-m-d'))->first();

    //                                         $x['tanggal'] = $tanggal->format('Y-m-d');
    //                                         $x['uyd'] = $row[$idx];
    //                                         $x['cob'] = (float)((int) $row[$idx = 2]);
    //                                         $x['civ'] = (float)((int) $row[$idx = 3]);
    //                                     if($cek){
    //                                         $cek->fill($x);
    //                                         $cek->save();
    //                                     }else{
    //                                         // dd($x);
    //                                         Uyd::create($x);
    //                                     }
    //                                 // }
    //                             // }
    //                         // }
    //                     }
    //                     $idx++;
    //                 }
    //             // }
    //         // }
    //         // $index++;
    //         }
    //     }
    // }
}