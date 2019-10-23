<?php

namespace App\Console\Commands;

use App\Imports\KelolaData\Inflow\InflowImport;
use App\Models\KelolaData\InflowFile;
use Illuminate\Console\Command;

class ProcessInflow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:inflow {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inflow Import';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = InflowFile::find($this->argument('file'));
        $file->status = "Processing";
        $file->save();

        $this->output->title('Starting import');
        (new InflowImport)->withOutput($this->output)->import($file->path, 'public');
        $this->output->success('Import successful');

        $file->status = "Processed";
        $file->save();
    }
}
