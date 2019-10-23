<?php

namespace App\Console\Commands;

use App\Imports\KelolaData\Outflow\OutflowImport;
use App\Models\KelolaData\OutflowFile;
use Illuminate\Console\Command;

class ProcessOutflow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:outflow {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Outflow Import';

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
        $file = OutflowFile::find($this->argument('file'));
        $file->status = "Processing";
        $file->save();

        $this->output->title('Starting import');
        (new OutflowImport)->withOutput($this->output)->import($file->path, 'public');
        $this->output->success('Import successful');

        $file->status = "Processed";
        $file->save();
    }
}
