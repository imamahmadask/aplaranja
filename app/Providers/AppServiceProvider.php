<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Force HTTPS jika APP_URL menggunakan https://
         * Pendekatan ini andal di semua environment (local/production)
         * tanpa bergantung pada nilai APP_ENV.
         * Penting untuk Livewire file upload di belakang reverse proxy server.
         */
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
