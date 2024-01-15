<?php

namespace Database\Seeders;

use App\Models\IncomeStatementItem;
use Illuminate\Database\Seeder;

class IncomeStatementItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (IncomeStatementItem::getMainItems() as $itemName => $itemValues) {

            IncomeStatementItem::factory()->create([
                'id' => $itemValues['id'],
                'name' => $itemName,
                'has_sub_items' => $hasSumItem = $itemValues['hasSubItems'] ?? false, 'has_depreciation_or_amortization' => $itemValues['has_depreciation_or_amortization'] ?? false,
                'is_main_for_all_calculations' => $itemValues['is_main_for_all_calculations'] ?? false,
                'is_sales_rate' => $itemValues['is_sales_rate'] ?? false,
                'has_depreciation_or_amortization' => $itemValues['has_depreciation_or_amortization'] ?? false,
                'depends_on' => $hasSumItem ? null : json_encode($itemValues['depends_on'])
            ]);
        }
    }
}
