<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateScss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:scss {theme} {namespace} {name} {author=Champa}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an scss file';

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
        $namespace = $this->argument('namespace');
        $name = $this->argument('name');
		$author = $this->argument('author');
		
		// Check if the theme folder exists
		if(!file_exists(public_path($theme))) {
			
			$this->error('Theme "'. $theme .'" doesnt exist, aborting...');

			return false;
		}

		// Check if the namespace folder exists
		if(!file_exists(public_path($theme .'//css//'. $namespace))) {

			// If not, create it
			mkdir(public_path($theme .'//css//'. $namespace), 0700);
			
			$this->info('Namespace folder "'. $theme .'/css/'. $namespace .'" doesnt exist, so I created it...');
		}

        $file = public_path($theme .'//css//'. $namespace .'/'. $name .'.scss');

        $content = '/*
 * Auto created by artisan on '. date("d.m.Y \a\\t H:i") .'
 * '. $theme .'/css/'. $namespace .'/'. $name .'
 * @author '. $author .'
 */

';

        file_put_contents($file, $content, LOCK_EX);

        $this->info('Scss file "'. $theme .'/css/'. $namespace .'/'. $name .'" successfully created!');
    }
}
