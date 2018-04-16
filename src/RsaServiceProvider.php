<?php

namespace HaoFrank\Rsa;

use Illuminate\Support\ServiceProvider;

class RsaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/rsa.php';

        if (function_exists('config_path')) {
            $publishPath = config_path('rsa.php');
        } else {
            $publishPath = base_path('config/rsa.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rsa', function () {
            return $this->app->make('HaoFrank\Rsa\Rsa');
        });
    }
}
