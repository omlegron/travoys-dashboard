<?php

namespace App\Imports\KelolaData\Survei;


use App\Models\Master\Pecahan;
use App\Models\KelolaData\Survei;
use App\Models\Master\Satker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Carbon\Carbon;

class SurveiImport implements ToCollection, WithCalculatedFormulas
{

    public function collection(Collection $rows)
    {
    	// Satker
    	$satker = Satker::get();
    	$t_satker=[];
    	foreach ($satker as $key => $val) {
    		$t_satker[$val->name] = $val->id;
    	}

    	// Semester
    	$sem = ['SM I' => 1 , 'SM II' => 2];
    	//	Header
    	$smester = [];
    	$kategory = "";
    	$tahun = "";
    	foreach ($rows[2] as $key => $value) {
    		if($key !== 0){
    			if($rows[0][$key]){
    				$kategory = $rows[0][$key];
    			};
    			if($rows[1][$key]){
    				$tahun = $rows[1][$key];
    			};
	    		$smester[] = [
					'kategory' => $kategory,
					'tahun'    => $tahun,
					'smester'  => $value,
	    		];
    		}
    	}
        // dd($smester);

    	//Content
    	$temp_content = [];
    	foreach ($rows as $key => $content) {
    		if($key !== 0 and $key !== 1 and $key !== 2){
    			if(isset($t_satker[$content[0]]) and  $content[0] !== 'Nasional'){			
	    			foreach ($smester as $keys => $val) {
                        $temp_content[$key][$keys]['satker_id'] = $t_satker[$content[0]];
                        $temp_content[$key][$keys]['nasional']  = 0;
                        $temp_content[$key][$keys]['type']      = $val['kategory'];
                        $temp_content[$key][$keys]['tahun']     = substr($val['tahun'], 0, 4);
                        $temp_content[$key][$keys]['semester']  = $sem[$val['smester']];
                        $temp_content[$key][$keys]['value']     = $content[$keys+1];
	    			}
    			}else if($content[0] == 'Nasional'){
                    foreach ($smester as $keys => $val) {
                        $temp_content[$key][$keys]['satker_id'] =  NULL;
                        $temp_content[$key][$keys]['nasional']  =  1;
                        $temp_content[$key][$keys]['type']      = $val['kategory'];
                        $temp_content[$key][$keys]['tahun']     = substr($val['tahun'], 0, 4);
                        $temp_content[$key][$keys]['semester']  = $sem[$val['smester']];
                        $temp_content[$key][$keys]['value']     = $content[$keys+1];
                    }   
                }
    		}
    	} 
        // dd($temp_content);
    	foreach ($temp_content as $val) {
    		foreach ($val as $value) {
    			Survei::create($value);
    		}
    	}
    }
}