<?php

namespace Database\Seeders;

use App\Models\Repositories\CompanyRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\RevenueBusinessLine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = App(CompanyRepository::class)->all();
       foreach($companies as $companyIndex=>$company)
            foreach(RevenueBusinessLine::where('company_id',$company->id)->get() as $index=>$revenueBusinessLine)
            {
                for($i= 0 ; $i<= 10 ; $i++)
                {
                        $request = (new Request())->replace([
                            'creator_id'=>User::first()->id, 
                            'company_id'=>$company->id ,
                            'service_category_name'=>'service category ' . $companyIndex.$index.$i ,
                            'revenue_business_line_id'=>$revenueBusinessLine->id   
                           ]);
                         App(ServiceCategoryRepository::class)->store($request);
                }
                
            }
        
    }
}
