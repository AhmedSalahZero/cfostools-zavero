<?php

namespace Database\Seeders;

use App\Models\BusinessSector;
use Illuminate\Database\Seeder;
class BusinessSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessSector::factory()->count(5)->create();
    }
}
