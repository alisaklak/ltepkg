<?php


namespace Alisaklak\Ltepkg;

use Illuminate\Support\ServiceProvider;
use Alisaklak\Ltepkg\Console\InstallCommand;

class LtepkgServiceProvider extends  ServiceProvider
{


    public function boot()
    {

    }

    public function register()
    {
        $this->registerCommands();
        
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }


}