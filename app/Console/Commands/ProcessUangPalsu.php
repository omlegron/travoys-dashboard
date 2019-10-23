<?php

namespace App\Console\Commands;

use App\Imports\UangPalsuImport;
use App\Models\KelolaData\UangPalsuFile;
use Illuminate\Console\Command;

class ProcessUangPalsu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:upal {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uang Palsu Import';

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
        $file = UangPalsuFile::find($this->argument('file'));
        if($file){
            $file->status = "Processing";
            $file->save();

            $this->output->title('Starting import');
            (new UangPalsuImport($file))->withOutput($this->output)->import($file->path, 'public');
            $this->output->success('Import successful');

            $file->status = "Processed";
            $file->save();
        }else{
            $this->error('File not found, make sure your file id is correct');
        }
    }
}
