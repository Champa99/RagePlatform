<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateCoreJs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:corejs {name} {--component} {author=Champa}';

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
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $component = $this->option('component');

        if(!file_exists(public_path('coreJs'))) {

            mkdir(public_path('coreJs'), 777);

            $this->info('coreJs folder doesn\'t exist so I\'m creating it...');
        }

        if($component) {

            if(!file_exists(public_path('coreJs/Components'))) {

                mkdir(public_path('coreJs/Components'), 777);

                $this->info('Components folder doesn\'t exist so I\'m creating it...');
            }

            $path = public_path('coreJs/Components/'. $name .'.js');
        } else {

            $path = public_path('coreJs/'. $name .'.js');
        }

        $content = '
/**
 * @component '. $name .'
 * @author '. $this->argument('author') .'
 */

\'use strict\';

jQuery(function($) {

});';

        file_put_contents($path, $content, LOCK_EX);

        $this->info('coreJs '. $name .' successfully created!');
    }
}
