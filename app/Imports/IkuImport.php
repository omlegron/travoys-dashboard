<?php

namespace App\Imports;

use App\Models\KelolaData\Iku;
use App\Models\KelolaData\IkuFile;
use App\Models\Master\Kdk;
use App\Models\Master\Pecahan;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class IkuImport implements ToModel, WithHeadingRow, WithChunkReading, WithProgressBar, WithCalculatedFormulas //, WithBatchInserts
{
    use Importable;

    private $file;
    private $pecahan    = null;
    private $kdk     = null;
    private $rows       = null;

    public function __construct(IkuFile $file)
    {
        $this->file    = $file;
        $this->kdk     = Kdk::pluck('name', 'id')->toArray();
        $this->pecahan = Pecahan::pluck('code', 'id')->toArray();
        $this->rows    = ['Y', 'X', 'W', 'V', 'U', 'T', 'S', 'LS', 'LR', 'Q', 'LP', 'O'];
    }

    public function model(array $row)
    {
        $kdk = array_search($row['KDK'], $this->kdk);
        if(!$kdk) return null;

        try{
            $bulan  = Carbon::parse($row['Bulan']);
        } catch (\Exception $e){
            return null;
        }

        $model = [];
        foreach ($this->rows as $key) {
            if($row[$key] != 0){
                $pecahan = array_search($key, $this->pecahan);
                $model[] = new Iku([
                    'bulan' => $bulan->format('n'),
                    'tahun' => $bulan->format('Y'),
                    'kdk_id'  => $kdk,
                    'pecahan_id' => $pecahan,
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