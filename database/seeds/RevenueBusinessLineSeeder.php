<?php

namespace Database\Seeders;

use App\Models\Repositories\CompanyRepository;
use App\Models\RevenueBusinessLine;
use Illuminate\Database\Seeder;

class RevenueBusinessLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = App(CompanyRepository::class)->all();
       
        
        foreach($companies as $company)
        {
                foreach(getRevenueBusinessLineOptions() as $revenue)
            {
                RevenueBusinessLine::factory()->create([
                    'name'=>$revenue ,
                    // 'name_ar'=>__($revenue) , 
                    'company_id'=>$company->id,
                    'creator_id'=>1 
                ]);
            }
            
        }
    }
}
