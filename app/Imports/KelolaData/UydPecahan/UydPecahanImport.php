<?php

namespace App\Imports\KelolaData\UydPecahan;

use App\Models\KelolaData\UydPecahan;
use App\Models\Master\Pecahan;
use App\Models\Master\Satker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class UydPecahanImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        $index = 0;
        $tanggal = NULL;
        $coloum = $rows[1];



        //KATEGORI
        $uang          = $rows[0];
        $colum_kategori = [];
        $kategori      = "";
        foreach ($uang as $key => $pec) {
            if($pec !== 'Tanggal'){
                if($pec !== null){
                    $kategori = $pec;
                }
                $colum_kategori[]=[
                    'label'    => $rows[1][$key],
                    'kategori' => $kategori == "Uang Kertas" ? 'k' : 'l',
                ];
            }
        }

        //PECAHAN ID
        $pecahan = Pecahan::get();
        $colum_pecahan = [];
        foreach ($pecahan as $key => $pec) {
            $colum_pecahan[$pec->label][substr($pec->type,-1)] = $pec->id;
        }

        // 
        $temp = [];
        foreach ($rows as $row) 
        {
            if($row[0] !== null and $row[0] !=="Tanggal"){
                $tanggal = Carbon::createFromFormat('d-M-Y',$row[0]);
                $idx = 0;
                foreach ($colum_kategori as $kode) {

                    $cek = UydPecahan::where('tanggal',$tanggal->format('Y-m-d'))->where('pecahan_id',$colum_pecahan[$kode['label']][$kode['kategori']])->first();

                    $x['tanggal']   = $tanggal->format('Y-m-d');
                    $x['pecahan_id']= $colum_pecahan[$kode['label']][$kode['kategori']] ;
                    $x['value']     = (float)((int) $row[$idx]);
                    if($cek){
                        $cek->fill($x);
                        $cek->save();
                    }else{
                        UydPecahan::create($x);
                    }
                    $idx++;
                }
            }
        }
    }
}