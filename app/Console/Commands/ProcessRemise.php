<?php

namespace App\Console\Commands;

use App\Imports\KelolaData\Remise\RemiseImport;
use App\Models\KelolaData\RemiseFile;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ProcessRemise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:remise {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remise Import';

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
        $file = RemiseFile::find($this->argument('file'));
        $file->status = "Processing";
        $file->save();

        $this->output->title('Starting import');
        Excel::import(new RemiseImport, $file->path, 'public');
        $this->output->success('Import successful');

        $file->status = "Processed";
        $file->save();
    }
}
