<?php

namespace App\Imports;

use App\Models\KelolaData\UangPalsu;
use App\Models\KelolaData\UangPalsuFile;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class UangPalsuImport implements ToModel, WithChunkReading, WithProgressBar //, WithBatchInserts
{
    use Importable;

    private $file;
    private $month       = null;
    private $startRow    = 2;
    private $currentRow  = 0;
    private $heading     = null;
    private $headingRow  = 1;

    public function __construct(UangPalsuFile $file)
    {
        $this->file = $file;
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
                    $date = Carbon::createFromFormat('Y-m', $row[0]);
                    $this->month = $row[0];
                }
            } catch (\Exception $e){
                $this->month = null;
                return null;
            }

            if(!is_null($this->month)){
                $model = [];

                foreach ($row as $key => $value) {
                    $region  = $this->heading[$key];
                    if($region != 'Bulan' && $region != 'Total' && !is_null($value)){
                        $model[] = new UangPalsu([
                            'bulan_tahun' => $this->month,
                            'region' => $region,
                            'value' => $value,
                        ]);
                    }
                }

                return $model;
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