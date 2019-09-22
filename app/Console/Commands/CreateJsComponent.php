<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateJsComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:jscomponent {theme} {name} {author=Champa}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a javascript component';

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
        $theme = $this->argument('theme');
		$name = $this->argument('name');
		
		if(!file_exists(public_path($theme))) {

			$this->error('Theme "'. $theme .'" doesnt exist, aborting...');

			return false;
		}

        $file = public_path($theme .'/js/Components/'. $name .'.js');

        if (!file_exists(public_path($theme .'/js/Components'))) {

			mkdir(public_path($theme .'/js/Components'), 0700);
			
			$this->info('Creating components folder...');
        }

        $content = '
/**
 * @component '. $name .'
 * @author '. $this->argument('author') .'
 */

\'use strict\';

function '. $name .'(name) {
	
	this.name = name;
	this.placement = null;
}

'. $name .'.prototype = {
	
	render: function() {

	},

	placeIn: function(placement) {

		this.placement = placement;

		return this;
	}
}';

        file_put_contents($file, $content, LOCK_EX);

        $this->info('Javascript component '. $name .' successfully created!');
    }
}
