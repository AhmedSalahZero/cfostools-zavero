  <?

  
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
                             $newCustomersForTypes[$typeToCache] =$DeadCustomers ;
                        }


        
        }
        

        return $newDeadForTypes ; 
    }