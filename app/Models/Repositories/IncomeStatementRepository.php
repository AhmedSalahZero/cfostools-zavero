<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\IncomeStatement;
use App\Models\IncomeStatementItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class IncomeStatementRepository implements IBaseRepository
{

    public function all(): Collection
    {
        return IncomeStatement::withAllRelations()->onlyCurrentCompany()->get();
    }

    public function allFormatted(): array
    {
        return IncomeStatement::onlyCurrentCompany()->get()->pluck('name', 'id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $incomeStatements = $this->all();
        return formatOptionsForSelect($incomeStatements, 'getId', 'getName');
    }

    public function getAllExcept($id): ?Collection
    {
        return IncomeStatement::onlyCurrentCompany()->where('id', '!=', $id)->get();
    }

    public function query(): Builder
    {
        return IncomeStatement::onlyCurrentCompany()->query();
    }
    public function Random(): Builder
    {
        return IncomeStatement::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id): IBaseModel
    {
        return IncomeStatement::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'): ?IncomeStatement
    {
        return IncomeStatement::onlyCurrentCompany()->latest($column)->first();
    }
    public function store(Request $request): IBaseModel
    {
        $incomeStatement = App(IncomeStatement::class);

        $incomeStatement = $incomeStatement
            //  ->storeOfferedServiceSectionWithResult($request)
            //  ->storeDirectManpowerExpense($request)
            //  ->storeFreelancersExpense($request)
            //  ->storeOtherVariableManpowerExpense($request)
            //  ->storeOtherDirectOperationsExpense($request)
            //  ->storeSalesAndMarketingExpense($request)
            //  ->storeGeneralExpense($request)
            ->storeMainSection($request)->storeMainItems($request);
        return $incomeStatement;
    }

    public function storeReport(Request $request): IBaseModel
    {
        $incomeStatement = App(IncomeStatement::class);

        $incomeStatement
            ->storeReport($request);

        return $incomeStatement;
    }

    public function update(IBaseModel $incomeStatement, Request $request): void
    {
        $incomeStatement

            ->updateProfitability($request);
    }

    public function paginate(Request $request): array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();

        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function (IncomeStatement $incomeStatement, $index) {
            // $incomeStatement->revenueBusinessLineName = $incomeStatement->getRevenueBusinessLineName();
            // $incomeStatement->serviceCategoryName = $incomeStatement->getServiceCategoryName();
            // $incomeStatement->serviceItemName = $incomeStatement->getServiceItemName();
            // $incomeStatement->totalRecommendPriceWithoutVatFormatted = $incomeStatement->getTotalRecommendPriceWithoutVatFormatted();
            // $incomeStatement->totalRecommendPriceWithVatFormatted = $incomeStatement->getTotalRecommendPriceWithVatFormatted();
            // $incomeStatement->totalNetProfitAfterTaxesFormatted = $incomeStatement->getTotalNetProfitAfterTaxesFormatted();
            $incomeStatement->creator_name = $incomeStatement->getCreatorName();
            $incomeStatement->created_at_formatted = formatDateFromString($incomeStatement->created_at);
            $incomeStatement->updated_at_formatted = formatDateFromString($incomeStatement->updated_at);
            // $incomeStatement->serviceCategories = $incomeStatement->serviceCategories->load('serviceItems'); 
            $incomeStatement->order = $index + 1;
        });
        return [
            'data' => $datePerPage,
            "draw" => (int)Request('draw'),
            "recordsTotal" => IncomeStatement::onlyCurrentCompany()->count(),
            "recordsFiltered" => $allFilterDataCounter,
        ];
    }

    public function paginateReport(Request $request, IncomeStatement $incomeStatement): array
    {

        $filterData = $this->commonScopeForReport($request, $incomeStatement);

        $allFilterDataCounter = $filterData->count();

        $dataWithRelations = collect([]);

        $datePerPage = $filterData->get()->each(function (IncomeStatementItem $incomeStatementItem, $index) use ($dataWithRelations, $incomeStatement) {
            // $incomeStatement->revenueBusinessLineName = $incomeStatement->getRevenueBusinessLineName();
            // $incomeStatement->serviceCategoryName = $incomeStatement->getServiceCategoryName();
            // $incomeStatement->serviceItemName = $incomeStatement->getServiceItemName();
            // $incomeStatement->totalRecommendPriceWithoutVatFormatted = $incomeStatement->getTotalRecommendPriceWithoutVatFormatted();
            // $incomeStatement->totalRecommendPriceWithVatFormatted = $incomeStatement->getTotalRecommendPriceWithVatFormatted();
            // $incomeStatement->totalNetProfitAfterTaxesFormatted = $incomeStatement->getTotalNetProfitAfterTaxesFormatted();
            $incomeStatementItem->creator_name = $incomeStatementItem->getCreatorName();
            $incomeStatementItem->created_at_formatted = formatDateFromString($incomeStatementItem->created_at);
            $incomeStatementItem->updated_at_formatted = formatDateFromString($incomeStatementItem->updated_at);
            // $incomeStatement->serviceCategories = $incomeStatement->serviceCategories->load('serviceItems'); 
            $incomeStatementItem->order = $index + 1;
            $dataWithRelations->add($incomeStatementItem);
            $incomeStatementItem->getSubItems($incomeStatement->id)->each(function ($subItem) use ($dataWithRelations) {
                $subItem->isSubItem = true; // isSubRow
                $dataWithRelations->add($subItem);
            });
        });

        // $dataWithRelations = $dataWithRelations->sortBy('id')->values();
        return [
            'data' => $dataWithRelations,
            "draw" => (int)Request('draw'),
            "recordsTotal" => IncomeStatementItem::count(),
            "recordsFiltered" => $allFilterDataCounter,
        ];
    }
    public function commonScope(Request $request): builder
    {
        return IncomeStatement::onlyCurrentCompany()->when($request->filled('search_input'), function (Builder $builder) use ($request) {

            $builder
                ->where(function (Builder $builder) use ($request) {
                    $builder->when($request->filled('search_input'), function (Builder $builder) use ($request) {
                        $keyword = "%" . $request->get('search_input') . "%";
                        $builder
                            // ->whereHas('revenueBusinessLine',function(Builder $builder) use ($keyword){
                            //     $builder->where('revenue_business_lines.name','like',$keyword);
                            // })
                            // ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
                            //     $builder->where('service_categories.name','like',$keyword);
                            // })
                            // ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
                            //     $builder->where('service_categories.name','like',$keyword);
                            // })
                            // ->orWhereHas('serviceItem',function(Builder $builder) use ($keyword){
                            //     $builder->where('service_items.name','like',$keyword);
                            // })
                            // ->orWhereHas('creator',function(Builder $builder) use($keyword) {
                            //     $builder->where('name','like',$keyword);
                            // })->orWhereHas('company',function(Builder $builder) use($keyword) {
                            //     $builder->where('name','like',$keyword);
                            // })
                        ;
                    });
                });
        })
            // ->when($request->filled('revenue_business_line_id') && $request->get('revenue_business_line_id') != 'All' , function(Builder $builder) use ($request){
            //                 $builder->where('revenue_business_line_id',$request->get('revenue_business_line_id'));
            //         })

            //           ->when($request->filled('service_category_id') && $request->get('service_category_id') != 'All' , function(Builder $builder) use ($request){
            //                 $builder->where('service_category_id',$request->get('service_category_id'));
            //         })
            //         ->when($request->filled('service_item_id') && $request->get('service_item_id') != 'All' , function(Builder $builder) use ($request){
            //                 $builder->where('service_item_id',$request->get('service_item_id'));
            //         })

            ->orderBy('income_statements.' . getDefaultOrderBy()['column'], getDefaultOrderBy()['direction']);
    }

    public function commonScopeForReport(Request $request, IncomeStatement $incomeStatement): builder
    {
        return IncomeStatementItem::with(['subItems' => function ($builder) use ($incomeStatement) {
            $builder->where('income_statement_id', $incomeStatement->id);
        }])->whereHas('incomeStatements', function (Builder $builder) use ($incomeStatement) {
            $builder->where('income_statements.id', $incomeStatement->id);
        })
            ->orderBy('income_statement_items.id', 'asc');

        // return IncomeStatement::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

        //     $builder
        //     ->where(function(Builder $builder) use ($request){
        //         $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
        //             $keyword = "%".$request->get('search_input')."%";
        //             $builder
        //             // ->whereHas('revenueBusinessLine',function(Builder $builder) use ($keyword){
        //             //     $builder->where('revenue_business_lines.name','like',$keyword);
        //             // })
        //             // ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
        //             //     $builder->where('service_categories.name','like',$keyword);
        //             // })
        //             // ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
        //             //     $builder->where('service_categories.name','like',$keyword);
        //             // })
        //             // ->orWhereHas('serviceItem',function(Builder $builder) use ($keyword){
        //             //     $builder->where('service_items.name','like',$keyword);
        //             // })
        //             // ->orWhereHas('creator',function(Builder $builder) use($keyword) {
        //             //     $builder->where('name','like',$keyword);
        //             // })->orWhereHas('company',function(Builder $builder) use($keyword) {
        //             //     $builder->where('name','like',$keyword);
        //             // })
        //             ;

        //         })
        //         ;

        //     });
        // })
        // // ->when($request->filled('revenue_business_line_id') && $request->get('revenue_business_line_id') != 'All' , function(Builder $builder) use ($request){
        // //                 $builder->where('revenue_business_line_id',$request->get('revenue_business_line_id'));
        // //         })

        // //           ->when($request->filled('service_category_id') && $request->get('service_category_id') != 'All' , function(Builder $builder) use ($request){
        // //                 $builder->where('service_category_id',$request->get('service_category_id'));
        // //         })
        // //         ->when($request->filled('service_item_id') && $request->get('service_item_id') != 'All' , function(Builder $builder) use ($request){
        // //                 $builder->where('service_item_id',$request->get('service_item_id'));
        // //         })

        // ->orderBy('income_statements.'.getDefaultOrderBy()['column'],getDefaultOrderBy()['direction']) ;

    }

    public function export(Request $request): Collection
    {
        return $this->commonScope(
            $request->replace(
                array_merge($request->all(), [
                    'format' => $request->get('format'),
                ])
            )
        )
            ->select(['income_statements.id', 'income_statements.created_at as join_at'])
            ->get()->each(function ($incomeStatement) {
                // $incomeStatement->name = $incomeStatement->getName();
            });
    }
}
