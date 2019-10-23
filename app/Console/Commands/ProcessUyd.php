<?php

namespace App\Console\Commands;

use App\Imports\KelolaData\Uyd\UydImport;
use App\Models\KelolaData\UydFile;
use Illuminate\Console\Command;

class ProcessUyd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:uyd {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'uyd Import';

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
        $file = UydFile::find($this->argument('file'));
        $file->status = "Processing";
        $file->save();

        $this->output->title('Starting import');
        (new UydImport)->withOutput($this->output)->import($file->path, 'public');
        $this->output->success('Import successful');

        $file->status = "Processed";
        $file->save();
    }
}
