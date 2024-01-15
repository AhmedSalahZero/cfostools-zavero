<?php
namespace App\Services\Caching;

use App\Models\Company;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CustomerNatureCashing
{
    private Company $company ;
    private string $year ;
    private array $typesOfCaching ;  
    
    public function __construct(Company $company , string $year)
    {
        $this->company = $company ;
        $this->year = $year ; 
        $this->typesOfCaching = getAllColumnsTypesForCaching($this->company->id);
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
    public function cacheNewCustomersForTypes()
     
    {
        $newCustomersForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {   
            $cacheKeyName = getNewCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
                 if(! Cache::has($cacheKeyName)){
                $possibleIndexName = 'min__index_'.$typeToCache;
                
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
              $newCustomers = DB::select(DB::raw("
                select  customer_name , ". $typeToCache  ." , count(*) as no_customers,
                 sum(case when Year = ". $this->year  ." then net_sales_value else 0 end ) total_sales  from sales_gathering  ".$forceIndex ." 
                 
                  where company_id = ". $this->company->id ." group by customer_name , ". $typeToCache  ." having  min(Year) = ". $this->year   ." order by total_sales desc"
                  ));
                  
                  $newCustomers = $this->formatDataForType($newCustomers , $typeToCache);
                  
                  Cache::forever($cacheKeyName, $newCustomers);
              }
              else
              {
                  $newCustomers = Cache::get($cacheKeyName);
              }
                        
                        if(\array_key_exists($typeToCache , $newCustomersForTypes))
                        {
                            array_push($newCustomersForTypes[$typeToCache] , $newCustomers) ;
                        }
                        else{
                             $newCustomersForTypes[$typeToCache] =$newCustomers ;
                        }
        }

            return $newCustomersForTypes ;
            
    }

  



       public function cacheRepeatingCustomersForType()
    {
        $newRepeatingForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
             $cacheKeyName = getRepeatingCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
         if(! Cache::has($cacheKeyName)){
             

              $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
             
       
            $RepeatingCustomers = DB::select(
            DB::raw(
       

        "
        select  customer_name , ". $typeToCache ." ,count(*) as no_customers, sum(case when Year = ". $this->year . " then net_sales_value else 0 end ) total_sales  from sales_gathering
          ". $forceIndex ."
        
        where company_id = ". $this->company->id ." group by customer_name , ". $typeToCache ." having  min(Year) = ". ($this->year-1) ." and 
        max(case when Year = ". $this->year ." then 1 else 0 end ) = 1 order by total_sales desc
        "
            )
        );
             $RepeatingCustomers = $this->formatDataForType($RepeatingCustomers , $typeToCache);

        Cache::forever($cacheKeyName, $RepeatingCustomers);

        }
        else{
                  $RepeatingCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $newRepeatingForTypes))
                        {
                            array_push($newRepeatingForTypes[$typeToCache] , $RepeatingCustomers) ;
                        }
                        else{
                             $newRepeatingForTypes[$typeToCache] =$RepeatingCustomers ;
                        }


        
        }
        return $newRepeatingForTypes ; 
    }



    
     public function cacheActiveCustomersForType()
    {
        $newActiveForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
            
             $cacheKeyName = getActiveCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
         if(! Cache::has($cacheKeyName)){
             $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
       
            $ActiveCustomers = DB::select(
            DB::raw(
                "
                select (customer_name) , ".$typeToCache." ,count(*) as no_customers, sum(case when Year = ". $this->year ." then net_sales_value else 0 end ) total_sales
                from sales_gathering ". $forceIndex ."
                
                where company_id = " . $this->company->id . " 
                GROUP by customer_name , " . $typeToCache ."
                having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1 
                and max(case when  Year = " . ($this->year - 1) ." then 1 else 0 end ) = 1 
                and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 1
                ORDER BY total_sales DESC
                "
                            )
        );
          $ActiveCustomers = $this->formatDataForType($ActiveCustomers , $typeToCache);

        Cache::forever($cacheKeyName, $ActiveCustomers);

        }
        else{
                  $ActiveCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $newActiveForTypes))
                        {
                            array_push($newActiveForTypes[$typeToCache] , $ActiveCustomers) ;
                        }
                        else{
                             $newActiveForTypes[$typeToCache] =$ActiveCustomers ;
                        }


        
        }
        

        return $newActiveForTypes ; 
    }
    

   



     public function cacheStopReactivatedCustomersForType()
    {
        $newStopReactivatedForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
            $cacheKeyName = getStopReactivatedCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
            
            if(! Cache::has($cacheKeyName)){
                         $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
                $StopReactivatedCustomers = DB::select(
            DB::raw(
                    "
                    select (customer_name) , ". $typeToCache  ." ,count(*) as no_customers, sum(case when Year = ". $this->year ." then net_sales_value else 0 end ) total_sales from sales_gathering 
                     ". $forceIndex ."
                    where company_id = ". $this->company->id ."
                    GROUP by customer_name , ". $typeToCache ."
                    having max(case when Year = ". ($this->year) ." then 1 else 0 end ) = 1
                    and max(case when Year = ". ($this->year - 1) ." then 1 else 0 end ) = 0
                    and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 1
                    order by total_sales desc 
                    "
            )
        );

         $StopReactivatedCustomers = $this->formatDataForType($StopReactivatedCustomers , $typeToCache);
        Cache::forever($cacheKeyName, $StopReactivatedCustomers);

        }
        else{
                  $StopReactivatedCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $newStopReactivatedForTypes))
                        {
                            array_push($newStopReactivatedForTypes[$typeToCache] , $StopReactivatedCustomers) ;
                        }
                        else{
                             $newStopReactivatedForTypes[$typeToCache] =$StopReactivatedCustomers ;
                        }


        
        }
        

        return $newStopReactivatedForTypes ; 
    }

    

    
  public function cacheDeadReactivatedCustomersForType()
    {
        $deadReactivatedForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
            
            $cacheKeyName = getDeadReactiveCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
            
            if(! Cache::has($cacheKeyName)){

                $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
                
                $deadReactivatedCustomers = DB::select(
            DB::raw(
          
                "
                    select (customer_name) , ". $typeToCache . " ,count(*) as no_customers, sum(case when year = ".  $this->year   ." then net_sales_value else 0 end ) total_sales
                    from sales_gathering ". $forceIndex ."
                    where company_id = ". $this->company->id  ."  
                    GROUP by customer_name ,".$typeToCache . " 
                    having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1
                    and max(case when Year = ". ($this->year - 1) ."  then 1 else 0 end ) = 0 
                    and max(case when Year = ". ($this->year - 2) ." then 1 else 0 end ) = 0 
                    and max(case when Year = ". ($this->year - 3) ." then 1 else 0 end ) = 1 
                    order by total_sales desc
                    ;
                    "
            )
        );
        $deadReactivatedCustomers = $this->formatDataForType($deadReactivatedCustomers , $typeToCache);

        Cache::forever($cacheKeyName, $deadReactivatedCustomers);

        }
        else{
                  $deadReactivatedCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $deadReactivatedForTypes))
                        {
                            array_push($deadReactivatedForTypes[$typeToCache] , $deadReactivatedCustomers) ;
                        }
                        else{
                             $deadReactivatedForTypes[$typeToCache] = $deadReactivatedCustomers ;
                        }


        
        }
        

        return $deadReactivatedForTypes ; 
    }

  


    public function cacheStopRepeatingCustomersForType()
    {
        $deadRepeatingForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
            
            $cacheKeyName = getStopRepeatingCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
            
            if(! Cache::has($cacheKeyName)){

                $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
                
                $StopRepeatingCustomers = DB::select(
            DB::raw(
                "
                
                select (customer_name) , ". $typeToCache .", count(*) as no_customers,sum(case when year = ".  $this->year   ." then net_sales_value else 0 end) total_sales
                from sales_gathering ". $forceIndex ."
                where company_id = ". $this->company->id  ."
                GROUP by customer_name , ". $typeToCache ."
                having max(case when Year = ". $this->year ." then 1 else 0 end ) = 1
                and max(case when Year = ". ($this->year - 1) ." then 1 else 0 end ) = 1 
                and max(case when Year = ". ($this->year - 2)  . " then 1 else 0 end ) = 0 
                and max(case when Year = ". ($this->year - 3)  . " then 1 else 0 end ) = 1 
                order by total_sales desc
                
                "
            )
        );

        $StopRepeatingCustomers = $this->formatDataForType($StopRepeatingCustomers , $typeToCache);
        Cache::forever($cacheKeyName, $StopRepeatingCustomers);

        }
        else{
                  $StopRepeatingCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $deadRepeatingForTypes))
                        {
                            array_push($deadRepeatingForTypes[$typeToCache] , $StopRepeatingCustomers) ;
                        }
                        else{
                             $deadRepeatingForTypes[$typeToCache] = $StopRepeatingCustomers ;
                        }


        
        }
        

        return $deadRepeatingForTypes ; 
    }
    

    
     public function cacheStopCustomersForType()
    {
        
        $newStopForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
             $cacheKeyName = getStopCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
             
         if(! Cache::has($cacheKeyName)){
             $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
       
            $StopCustomers = DB::select(
            DB::raw("
            select (customer_name) , ". $typeToCache ." , count(*) as no_customers, sum(case when year = ".  ($this->year - 1)   ." then net_sales_value else 0 end) total_sales
            from  sales_gathering ". $forceIndex ."
            where company_id = ". $this->company->id  ." 
            GROUP by customer_name , ". $typeToCache ." 
            having max(case when Year = " . $this->year .  " then 1 else 0 end ) = 0
            and max(case when Year = ". ($this->year - 1 ) ." then 1 else 0 end ) = 1 
            order by total_sales desc
            ")
        );

         $StopCustomers = $this->formatDataForType($StopCustomers , $typeToCache);
        Cache::forever($cacheKeyName, $StopCustomers);

        }
        else{
                  $StopCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $newStopForTypes))
                        {
                            array_push($newStopForTypes[$typeToCache] , $StopCustomers) ;
                        }
                        else{
                             $newStopForTypes[$typeToCache] =$StopCustomers ;
                        }


        
        }
        

        return $newStopForTypes ; 
    }
    
  

      public function cacheDeadCustomersForType()
    {
        $newDeadForTypes = [];
        foreach($this->typesOfCaching as $typeToCache)
        {
            
             $cacheKeyName = getDeadCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;
         if(! Cache::has($cacheKeyName)){
             $possibleIndexName = 'min__index_'.$typeToCache;
              $forceIndex = \indexIsExistIn($possibleIndexName , 'sales_gathering') ? "force index (". $possibleIndexName .")" : '' ;
       
            $DeadCustomers = DB::select(
            DB::raw(
                "
                select (customer_name) , ".  $typeToCache ." , count(*) as no_customers, sum(case when Year = ". ($this->year - 2 )  ." then net_sales_value else 0 end ) total_sales
                from sales_gathering ". $forceIndex ."
                where company_id = ". $this->company->id ."
                
                GROUP by customer_name , ".$typeToCache."
                having max(case when Year = " . $this->year  . " then 1 else 0 end ) = 0
                and max(case when Year = " . ($this->year - 1 ) ." then 1 else 0 end ) = 0 
                and max(case when Year = " . ($this->year - 2 ) ." then 1 else 0 end ) = 1 
                order by total_sales desc;
                
                "
            )
        );
            $DeadCustomers = $this->formatDataForType($DeadCustomers , $typeToCache);

        Cache::forever($cacheKeyName, $DeadCustomers);

        }
        else{
                  $DeadCustomers = Cache::get($cacheKeyName);
        }

         if(\array_key_exists($typeToCache , $newDeadForTypes))
                        {
                            array_push($newDeadForTypes[$typeToCache] , $DeadCustomers) ;
                        }
                        else{
                             $newDeadForTypes[$typeToCache] =$DeadCustomers ;
                        }


        
        }
        

        return $newDeadForTypes ; 
    }

    

 
      public function cacheTotalCustomersForType()
    {
        $totalForTypes = [];
        
        foreach($this->typesOfCaching as $typeToCache)
        {
            
             $cacheKeyName = getTotalCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache) ;

            if(! Cache::has($cacheKeyName)){
      $totals = DB::select(DB::raw(
            "
                select customer_name ,
             sum(net_sales_value) as val , ". $typeToCache ."  , count(*) as no_customers,
              FORMAT((sum(net_sales_value) / (select sum(net_sales_value)  from sales_gathering force index (min__index) where company_id
               = ". $this->company->id ."  and  Year = ". $this->year ." ) * 100) , 1) as percentage
                from sales_gathering force index (min__index) where company_id = ". $this->company->id  ." and Year = ". $this->year ." 
                group by customer_name  , ". $typeToCache . "
                order by val desc "
        ));
        $totals = $this->formatDataForType($totals , $typeToCache);
        Cache::forever($cacheKeyName, $totals);
        }
        else{
                  $totals = Cache::get($cacheKeyName);
         }


          if(\array_key_exists($typeToCache , $totalForTypes))
                        {
                            array_push($totalForTypes[$typeToCache] , $totals) ;
                        }
                        else{
                             $newDeadForTypes[$typeToCache] =$totals ;
                        }


         
        }
     
        return $newDeadForTypes  ; 
    }


 
    public function cacheAll():array 
    {
        return [
        
            'newCustomersForType'=>$this->cacheNewCustomersForTypes(),
            'RepeatingForType'=>$this->cacheRepeatingCustomersForType(),
            'ActiveForType'=>$this->cacheActiveCustomersForType(),
            'StopForType'=>$this->cacheStopCustomersForType() ,
            'StopReactivatedForType'=>$this->cacheStopReactivatedCustomersForType(),
            'deadReactivatedForType'=>$this->cacheDeadReactivatedCustomersForType(),
            'StopRepeatingForType'=>$this->cacheStopRepeatingCustomersForType(),
            'DeadForType'=>$this->cacheDeadCustomersForType(),
            'totalsForType'=>$this->cacheTotalCustomersForType(),
        ];
        
    }

    public function deleteAll()
    {
      
        foreach($this->typesOfCaching as $typeToCache)
        {
            Cache::forget(getNewCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getRepeatingCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getActiveCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getStopCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getStopReactivatedCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getDeadReactiveCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getStopRepeatingCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getDeadCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
            Cache::forget(getTotalCustomersCacheNameForCompanyInYearForType($this->company , $this->year , $typeToCache));
        }
    }

}