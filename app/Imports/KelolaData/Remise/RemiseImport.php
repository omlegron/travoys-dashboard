<?php

namespace App\Imports\KelolaData\Remise;


use App\Models\Master\Pecahan;
use App\Models\Master\Satker;
use App\Models\KelolaData\Remise;
use App\Models\KelolaData\RemiseStandar;
use App\Models\KelolaData\RemiseContainer;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use App\Models\Master\KodePecahan;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Carbon\Carbon;

class RemiseImport implements ToCollection
{

	public function collection(Collection $rows)
	{
		try {
			$row = $rows->toArray();

			$satker = Satker::get();
			$satker_array = [];
			foreach ($satker as $key => $val) {
				$satker_array[$val->abbrev] = $val->id; 
			}

			$temp = [];

			$sarana_angkut = [
						'LORI',
						'TRUK-KP',
						'TRUK-KBI',
						'TRUK-FERRY',
						'TRUK-FERRY-KA',
						'KAPAL-KONAINER',
						'KAPAL-PALKA',
						'KAPAL-SIL',
						'KAPAL-FPS',
						'LAINNYA',
						'KERETA-API',
						'PESAWAT-UDARA'
			];

			// Array 
			foreach ($row as $key => $val) {
				if($key > 6 ){
						// dd($tanggal->format('Y-m-d'));
						$values = [];
						foreach ($val as $keys => $v) {
								if($keys == 0){
										$tanggal = Date::excelToDateTimeObject($v);
										$values[] = $tanggal->format('Y-m-d');
								} else{
										$values[] = $v;
								}
						}
						$temp[] = $values;
				}
			}


			// Grouping Table 
			 
			$data  = [];
			foreach ($temp as $k => $val) {
						$data[$k]['tanggal']      = $val[0];
						$data[$k]['satker_label'] = strtolower($val[1]);
						$data[$k]['nama_sarana']  = $val[2];
						$data[$k]['tpu']          = $val[15];
						foreach ($val as $keys => $rows) {
								if($keys>=3 and $keys<=14){
										$data[$k]['remise'][] = (integer)$rows;
								}else if($keys>=17 and $keys<=45){
										$data[$k]['remise_standar']['pecahan'][]     = $row[4][$keys];
										$data[$k]['remise_standar']['tahun_emisi'][] = $row[5][$keys];
										$data[$k]['remise_standar']['nilai'][]       = (integer)$rows;
								}else if($keys>=47 and $keys<=75){
										$data[$k]['remise_container']['pecahan'][]     = $row[4][$keys];
										$data[$k]['remise_container']['tahun_emisi'][] = $row[5][$keys];
										$data[$k]['remise_container']['nilai'][]       = (integer)$rows;
								}
						}
			}

			 //Insert To table
			$output_remise = [];
			foreach ($data as $k => $val_row) {
				if($val_row['tanggal'] !== '1970-01-01'){

					$ar = 100;
					foreach ($val_row['remise'] as $key => $re) {
							if($re == 1){
									$ar = $key;
							}
					}
					$output_remise[$k]['tanggal']       = (string)$val_row['tanggal'];
					$output_remise[$k]['satker_id']     = isset($satker_array[$val_row['satker_label']])?$satker_array[$val_row['satker_label']]:NULL;
					$output_remise[$k]['satker_label']  = (string)$val_row['satker_label'];
					$output_remise[$k]['nama_sarana']   = (string)$val_row['nama_sarana'];
					$output_remise[$k]['sarana_angkut'] = (string)(isset($sarana_angkut[$ar])?$sarana_angkut[$ar]:0);
					$output_remise[$k]['tpu']           = (string)$val_row['tpu']!==0?$val_row['tpu']:NULL;

					//Input Remise
					 
					$remise = Remise::where('tanggal', $output_remise[$k]['tanggal'])->where('satker_id', $output_remise[$k]['satker_id'])
										->where('satker_label', $output_remise[$k]['satker_label'])
										->where('nama_sarana', $output_remise[$k]['nama_sarana'])->first();
					if($remise){
						$remise->sarana_angkut = $output_remise[$k]['sarana_angkut'];
						$remise->tpu           = $output_remise[$k]['tpu'];
						$remise->save();
					}else{
						$remise = Remise::create($output_remise[$k]);
					}

					// Remise Standar
					foreach ($val_row['remise_standar']['pecahan'] as $key => $rs_row) {
						// dd($val_row['remise_standar']['pecahan'][$key]);
						if((string)$val_row['remise_standar']['pecahan'][$key] !== 'Jumlah UK' and (string)$val_row['remise_standar']['pecahan'][$key] !== 'Jumlah UL' and $val_row['remise_standar']['pecahan'][$key] !== 'Jumlah'){

							$v_pecahan = $val_row['remise_standar']['pecahan'][$key];
							$v_tahun   = $val_row['remise_standar']['tahun_emisi'][$key];

							//Cari Kode Pecahan
							$pecahan   = KodePecahan::with('pecahan','tahun')
							->whereHas('pecahan', function($q) use($v_pecahan){
									$q->where('label', $v_pecahan);
							})
							->whereHas('tahun', function($q) use($v_tahun){
									$tahun = substr($v_tahun,-4);
									$q->where('year', $tahun);
							})
							->first();

							if($pecahan && $val_row['remise_standar']['nilai'][$key] !== 0){
								$data_remise_setandar = [
									'remise_id'       => $remise->id,
									'kode_pecahan_id' => $pecahan->id,
									'value'           => $val_row['remise_standar']['nilai'][$key],
								];
								$cek_remise_standar = RemiseStandar::where('remise_id', $remise->id)->where('kode_pecahan_id', $pecahan->id)->first();
								if($cek_remise_standar){
									$cek_remise_standar->value = $val_row['remise_standar']['nilai'][$key]; 
									$cek_remise_standar->save();
								}else{
									RemiseStandar::create($data_remise_setandar);
								}
							}
						}
					}

					// Remise Cantainer
					foreach ($val_row['remise_container']['pecahan'] as $key => $rc_row) {
						if((string)$val_row['remise_container']['pecahan'][$key] !== 'Jumlah UK' and (string)$val_row['remise_container']['pecahan'][$key] !== 'Jumlah UL' and $val_row['remise_container']['pecahan'][$key] !== 'Jumlah'){

							$v_pecahan = $val_row['remise_container']['pecahan'][$key];
							$v_tahun   = $val_row['remise_container']['tahun_emisi'][$key];

							//Cari Kode Pecahan
							$pecahan   = KodePecahan::with('pecahan','tahun')
							->whereHas('pecahan', function($q) use($v_pecahan){
									$q->where('label', $v_pecahan);
							})
							->whereHas('tahun', function($q) use($v_tahun){
									$tahun = substr($v_tahun,-4);
									$q->where('year', $tahun);
							})
							->first();

							if($pecahan && $val_row['remise_container']['nilai'][$key] !== 0){
								$data_remise_container = [
									'remise_id'       => $remise->id,
									'kode_pecahan_id' => $pecahan->id,
									'value'           => $val_row['remise_container']['nilai'][$key],
								];
								$cek_remise_container = RemiseContainer::where('remise_id', $remise->id)->where('kode_pecahan_id', $pecahan->id)->first();
								if($cek_remise_container){
									$cek_remise_container->value = $val_row['remise_container']['nilai'][$key]; 
									$cek_remise_container->save();
								}else{
									RemiseContainer::create($data_remise_container);
								}
							}
						}
					}		
				}
			}	
		} catch (Exception $e) {
			dd('data tidak temukan');
		}
	}
}
