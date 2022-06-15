<?php


use Illuminate\Database\Seeder;
// use Database\Seeders\NationalitySeeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    private const SEEDERS = [
        NationalitySeeder::class,  
    ];
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // foreach(self::SEEDERS as $seeder) {
        //     $this->call($seeder);
        // }
        
        $this->call(NationalitySeeder::class);
        
    }
}
