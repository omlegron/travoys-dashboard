<?php

namespace App\Imports\KelolaData\Pemusnahan;

use App\Models\KelolaData\Pemusnahan;
use App\Models\Master\KodePecahan;
use App\Models\Master\Satker;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class PemusnahanImport implements ToModel, WithChunkReading, WithProgressBar //WithBatchInserts, 
{
    use Importable;

    private $tanggal     = null;
    private $startRow    = 4;
    private $currentRow  = 0;
    private $heading     = null;
    private $headingRow  = 3;
    private $pecahan     = null;
    private $satker      = null;

    public function __construct()
    {
        $this->pecahan = KodePecahan::pluck('code', 'id')->toArray();
        $this->satker = Satker::pluck('name', 'id')->toArray();
    }

    public function model(array $row)
    {
        $this->currentRow++;

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
                            array_push($model, new Pemusnahan([
                                'tanggal' => $this->tanggal,
                                'satker_id' => $satker,
                                'kode_pecahan_id' => $pecahan,
                                'value' => $value,
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
}