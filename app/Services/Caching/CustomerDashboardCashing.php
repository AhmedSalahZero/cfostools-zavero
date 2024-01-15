<?php
namespace App\Services\Caching;

use App\Models\Company;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CustomerDashboardCashing
{
    private Company $company ;
    private string $year ;
    private string $newCustomerCashingName ;
    private string $repeatingCustomerCashingName ;
    private string $activeCustomerCashingName ;
    private string $stopReactivatedCustomerCashingName ;
    private string $deadReactivatedCustomerCashingName ;
    private string $stopRepeatingCustomerCashingName ;
    private string $stopCustomerCashingName ;
    private string $deadCustomerCashingName ;
    private array $typesOfCaching ;  
    
    public function __construct(Company $company , string $year)
    {
        $this->company = $company ;
        $this->year = $year ; 
        $this->newCustomerCashingName  = getNewCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->repeatingCustomerCashingName =getRepeatingCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->activeCustomerCashingName =getActiveCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->stopReactivatedCustomerCashingName =getStopReactivatedCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->deadReactivatedCustomerCashingName =getDeadReactivatedCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->stopRepeatingCustomerCashingName =getStopRepeatingCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->stopCustomerCashingName = getStopCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->deadCustomerCashingName =getDeadCustomersCacheNameForCompanyInYear($company , $year) ;
        $this->totalCustomerCashingName = getTotalCustomersCacheNameForCompanyInYear($this->company , $this->year) ;   
    }

    public function cacheNewCustomers()
     
    {
        
          if(! Cache::has($this->newCustomerCashingName)){
              
              $newCustomers = DB::select(DB::raw("
                select  customer_name , min(Year) as first_appearnce , min(Year) -1 as previous_appearance , count(*) as no_customers,
                 sum(case when Year = ". $this->year  ." then net_sales_value else 0 end ) total_sales  from sales_gathering 
                 force index (min__index)
                  where company_id = ". $this->company->id ." group by customer_name having  min(Year) = ". $this->year   ." order by total_sales desc
                "
                  )); 
              Cache::forever($this->newCustomerCashingName, $newCustomers);
              }
              else
              {
                  $newCustomers = Cache::get($this->newCustomerCashingName);
            }

            return $newCustomers ;
            
    }
    function formatDataForType(array $dataOfArray , string  $typeToCache)
    {
          $formattedData=[];
               
               foreach($dataOfArray as $index=>$dataObj)
               {
                   $groupingKey  = $dataObj->{$typeToCache} ;
                   
                   isset($formattedData[$groupingKey]) ?  array_push($formattedData[$groupingKey] , $dataObj ) : $formattedData[$groupingKey] = [$dataObj] ;
               }
               return $formattedData ;
    }
  
    public function cacheRepeatingCustomers()
    {
         if(! Cache::has($this->repeatingCustomerCashingName)){
             
       
            $RepeatingCustomers = DB::select(
            DB::raw(
       

        "
        select  customer_name , min(Year) as date ,count(*) as no_customers, sum(case when Year = ". $this->year . " then net_sales_value else 0 end ) total_sales  from sales_gathering
         force index (min__index) 
        
        where company_id = ". $this->company->id ." group by customer_name having  min(Year) = ". ($this->year-1) ." and 
        max(case when Year = ". $this->year ." then 1 else 0 end ) = 1 order by total_sales desc
        "
            )
        );


        Cache::forever($this->repeatingCustomerCashingName, $RepeatingCustomers);

        }
        else{
                  $RepeatingCustomers = Cache::get(getRepeatingCustomersCacheNameForCompanyInYear($this->company , $this->year));
        }

        

        return $RepeatingCustomers ; 
    }



      
    public function cacheActiveCustomers()
    {
         if(! Cache::has($this->activeCustomerCashingName)){
        $activeCustomers = DB::select(
            DB::raw(
                "
                select (customer_name) ,count(*) as no_customers, sum(case when Year = ". $this->year ." then net_sales_value else 0 end ) total_sales
                from sales_gathering 
                force index (min__index)
                where company_id = " . $this->company->id . " 
                GROUP by customer_name
                having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1 
                and max(case when  Year = " . ($this->year - 1) ." then 1 else 0 end ) = 1 
                and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 1
                ORDER BY total_sales DESC
                "
                            )
                        );


        Cache::forever($this->activeCustomerCashingName, $activeCustomers);

        }
        else{
                  $activeCustomers = Cache::get($this->activeCustomerCashingName);
        }
        
        return $activeCustomers ; 
    }



   


    public function cacheStopReactivatedCustomers()
    {
        if(! Cache::has($this->stopReactivatedCustomerCashingName)){
            $stopReactive = DB::select(
                DB::raw(
                    "
                    select (customer_name) ,count(*) as no_customers, sum(case when Year = ". $this->year ." then net_sales_value else 0 end ) total_sales from sales_gathering 
                     force index (min__index)
                    where company_id = ". $this->company->id ."
                    GROUP by customer_name
                    having max(case when Year = ". ($this->year) ." then 1 else 0 end ) = 1
                    and max(case when Year = ". ($this->year - 1) ." then 1 else 0 end ) = 0
                    and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 1
                    order by total_sales desc 
                    "
            )
        );

        Cache::forever($this->stopReactivatedCustomerCashingName, $stopReactive);

        }
        else{
                  $stopReactive = Cache::get($this->stopReactivatedCustomerCashingName);
        }
        return $stopReactive ; 
    }


    public function cacheDeadReactivatedCustomers()
    {
         if(! Cache::has($this->deadReactivatedCustomerCashingName)){
          $deadReactivatedCustomers = DB::select(
          
            DB::raw(
          
                "
                    select (customer_name) ,count(*) as no_customers, sum(case when year = ".  $this->year   ." then net_sales_value else 0 end ) total_sales
                    from sales_gathering force index (min__index)
                    where company_id = ". $this->company->id  ."  
                    GROUP by customer_name
                    having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1
                    and max(case when Year = ". ($this->year - 1) ."  then 1 else 0 end ) = 0 
                    and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 0 
                    and max(case when Year = ". ($this->year - 3) ." then 1 else 0 end ) = 1 
                    order by total_sales desc
                    ;
                    
                    "
            )
        );

        Cache::forever($this->deadReactivatedCustomerCashingName, $deadReactivatedCustomers);

        }
        else{
                  $deadReactivatedCustomers = Cache::get($this->deadReactivatedCustomerCashingName);
        }   
        return $deadReactivatedCustomers ; 
    }

    

    public function cacheStopRepeatingCustomers()
    {
        if(! Cache::has($this->stopRepeatingCustomerCashingName)){
          $stopRepeatingCustomers = DB::select(
            DB::raw(
                "
                select (customer_name) , count(*) as no_customers,sum(case when year = ".  $this->year   ." then net_sales_value else 0 end) total_sales
                from sales_gathering force index (min__index)
                where company_id = ". $this->company->id  ."
                GROUP by customer_name
                having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1
                and max(case when Year = ". ($this->year - 1) ." then 1 else 0 end ) = 1 
                and max(case when Year = ". ($this->year - 2)  . " then 1 else 0 end ) = 0 
                and max(case when Year = ". ($this->year - 3)  . " then 1 else 0 end ) = 1 
                order by total_sales desc
                "
            )
        );

        Cache::forever($this->stopRepeatingCustomerCashingName, $stopRepeatingCustomers);

        }
        else{
                  $stopRepeatingCustomers = Cache::get($this->stopRepeatingCustomerCashingName);
        }

        return $stopRepeatingCustomers ; 
    }




    public function cacheStopCustomers()
    {

        if(! Cache::has($this->stopCustomerCashingName)){
            $stopCustomers = DB::select(
                        DB::raw(
                            "
            select (customer_name) , count(*) as no_customers, sum(case when year = ".  ($this->year - 1)   ." then net_sales_value else 0 end) total_sales
            from  sales_gathering force index (min__index)
            where company_id = ". $this->company->id  ." 
            GROUP by customer_name  
            having max(case when Year = " . $this->year .  " then 1 else 0 end ) = 0
            and max(case when Year = ". ($this->year - 1 ) ." then 1 else 0 end ) = 1 
            order by total_sales desc
            "
            )
        );

        Cache::forever($this->stopCustomerCashingName, $stopCustomers);

        }
        else{
                  $stopCustomers = Cache::get($this->stopCustomerCashingName);
        }
        return $stopCustomers ; 
    }

    

    public function cacheDeadCustomers()
    {
        
          if(! Cache::has($this->deadCustomerCashingName)){

            
        $deadCustomers = DB::select(
     // sum form year - 2 ()
            DB::raw(
                "
                
                select (customer_name) , count(*) as no_customers, sum(case when Year = ". ($this->year - 2 )  ." then net_sales_value else 0 end ) total_sales
                from sales_gathering force index (min__index)
                where company_id = ". $this->company->id ."
                
                GROUP by customer_name
                having max(case when Year = " . $this->year  . " then 1 else 0 end ) = 0
                and max(case when Year = " . ($this->year - 1 ) ." then 1 else 0 end ) = 0 
                and max(case when Year = " . ($this->year - 2 ) ." then 1 else 0 end ) = 1 
                order by total_sales desc;
                
                "
            )
        );
  


        Cache::forever($this->deadCustomerCashingName, $deadCustomers);
        }
        else{
                  $deadCustomers = Cache::get($this->deadCustomerCashingName);
                  
        }

        return $deadCustomers ; 
        
    }



    

    public function cacheTotalCustomers()
    {
       
        
         if(! Cache::has($this->totalCustomerCashingName)){
      $totals = DB::select(DB::raw(
            "
                select customer_name ,
             sum(net_sales_value) as val , count(*) as no_customers,
              FORMAT((sum(net_sales_value) / (select sum(net_sales_value)  from sales_gathering force index (min__index) where company_id
               = ". $this->company->id ."  and  Year = ". $this->year ." ) * 100) , 1) as percentage
                from sales_gathering force index (min__index) where company_id = ". $this->company->id  ." and Year = ". $this->year ." 
                group by customer_name 
                order by val desc "
        ));

        
          Cache::forever($this->totalCustomerCashingName, $totals);
        }
        else{
                  $totals = Cache::get($this->totalCustomerCashingName);
        }
        return $totals  ; 
    }




 
    public function cacheAll():array 
    {
        return [
            'newCustomers'=>$this->cacheNewCustomers() ,
            'RepeatingCustomers'=>$this->cacheRepeatingCustomers() ,
            'activeCustomers'=>$this->cacheActiveCustomers() ,
            'stopCustomers'=>$this->cacheStopCustomers(),
            'stopReactive'=>$this->cacheStopReactivatedCustomers() ,
            'deadReactivatedCustomers'=>$this->cacheDeadReactivatedCustomers(),
            'stopRepeatingCustomers'=>$this->cacheStopRepeatingCustomers(),
            'deadCustomers'=>$this->cacheDeadCustomers(),
            'totals'=>$this->cacheTotalCustomers(),
            
        ];
        
    }

    public function deleteAll()
    {
        Cache::forget($this->newCustomerCashingName);
        Cache::forget($this->repeatingCustomerCashingName);
        Cache::forget($this->activeCustomerCashingName);
        Cache::forget($this->stopCustomerCashingName);
        Cache::forget($this->stopReactivatedCustomerCashingName);
        Cache::forget($this->deadReactivatedCustomerCashingName);
        Cache::forget($this->stopRepeatingCustomerCashingName);
        Cache::forget($this->deadCustomerCashingName);
        Cache::forget($this->totalCustomerCashingName);
   
    }

}