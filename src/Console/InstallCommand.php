<?php

namespace Alisaklak\Ltepkg\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ltepkg:install
                            {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ltepkg Themes';

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
     * @return void
     */
    public function handle()
    {

        $kit = $this->choice(
            'Admin Ui kurulumu?',
            ['Hayır', 'Evet'],
            0
        );
        if ($kit === "Hayır") {
            $this->requireComposerPackages('laravel/ui:^3.3');
            shell_exec('php artisan ui bootstrap --auth');
        }
        $this->requireComposerPackages('almasaeed2010/adminlte:^3.1');
        $this->requireComposerPackages('spatie/laravel-query-builder');
        $this->requireComposerPackages('livewire/livewire');

        


        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__ . '/../../resources/stubs/routes.stub'),
            FILE_APPEND
        );


        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/controllers', app_path('Http/Controllers/'));


        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/database', base_path('database/'));

        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/views', resource_path('views/'));

        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests/'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/Requests', app_path('Http/Requests/'));


        (new Filesystem)->ensureDirectoryExists(app_path('Http/Livewire/'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../resources/stubs/Livewire', app_path('Http/Livewire/'));
        
        
        (new Filesystem)->copy(__DIR__ . '/../../resources/stubs/config/simple.php', base_path('config/simple.php'));

        //plugins
        (new Filesystem)->ensureDirectoryExists(public_path('dist'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/dist'), public_path('dist/'));
        (new Filesystem)->ensureDirectoryExists(public_path('plugins/jquery'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/jquery'), public_path('plugins/jquery/'));
        (new Filesystem)->ensureDirectoryExists(public_path('plugins/bootstrap'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/bootstrap'), public_path('plugins/bootstrap/'));
        (new Filesystem)->ensureDirectoryExists(public_path('plugins/fontawesome-free'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/fontawesome-free'), public_path('plugins/fontawesome-free/'));

        (new Filesystem)->ensureDirectoryExists(public_path('plugins/moment'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/moment'), public_path('plugins/moment/'));


        (new Filesystem)->ensureDirectoryExists(public_path('plugins/select2'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/select2'), public_path('plugins/select2/'));


        (new Filesystem)->ensureDirectoryExists(public_path('plugins/select2-bootstrap4-theme'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/select2-bootstrap4-theme'), public_path('plugins/select2-bootstrap4-theme/'));


        (new Filesystem)->ensureDirectoryExists(public_path('plugins/sweetalert2'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/sweetalert2'), public_path('plugins/sweetalert2/'));

        (new Filesystem)->ensureDirectoryExists(public_path('plugins/sweetalert2-theme-bootstrap-4'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/sweetalert2-theme-bootstrap-4'), public_path('plugins/sweetalert2-theme-bootstrap-4/'));


        (new Filesystem)->ensureDirectoryExists(public_path('plugins/tempusdominus-bootstrap-4'));
        (new Filesystem)->copyDirectory(base_path('vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4'), public_path('plugins/tempusdominus-bootstrap-4/'));
        

    }


    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }
}
