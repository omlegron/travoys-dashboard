<?php

namespace App\Jobs;

use App\Imports\KelolaData\Inflow\InflowImport;
use App\Models\KelolaData\InflowFile as Inflow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessInflow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inflow;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Inflow $inflow)
    {
        $this->inflow = $inflow;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $inflow = $this->inflow;
        
        try{
            Excel::import(new InflowImport, $inflow->path, 'public');
        }
        catch(Exception $e) {
            $this->failed($e);
        }
        
        $inflow->status = "Processed";
        $inflow->save();
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        $inflow = $this->inflow;
        
        $inflow->status = "Failed";
        $inflow->save();
    }
}
