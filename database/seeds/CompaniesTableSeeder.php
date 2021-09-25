<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 3 ; $i++) { 
    		
	        Company::create([
		            'name' => Str::random(10),
		            'email' => Str::random(12).'@gmail.com',
		            'address' => Str::random(16),
		            'city' => Str::random(16),
		            'zipcode' => mt_rand(10000,99999),
		            'phone' => '123456789',
		            'logo' => Str::random(16),
		            'is_active' => true,
		    ]);

    	}
    }
}
