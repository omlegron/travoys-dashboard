<?php

namespace App\Imports;

use App\Models\KelolaData\PosisiKas;
use App\Models\KelolaData\PosisiKasFile;
use App\Models\Master\KodePecahan;
use App\Models\Master\Satker;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class PosisiKasImport implements ToModel, WithChunkReading, WithProgressBar //, WithBatchInserts
{
    use Importable;

    private $file;
    private $tanggal     = null;
    private $startRow    = 5;
    private $currentRow  = 0;
    private $heading     = null;
    private $headingRow  = 4;
    private $pecahan     = null;
    private $satker      = null;
    private $rekening    = null;
	private $rekenings 	 = ['010', '011', '012.000', '012.001', '013.000', '013.001', '013.002', '014'];

    public function __construct(PosisiKasFile $file)
    {
        $this->file = $file;
        $this->pecahan = KodePecahan::pluck('code', 'id')->toArray();
        $this->satker = Satker::pluck('name', 'id')->toArray();
    }

    public function model(array $row)
    {
        $this->currentRow++;
        if(is_null($this->rekening)){
            $this->rekening = $row[0];
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
                        // if(!is_null($value)){
                            $model[] = new PosisiKas([
                                'tanggal' => $this->tanggal,
                                'satker_id' => $satker,
                                'kode_pecahan_id' => $pecahan,
                                'value' => $value,
                                'rekening' => $this->rekening
                            ]);
                        // }
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
    //     return 2;
    // }
    
    public function chunkSize(): int
    {
        return 5000;
    }
}