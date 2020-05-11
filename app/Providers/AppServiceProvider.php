<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Luezoid\Laravelcore\Contracts\IFile;
use Luezoid\Laravelcore\Files\Services\LocalFileUploadService;
use Luezoid\Laravelcore\Files\Services\SaveFileToS3Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
        }
        $this->app->bind(IFile::class, function ($app) {
            if (config('file.is_local')) {
                return $app->make(LocalFileUploadService::class);
            }
            return $app->make(SaveFileToS3Service::class);

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
    }
}
