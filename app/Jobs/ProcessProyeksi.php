<?php

namespace App\Jobs;

use App\Imports\KelolaData\Proyeksi\ProyeksiImport;
use App\Models\KelolaData\ProyeksiFile as Proyeksi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessProyeksi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proyeksi;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Proyeksi $proyeksi)
    {
        $this->proyeksi = $proyeksi;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $proyeksi = $this->proyeksi;
        Excel::import(new ProyeksiImport, $proyeksi->path, 'public');
        
        $proyeksi->status = "Processed";
        $proyeksi->save();
    }
}
