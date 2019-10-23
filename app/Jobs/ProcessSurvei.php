<?php

namespace App\Jobs;

use App\Imports\KelolaData\Survei\SurveiImport;
use App\Models\KelolaData\SurveiFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessSurvei implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $survei;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SurveiFile $survei)
    {
        $this->survei = $survei;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $survei = $this->survei;
        // Excel::import(new SurveiImport, $survei->path, 'public');
        
        // $survei->status = "Processed";
        // $survei->save();
        
        $survei = $this->survei;

        $survei->status = "Processing";
        $survei->save();
        
        Excel::import(new SurveiImport, $survei->path, 'public');
        
        $survei->status = "Processed";
        $survei->save();
        //
    }
}
