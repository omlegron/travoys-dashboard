<?php

namespace App\Jobs;

use App\Imports\KelolaData\Uyd\UydImport;
use App\Models\KelolaData\UydFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessUyd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $uyd;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UydFile $uyd)
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
        // $uyd = $this->uyd;
        // Excel::import(new UydImport, $uyd->path, 'public');
        
        // $uyd->status = "Processed";
        // $uyd->save();

        //
        $uyd = $this->uyd;

        $uyd->status = "Processing";
        $uyd->save();
        
        Excel::import(new UydImport, $uyd->path, 'public');
        
        $uyd->status = "Processed";
        $uyd->save();
        //
    }
}
