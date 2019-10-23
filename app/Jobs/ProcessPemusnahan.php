<?php

namespace App\Jobs;

use App\Imports\KelolaData\Pemusnahan\PemusnahanImport;
use App\Models\KelolaData\PemusnahanFile as Pemusnahan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessPemusnahan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pemusnahan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pemusnahan $pemusnahan)
    {
        $this->pemusnahan = $pemusnahan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pemusnahan = $this->pemusnahan;
        Excel::import(new PemusnahanImport, $pemusnahan->path, 'public');
        
        $pemusnahan->status = "Processed";
        $pemusnahan->save();
    }
}
