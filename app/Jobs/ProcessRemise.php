<?php

namespace App\Jobs;

use App\Imports\KelolaData\Remise\RemiseImport;
use App\Models\KelolaData\RemiseFile as Remise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessRemise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $remise;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Remise $remise)
    {
        $this->remise = $remise;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $remise = $this->remise;
        Excel::import(new RemiseImport, $remise->path, 'public');
        
        $remise->status = "Processed";
        $remise->save();
    }
}
