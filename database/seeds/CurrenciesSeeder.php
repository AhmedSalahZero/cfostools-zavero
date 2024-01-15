<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::factory()->create([
            'name'=> 'EGP'
        ]);
        Currency::factory()->create([
            'name'=> 'USD'
        ]);
        Currency::factory()->create([
            'name'=> 'EURO'
        ]);
        
    }
}
