<?php

namespace App\Imports;

use App\Models\KelolaData\KasTitipan;
use App\Models\KelolaData\KasTitipanFile;
use App\Models\Master\KasTitipan as Reference;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class KasTitipanImport implements ToModel, WithChunkReading, WithProgressBar //, WithBatchInserts
{
    use Importable;

    private $file;
    private $tanggal     = null;
    private $startRow    = 2;
    private $currentRow  = 0;
    private $heading     = null;
    private $headingRow  = 1;
    private $kastip      = null;

    public function __construct(KasTitipanFile $file)
    {
        $this->file = $file;
        $this->kastip = Reference::pluck('name', 'id')->toArray();
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
                $kastip = array_search($row[1], $this->kastip);
                // $kastip = $this->kastip->where('name', $row[1])->first();

                if($kastip && (
                    $row[2] != 0 ||
                    $row[3] != 0 ||
                    $row[4] != 0
                )){
                    $model = new KasTitipan([
                        'tanggal'   => $this->tanggal,
                        'kastip_id' => $kastip,
                        'hcs'   => $row[2] ?: 0,
                        'ule'   => $row[3] ?: 0,
                        'utle'  => $row[4] ?: 0
                    ]);
                }
                return $model ?: null;
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