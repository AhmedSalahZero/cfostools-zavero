<?php

namespace Database\Seeders;

use App\Models\ServiceNature;
use Illuminate\Database\Seeder;

class ServiceNatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceNature::factory()->create([
            'name'=> 'Online'
        ]);
        ServiceNature::factory()->create([
            'name'=> 'Physical'
        ]);
        
    }
}
