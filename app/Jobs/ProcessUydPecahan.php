<?php

namespace App\Jobs;

use App\Imports\KelolaData\UydPecahan\UydPecahanImport;
use App\Models\KelolaData\UydPecahanFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessUydPecahan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uyd;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UydPecahanFile $uyd)
    {
        $this->uyd = $uyd;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $uyd = $this->uyd;

        $uyd->status = "Processing";
        $uyd->save();
        
        Excel::import(new UydPecahanImport, $uyd->path, 'public');
        
        $uyd->status = "Processed";
        $uyd->save();
    }
}
