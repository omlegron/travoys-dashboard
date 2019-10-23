<?php

namespace App\Imports\KelolaData\Proyeksi;

use App\Models\KelolaData\OutflowProyeksi;
use App\Models\KelolaData\InflowProyeksi;
use App\Models\KelolaData\Eku;
use App\Models\KelolaData\KasMinimum;
use App\Models\KelolaData\PecahanProyeksi;
use App\Models\KelolaData\PemusnahanProyeksi;
use App\Models\Master\Pecahan;
use App\Models\Master\Satker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Carbon\Carbon;

class ProyeksiImport implements ToCollection, WithCalculatedFormulas
{

    public function collection(Collection $rows)
    {
        $satker = Satker::where('name', $rows[0][0])->first();
        if($rows[0][0] == 'NASIONAL'){
            $satker = 'NASIONAL';
        }
        if($satker !== null){
            $index       = 0;
            $tanggal     = NULL;
            $pecahan     = Pecahan::get();
            $header_type = $rows[4];
            $header_peca = $rows[5];

            //GET PECAHAN ID
            $get_pecahan = [];
            foreach ($pecahan as $key => $val) {
                $get_pecahan[$val->label][substr($val->type,-1)] = $val->id;
            }

            $header_pecahan = [];
            $h = "";
            foreach($header_peca as $key => $pec){
                if($pec !== null && $pec !== "UK+UL"){
                    if($header_type[$key] =="Uang Kertas"){
                        $h='k';
                    }
                    if($header_type[$key] =="Uang Logam"){
                        $h='l';
                    }   
                    $header_pecahan[] = [
                        'val' => number_format($pec,0,',','.'),
                        'type' => $h 
                    ];
                }
            }

            // dd($header_pecahan);

            $month = [
                'January', 
                'February', 
                'March', 
                'April', 
                'May', 
                'June', 
                'July', 
                'August', 
                'September', 
                'October', 
                'November', 
                'December'];

            $tw   = [ "TW-1", "TW-2", "TW-3", "TW-4"];
            //Pecahan

            // Output
            $header = "";
            foreach ($rows as $out) {
                // dump($out);
                if($out[5] == "( PER PECAHAN )"){
                    if(!in_array($out[0], $tw) && $out[0] !== "Jumlah"){
                        $header = ($out[0]);
                    }
                }

                if(in_array($out[0], $month)){
                    $item = [];
                    $i=1;
                    foreach($header_pecahan as $v) { 
                        $item['val'][]        = $out[$i];
                        $item['tahun'][]      = substr($rows[0][13],0,4);
                        $item['bulan'][]      = moonToInt($out[0]);
                        $item['pecahan_id'][] = $get_pecahan[$v['val']][$v['type']];
                        $i++;
                    }
                         // dd($get_pecahan[$v['val']][$v['type']]);
                    $output[$header]['satker_id']     = ($satker == 'NASIONAL') ? null : $satker->id; 
                    $output[$header]['nasional']      = ($satker == 'NASIONAL') ? true : false; 
                    $output[$header]['item'][]        = $item; 
                } 
                // else
                if($header == "KAS MINIMUM"){
                    if($out[0] == 'Jumlah'){
                        // dd($header);
                        $item = [];
                        $i=1;
                        foreach ($header_pecahan as $v) { 
                            $item['val'][]        = $out[$i];
                            $item['tahun'][]      = substr($rows[0][13],0,4);
                            $item['bulan'][]      = moonToInt($out[0]);
                            $item['pecahan_id'][] = $get_pecahan[$v['val']][$v['type']];
                            $i++;
                        }
                        $output[$header]['satker_id']     = ($satker == 'NASIONAL') ? null : $satker->id; 
                        $output[$header]['nasional']      = ($satker == 'NASIONAL') ? true : false; 
                        $output[$header]['item'][]        = $item;

                    }
                }
            }

            // dd($output);

            foreach ($output as $key => $val) {
                $x = [];
                switch ($key) {
                    case 'PROYEKSI OUTFLOW':
                        foreach ($val['item'] as $keys => $value) {
                            foreach ($value['bulan'] as $k => $item) {
                                $cek = OutflowProyeksi::where('tahun',substr($rows[0][13],0,4))
                                ->where('bulan',$value['bulan'][$k])
                                ->where('satker_id',$val['satker_id'])
                                ->where('pecahan_id',$value['pecahan_id'][$k])->first();

                                $x['tahun']      = substr($rows[0][13],0,4);
                                $x['bulan']      = $value['bulan'][$k];
                                $x['nasional']   = $val['nasional'];
                                $x['satker_id']  = $val['satker_id'];
                                $x['pecahan_id'] = $value['pecahan_id'][$k];
                                $x['value']      = ($value['val'][$k]);
                                if($cek !== null){
                                    $cek->fill($x);
                                    $cek->save();
                                }else{
                                    OutflowProyeksi::create($x);
                                }
                            }
                        }
                        break;
                    case 'KAS MINIMUM':
                        foreach ($val['item'] as $keys => $value) {
                            foreach ($value['bulan'] as $k => $item) {
                                $cek = KasMinimum::where('tahun',substr($rows[0][13],0,4))
                                ->where('satker_id',$val['satker_id'])
                                ->where('pecahan_id',$value['pecahan_id'][$k])->first();

                                $x['tahun']      = substr($rows[0][13],0,4);
                                $x['bulan']      = $value['bulan'][$k];
                                $x['nasional']   = $val['nasional'];
                                $x['satker_id']  = $val['satker_id'];
                                $x['pecahan_id'] = $value['pecahan_id'][$k];
                                $x['value']      = ($value['val'][$k]);
                                if($cek !== null){
                                    $cek->fill($x);
                                    $cek->save();
                                }else{
                                    KasMinimum::create($x);
                                }
                            }
                        }
                        break;
                    case 'PROYEKSI INTFLOW':
                        foreach ($val['item'] as $keys => $value) {
                            foreach ($value['bulan'] as $k => $item) {
                                $cek = InflowProyeksi::where('tahun',substr($rows[0][13],0,4))
                                ->where('bulan',$value['bulan'][$k])
                                ->where('satker_id',$val['satker_id'])
                                ->where('pecahan_id',$value['pecahan_id'][$k])->first();

                                $x['tahun']      = substr($rows[0][13],0,4);
                                $x['bulan']      = $value['bulan'][$k];
                                $x['nasional']   = $val['nasional'];
                                $x['satker_id']  = $val['satker_id'];
                                $x['pecahan_id'] = $value['pecahan_id'][$k];
                                $x['value']      = ($value['val'][$k]);
                                if($cek !== null){
                                    $cek->fill($x);
                                    $cek->save();
                                }else{
                                    InflowProyeksi::create($x);
                                }
                            }
                        }
                        break;
                    case 'PROYEKSI PEMUSNAHAN':
                        foreach ($val['item'] as $keys => $value) {
                            foreach ($value['bulan'] as $k => $item) {
                                $cek = PemusnahanProyeksi::where('tahun',substr($rows[0][13],0,4))
                                ->where('bulan',$value['bulan'][$k])
                                ->where('satker_id',$val['satker_id'])
                                ->where('pecahan_id',$value['pecahan_id'][$k])->first();

                                $x['tahun']      = substr($rows[0][13],0,4);
                                $x['bulan']      = $value['bulan'][$k];
                                $x['nasional']   = $val['nasional'];
                                $x['satker_id']  = $val['satker_id'];
                                $x['pecahan_id'] = $value['pecahan_id'][$k];
                                $x['value']      = ($value['val'][$k]);
                                if($cek !== null){
                                    $cek->fill($x);
                                    $cek->save();
                                }else{
                                    PemusnahanProyeksi::create($x);
                                }
                            }
                        }
                        break;
                    case 'EKU':
                        foreach ($val['item'] as $keys => $value) {
                            foreach ($value['bulan'] as $k => $item) {
                                $cek = Eku::where('tahun',substr($rows[0][13],0,4))
                                ->where('bulan',$value['bulan'][$k])
                                ->where('satker_id',$val['satker_id'])
                                ->where('pecahan_id',$value['pecahan_id'][$k])->first();

                                $x['tahun']      = substr($rows[0][13],0,4);
                                $x['bulan']      = $value['bulan'][$k];
                                $x['nasional']   = $val['nasional'];
                                $x['satker_id']  = $val['satker_id'];
                                $x['pecahan_id'] = $value['pecahan_id'][$k];
                                $x['value']      = ($value['val'][$k]);
                                if($cek !== null){
                                    $cek->fill($x);
                                    $cek->save();
                                }else{
                                    Eku::create($x);
                                }
                            }
                        }
                        break;
                    
                }
            }
        }
    }
}