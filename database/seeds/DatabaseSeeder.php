<?php

use App\Models\User;
use Database\Seeders\BusinessSectorSeeder;
use Database\Seeders\CitiesTableSeeder;
use Database\Seeders\CompaniesTableSeeder;
use Database\Seeders\CompaniesUsersTableSeeder;
use Database\Seeders\CountriesTableSeeder;
use Database\Seeders\CurrenciesSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\DirectManpowerExpenseQuickPricingCalculatorSeeder;
use Database\Seeders\DirectManpowerExpenseSeeder;
use Database\Seeders\FreelancerExpenseQuickPricingCalculatorSeeder;
use Database\Seeders\FreelancerExpenseSeeder;
use Database\Seeders\IncomeStatementItemSeeder;
use Database\Seeders\IncomeStatementMainItemSubItemsTableSeeder;
use Database\Seeders\IncomeStatementSeeder;
use Database\Seeders\LanguagesTableSeeder;
use Database\Seeders\ModelHasRolesTableSeeder;
use Database\Seeders\OtherDirectOperationExpenseQuickPricingCalculatorSeeder;
use Database\Seeders\OtherDirectOperationExpenseSeeder;
use Database\Seeders\OtherVariableManpowerExpenseSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\PositionSeeder;
use Database\Seeders\ProfitabilityQuickPricingCalculatorSeeder;
use Database\Seeders\QuickPricingCalculatorSeeder;
use Database\Seeders\RevenueBusinessLineSeeder;
use Database\Seeders\RoleHasPermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\SalesAndMarketingExpenseSeeder;
use Database\Seeders\SectionsTableSeeder;
use Database\Seeders\ServiceableSeeder;
use Database\Seeders\ServiceCategorySeeder;
use Database\Seeders\ServiceItemSeeder;
use Database\Seeders\ServiceNatureSeeder;
use Database\Seeders\SharingLinkSeeder;
use Database\Seeders\StatesTableSeeder;
use Database\Seeders\TablesFieldsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitiesTableSeeder::class);
        $this->call(IncomeStatementItemSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        Auth::login(User::first());
        $this->call(BusinessSectorSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CompaniesUsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(TablesFieldsTableSeeder::class);
        $this->call(RevenueBusinessLineSeeder::class);
        $this->call(ServiceCategorySeeder::class);
        $this->call(ServiceItemSeeder::class);
        $this->call(ServiceNatureSeeder::class);
        $this->call(OtherDirectOperationExpenseSeeder::class);
        $this->call(DirectManpowerExpenseSeeder::class);
        $this->call(FreelancerExpenseSeeder::class);
        $this->call(SalesAndMarketingExpenseSeeder::class);
        $this->call(CurrenciesSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(QuickPricingCalculatorSeeder::class);
        $this->call(OtherVariableManpowerExpenseSeeder::class);
        $this->call(DirectManpowerExpenseQuickPricingCalculatorSeeder::class);
        $this->call(OtherDirectOperationExpenseQuickPricingCalculatorSeeder::class);
        $this->call(FreelancerExpenseQuickPricingCalculatorSeeder::class);
        $this->call(ProfitabilityQuickPricingCalculatorSeeder::class);
        $this->call(SharingLinkSeeder::class);
        $this->call(ServiceableSeeder::class);
        $this->call(IncomeStatementSeeder::class);
        $this->call(IncomeStatementMainItemSubItemsTableSeeder::class);
    }
}
