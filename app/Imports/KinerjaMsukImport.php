<?php

namespace App\Imports;

use App\Models\KelolaData\KinerjaMsuk;
use App\Models\KelolaData\KinerjaMsukFile;
use App\Models\Master\Pecahan;
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

class KinerjaMsukImport implements ToModel, WithHeadingRow, WithChunkReading, WithProgressBar //, WithBatchInserts
{
    use Importable;

    private $file;
    private $pecahan    = null;
    private $satker     = null;
    private $rows       = null;

    public function __construct(KinerjaMsukFile $file)
    {
        $this->file    = $file;
        $this->satker  = Satker::pluck('name', 'id')->toArray();
        $this->pecahan = Pecahan::pluck('label', 'id')->toArray();
        $this->rows    = [100000, 50000, 20000, 10000, 5000, 2000];
    }

    public function model(array $row)
    {
        $satker = array_search($row['KPwBI'], $this->satker);
        if(is_null($satker)) return null;

        try{
            $bulan  = Carbon::createFromFormat('F', $row['Bulan']);
        } catch (\Exception $e){
            return null;
        }

        $model = [];
        foreach ($this->rows as $key) {
            if($row[$key] != 0){
                $pecahan = array_search(number_format($key, 0, ',', '.'), $this->pecahan);
                $model[] = new KinerjaMsuk([
                    'satker_id'  => $satker,
                    'pecahan_id' => $pecahan,
                    'type'  => $row['TYPE'] ?: 'HS',
                    'msuk'  => $row['MSUK'],
                    'bulan' => (int) $bulan->format('m'),
                    'tahun' => (int) $row['Tahun'],
                    'value' => (int) $row[$key]
                ]);
            }
        }

        return $model;
    }
    
    public function chunkSize(): int
    {
        return 5000;
    }
}