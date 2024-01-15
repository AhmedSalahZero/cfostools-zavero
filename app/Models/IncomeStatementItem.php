<?php

namespace App\Models;

use App\Models\Traits\Accessors\IncomeStatementItemAccessor;
use App\Models\Traits\Relations\IncomeStatementItemRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  IncomeStatementItem extends Model
{
    use HasFactory, IncomeStatementItemRelation, IncomeStatementItemAccessor;
    const PERCENTAGE_OF_SALES = '[ % Of Sales ]';
    const SALES_REVENUE_ID = 1;
    const SALES_GROWTH_RATE_ID = 2;
    const COST_OF_GOODS_ID = 3;
    const COST_OF_GOODS_PERCENTAGE_OF_SALES_ID = 4;
    const GROSS_PROFIT_ID = 5;
    const GROSS_PROFIT_PERCENTAGE_OF_SALES_ID = 6;
    const MARKET_EXPENSES_ID = 7;
    const MARKET_EXPENSES_PERCENTAGE_OF_SALES_ID = 8;
    const SALES_AND_DISTRIBUTION_EXPENSES_ID = 9;
    const SALES_AND_DISTRIBUTION_EXPENSES_PERCENTAGE_OF_SALES_ID = 10;
    const GENERAL_EXPENSES_ID = 11;
    const GENERAL_EXPENSES_PERCENTAGE_OF_SALES_ID = 12;
    const EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_ID = 13;
    const EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_PERCENTAGE_OF_SALES_ID = 14;
    const EARNING_BEFORE_INTEREST_TAXES_ID = 15;
    const EARNING_BEFORE_INTEREST_TAXES_PERCENTAGE_OF_SALES_ID = 16;
    const FINANCIAL_INCOME_OR_EXPENSE_ID = 17;
    const FINANCIAL_INCOME_OR_EXPENSE_PERCENTAGE_OF_SALES_ID = 18;
    const EARNING_BEFORE_TAXES_ID = 19;
    const EARNING_BEFORE_TAXES_PERCENTAGE_OF_SALES_ID = 20;
    const CORPORATE_TAXES_ID = 21;
    const CORPORATE_TAXES_PERCENTAGE_OF_SALES_ID = 22;
    const NEXT_PROFIT_ID = 23;
    const NEXT_PROFIT_PERCENTAGE_OF_SALES_ID = 24;

    protected $guarded = [
        'id'
    ];

    public static function salesRateMap(): array
    {
        return [
            self::COST_OF_GOODS_ID => self::COST_OF_GOODS_PERCENTAGE_OF_SALES_ID,
            self::GROSS_PROFIT_ID => self::GROSS_PROFIT_PERCENTAGE_OF_SALES_ID,
            self::MARKET_EXPENSES_ID => self::MARKET_EXPENSES_PERCENTAGE_OF_SALES_ID,
            self::SALES_AND_DISTRIBUTION_EXPENSES_ID => self::SALES_AND_DISTRIBUTION_EXPENSES_PERCENTAGE_OF_SALES_ID,
            self::GENERAL_EXPENSES_ID => self::GENERAL_EXPENSES_PERCENTAGE_OF_SALES_ID,
            self::EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_ID => self::EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_PERCENTAGE_OF_SALES_ID,
            self::EARNING_BEFORE_INTEREST_TAXES_ID => self::EARNING_BEFORE_INTEREST_TAXES_PERCENTAGE_OF_SALES_ID,
            self::FINANCIAL_INCOME_OR_EXPENSE_ID => self::FINANCIAL_INCOME_OR_EXPENSE_PERCENTAGE_OF_SALES_ID,
            self::EARNING_BEFORE_TAXES_ID => self::EARNING_BEFORE_TAXES_PERCENTAGE_OF_SALES_ID,
            self::CORPORATE_TAXES_ID => self::CORPORATE_TAXES_PERCENTAGE_OF_SALES_ID,
            self::NEXT_PROFIT_ID => self::NEXT_PROFIT_PERCENTAGE_OF_SALES_ID,

        ];
    }
    // for database usage 
    public static function getMainItems()
    {
        return [
            'Sales Revenue' => [
                'id' => $salesRevenueId = self::SALES_REVENUE_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => false,
                'is_main_for_all_calculations' => true // when it change , all remains rows in tables will also changes,
                , 'is_sales_rate' => false
            ], 'Sales Growth Rate %' => [
                'id' => self::SALES_GROWTH_RATE_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes,
                , 'is_sales_rate' => false,
                'depends_on' => [$salesRevenueId]
            ],
            'Cost Of Goods / Service Sold' => [
                'id' => $costOfGoodsId = self::COST_OF_GOODS_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => true,
                'is_main_for_all_calculations' => true // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false
            ],
            'Cost Of Goods / Service Sold ' . self::PERCENTAGE_OF_SALES => [
                'id' => $costOfGoodsId = self::COST_OF_GOODS_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'depends_on' => [$salesRevenueId],
                'has_depreciation_or_amortization' => false,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Gross Profit' => [
                'id' => $grossProfitId = self::GROSS_PROFIT_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId, $costOfGoodsId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false
            ],
            'Gross Profit ' . self::PERCENTAGE_OF_SALES => [
                'id' => self::GROSS_PROFIT_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Marketing Expenses' => [
                'id' => $marketExpensesId = self::MARKET_EXPENSES_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => true,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'Marketing Expenses ' . self::PERCENTAGE_OF_SALES => [
                'id' => self::MARKET_EXPENSES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Sales & Distribution Expenses' => [
                'id' => $salesAndDistributionExpensesId = self::SALES_AND_DISTRIBUTION_EXPENSES_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => true,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'Sales & Distribution Expenses ' . self::PERCENTAGE_OF_SALES => [
                'id' => self::SALES_AND_DISTRIBUTION_EXPENSES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'General Expenses' => [
                'id' => $generalExpensesID = self::GENERAL_EXPENSES_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => true,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'General Expenses ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::GENERAL_EXPENSES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Earning Before Interest Taxes Depreciation Amortization - EBITDA' => [
                'id' => $earningBeforeInterestTaxesDepreciationAmortizationId = self::EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$grossProfitId, $marketExpensesId, $salesAndDistributionExpensesId, $generalExpensesID],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'EBITDA ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Earning Before Interest Taxes - EBIT' => [
                'id' => $earningBeforeInterestTaxesId = self::EARNING_BEFORE_INTEREST_TAXES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$earningBeforeInterestTaxesDepreciationAmortizationId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'EBIT ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::EARNING_BEFORE_INTEREST_TAXES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],

            'Finance Income / (Expenses)' => [
                'id' => $financialIncomeOrExpense = self::FINANCIAL_INCOME_OR_EXPENSE_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => false,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'Finance Income / (Expenses) ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::FINANCIAL_INCOME_OR_EXPENSE_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Earning Before Taxes - EBT' => [
                'id' =>   $earningBeforeTaxesId = self::EARNING_BEFORE_TAXES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$financialIncomeOrExpense, $earningBeforeInterestTaxesId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'EBT ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::EARNING_BEFORE_TAXES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Corporate Taxes' => [
                'id' => $corporateTaxesID = self::CORPORATE_TAXES_ID,
                'hasSubItems' => true,
                'has_depreciation_or_amortization' => false,
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false

            ],
            'Corporate Taxes ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::CORPORATE_TAXES_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
            'Net Profit' => [
                'id' => self::NEXT_PROFIT_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$corporateTaxesID, $earningBeforeTaxesId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => false
            ],
            'Net Profit ' . self::PERCENTAGE_OF_SALES => [
                'id' =>  self::NEXT_PROFIT_PERCENTAGE_OF_SALES_ID,
                'hasSubItems' => false,
                'has_depreciation_or_amortization' => false,
                'depends_on' => [$salesRevenueId],
                'is_main_for_all_calculations' => false // when it change , all remains rows in tables will also changes
                , 'is_sales_rate' => true
            ],
        ];
    }
}
