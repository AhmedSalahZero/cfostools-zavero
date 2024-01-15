<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Repositories\CompanyRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\RevenueBusinessLine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(100)->create();
    }
}
