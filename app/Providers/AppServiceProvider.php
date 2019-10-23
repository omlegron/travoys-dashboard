<?php

namespace App\Providers;

use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton('pdf', function() {
            return new PDF();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        setlocale(LC_ALL, 'id_ID');
        Carbon::setLocale('id_ID');
        Schema::defaultStringLength(191);
        
        Queue::failing(function($connection, $job, $data) {
            dd($data);
        });

         Relation::morphMap([
            'event-file'  => 'App\Models\Master\Event',
        ]);
    }
}
