<?php

namespace App\Jobs;

use App\Imports\KelolaData\Outflow\OutflowImport;
use App\Models\KelolaData\OutflowFile as Outflow;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessOutflow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $outflow;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Outflow $outflow)
    {
        $this->outflow = $outflow;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $outflow = $this->outflow;
        Excel::import(new OutflowImport, $outflow->path, 'public');
        
        $outflow->status = "Processed";
        $outflow->save();
    }
}
