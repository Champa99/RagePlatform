<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportGeoDBIps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:geodbips {database} {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports geo db ips from resources/geodb/';

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

		ini_set('memory_limit', '1024M');

		$this->info("Zapoceto izvrsavanje skripte...");

		$timeStart = microtime(true);

        $database = $this->argument('database');
		$file = $this->argument('file');
		
		$this->info('Ucitavam fajl u memoriju...');

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Csv');
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load(resource_path() .'/geodb/'. $file .'.csv');
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		$this->info('Zapocinjem ubacivanje u bazu...');

		DB::transaction(function () use ($sheetData, $database) {
			
			foreach($sheetData AS $i => $data) {

				if($i != 1) {
					DB::connection('mysql_samp')->insert("INSERT IGNORE INTO ". $database ." (network, geoname_id, registered_country_geoname_id, represented_country_geoname_id, is_satellite_provider)
						VALUES (:network, :geoname_id, :registered_country_geoname_id, :represented_country_geoname_id, :is_satellite_provider)", [
							'network'							=>	$data['A'],
							'geoname_id'						=>	$data['B'],
							'registered_country_geoname_id'		=>	$data['C'],
							'represented_country_geoname_id'	=>	$data['D'],
							'is_satellite_provider'				=>	$data['E']
						]);
				}
			}
		}, 5);

		$timeEnd = microtime(true);
		$execution = $timeEnd - $timeStart;
		$size = count($sheetData);

		$this->info('Skripta izvrsena za '. $execution .' sekundi');
		$this->info('Ucitano '. $size . ' redova u memoriju');
    }
}
