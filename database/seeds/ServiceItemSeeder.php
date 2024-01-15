<?php

namespace Database\Seeders;

use App\Models\Repositories\CompanyRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\RevenueBusinessLine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = App(CompanyRepository::class)->all();
        foreach ($companies as $companyIndex => $company)
            foreach (RevenueBusinessLine::where('company_id', $company->id)->get() as $index => $revenueBusinessLine) {
                foreach ($revenueBusinessLine->serviceCategories as $serviceCategoryIndex => $serviceCategory) {
                    for ($i = 0; $i < 10; $i++) {
                        $request = (new Request())->replace([
                            'creator_id' => User::first()->id,
                            'company_id' => $company->id,
                            'service_item_name' => 'service Item ' . $companyIndex . $index . $serviceCategoryIndex . $i,
                            'service_category_id' => $serviceCategory->id,
                        ]);
                        App(ServiceItemRepository::class)->store($request);
                    }
                }
            }
    }
}
