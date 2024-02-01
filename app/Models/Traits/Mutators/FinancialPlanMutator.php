<?php

namespace App\Models\Traits\Mutators;

use App\Models\Category;
use App\Models\FinancialPlan;
use App\Models\Product;
use Illuminate\Http\Request;

trait FinancialPlanMutator
{
    protected function getMainFields(): array
    {
        return [
            'creator_id', 'company_id', 'study_name', 'study_status',
            'revenue_streams', 'country_id', 'country_id', 'state_id',
            'study_start_date', 'duration_in_years', 'study_end_date',
            'region', 'development_start_month',
            'finished_goods_inventory_coverage_days', 'raw_materials_inventory_coverage_days', 'finished_goods_inventory_coverage_days_for_trading',
            'development_start_date', 'development_duration', 'main_functional_currency', 'additional_currency', 'exchange_rate', 'corporate_taxes_rate', 'investment_return_rate', 'perpetual_growth_rate', 'financial_year_start_month',
            'operation_start_date', 'development_end_date', 'study_includes', 'add_allocations'

        ];
    }

    public function storeMainSection(Request $request)
    {
        $financialPlan = FinancialPlan::create($request->except(['_token']));
        $datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
        $studyDates = $financialPlan->getStudyDates() ;
        $datesAndIndexesHelpers = $financialPlan->datesAndIndexesHelpers($studyDates);
        $datesIndexWithYearIndex = $datesAndIndexesHelpers['datesIndexWithYearIndex'];
        $yearIndexWithYear = $datesAndIndexesHelpers['yearIndexWithYear'];
        $dateIndexWithDate = $datesAndIndexesHelpers['dateIndexWithDate'];
        $dateWithMonthNumber = $datesAndIndexesHelpers['dateWithMonthNumber'];
        $financialPlan->updateStudyAndOperationDates($datesAsStringAndIndex, $datesIndexWithYearIndex, $yearIndexWithYear, $dateIndexWithDate, $dateWithMonthNumber);

        return $financialPlan;
    }

    public function updateMainSection(Request $request)
    {
        $this->update(array_merge($request->only($this->getMainFields()), []));
        $financialPlan = $this->fresh();
        $datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
        $studyDates = $financialPlan->getStudyDates() ;
        $datesAndIndexesHelpers = $financialPlan->datesAndIndexesHelpers($studyDates);
        $datesIndexWithYearIndex = $datesAndIndexesHelpers['datesIndexWithYearIndex'];
        $yearIndexWithYear = $datesAndIndexesHelpers['yearIndexWithYear'];
        $dateIndexWithDate = $datesAndIndexesHelpers['dateIndexWithDate'];
        $dateWithMonthNumber = $datesAndIndexesHelpers['dateWithMonthNumber'];
        $this->updateStudyAndOperationDates($datesAsStringAndIndex, $datesIndexWithYearIndex, $yearIndexWithYear, $dateIndexWithDate, $dateWithMonthNumber);

        return $this;
    }

    public function storeNewItemWithRelation(Request $request, int $companyId, string $key, string $relationName, string $modelName)
    {
        foreach ((array) $request->get($key) as  $manufacturingArr) {
            $categoryName = $manufacturingArr['category_name'] ;
            $productName = $manufacturingArr['product_name'] ;
            if (!$categoryName || !$productName) {
                continue ;
            }
            $category = Category::where('name', $categoryName)->where('model_type', $modelName)->where('company_id', $companyId)->first();
            if (!$category) {
                $category = Category::create([
                    'model_type' => $modelName,
                    'name' => $categoryName,
                    'company_id' => $companyId
                ]);
            }

            $product = Product::where('name', $productName)->where('model_type', $modelName)->where('company_id', $companyId)->first();
            if (!$product) {
                $product = Product::create([
                    'model_type' => $modelName,
                    'name' => $productName,
                    'company_id' => $companyId
                ]);
            }

            unset($manufacturingArr['category_name'], $manufacturingArr['product_name']);

            $exists = $this->{$relationName}->where('category_id', $category->id)->where('product_id', $product->id)->first();
            if (!$exists) {
                $manufacturingArr['category_id'] = $category->id ;
                $manufacturingArr['product_id'] = $product->id ;
                $this->{$relationName}()->create(array_merge($manufacturingArr, []));
            }
        }
    }

    public function storeManufacturingRevenueStreamsSection(Request $request)
    {
        $companyId = $request->get('company_id');

        foreach ((array) $request->get('manufacturingRevenueStreams') as $manufacturingArr) {
            $this->manufacturingRevenueStreams()->create(array_merge($manufacturingArr, []));
        }
        $this->storeNewItemWithRelation($request, $companyId, 'new_manufacturingRevenueStreams', 'manufacturingRevenueStreams', 'ManufacturingRevenueStream');

        return $this;
    }

    public function storeTradingRevenueStreamsSection(Request $request)
    {
        $companyId = $request->get('company_id');
        foreach ((array) $request->get('tradingRevenueStreams') as $manufacturingArr) {
            $this->tradingRevenueStreams()->create(array_merge($manufacturingArr, []));
        }
        $this->storeNewItemWithRelation($request, $companyId, 'new_tradingRevenueStreams', 'tradingRevenueStreams', 'TradingRevenueStream');

        return $this;
    }

    public function updateManufacturingRevenueStreamsSection(Request $request)
    {
        // $deleteAll = false  ;
        $relationName = 'manufacturingRevenueStreams' ;
        $this->{$relationName}()->delete();

        return $this->storeManufacturingRevenueStreamsSection($request);

        // $identifier = 'id' ;
        // return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
    }

    public function updateTradingRevenueStreamsSection(Request $request)
    {
        $relationName = 'tradingRevenueStreams' ;
        $this->{$relationName}()->delete();

        return $this->storeTradingRevenueStreamsSection($request);

        // $deleteAll = false  ;
        // $relationName = 'tradingRevenueStreams' ;
        // $identifier = 'id' ;
        // return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
    }

    public function updateStudyAndOperationDates(array $datesAsStringAndIndex, array $datesIndexWithYearIndex, array $yearIndexWithYear, array $dateIndexWithDate, array $dateWithMonthNumber)
    {
        $operationDurationDates = $this->getOperationDurationPerMonth($datesAsStringAndIndex, $datesIndexWithYearIndex, $yearIndexWithYear, $dateIndexWithDate, $dateWithMonthNumber, false);

        $studyDurationDates = $this->getStudyDurationPerMonth($datesAsStringAndIndex, $datesIndexWithYearIndex, $yearIndexWithYear, $dateIndexWithDate, $dateWithMonthNumber, false);
        $operationDurationDates = $this->editOperationDatesStartingIndex($operationDurationDates, $studyDurationDates);
        $this->update([
            'study_dates' => $studyDurationDates,
            'operation_dates' => $operationDurationDates,
        ]);
    }
}
