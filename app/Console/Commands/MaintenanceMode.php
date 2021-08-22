<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class MaintenanceMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        //Maintenance mode on
        Artisan::call('down');
        $this->resetAllImages();

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Artisan::call('passport:install');



        //Maintenance mode off
        Artisan::call('up');

    }

    public function resetAllImages(){
        File::copyDirectory('public/storage/demo_images', 'public/storage/');
    }
}
