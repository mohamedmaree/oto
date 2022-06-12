<?php
namespace Maree\Oto;

use Illuminate\Support\ServiceProvider;

class OtoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/oto.php' => config_path('oto.php'),
        ],'oto');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/oto.php', 'oto'
        );
    }
}
