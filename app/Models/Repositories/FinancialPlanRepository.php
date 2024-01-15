<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\FinancialPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FinancialPlanRepository implements IBaseRepository
{

	public function all(): Collection
	{
		return FinancialPlan::onlyCurrentCompany()->get();
	}

	public function allFormatted(): array
	{
		return FinancialPlan::onlyCurrentCompany()->get()->pluck('name', 'id')->toArray();
	}
	public function allFormattedForSelect()
	{
		$financialPlans = $this->all();
		return formatOptionsForSelect($financialPlans, 'getId', 'getName');
	}

	public function getAllExcept($id): ?Collection
	{
		return FinancialPlan::onlyCurrentCompany()->where('id', '!=', $id)->get();
	}

	public function query(): Builder
	{
		return FinancialPlan::onlyCurrentCompany()->query();
	}
	public function Random(): Builder
	{
		return FinancialPlan::onlyCurrentCompany()->inRandomOrder();
	}

	public function find(?int $id): FinancialPlan
	{
		return FinancialPlan::onlyCurrentCompany()->find($id);
	}

	public function getLatest($column = 'id'): ?FinancialPlan
	{
		return FinancialPlan::onlyCurrentCompany()->latest($column)->first();
	}
	public function store(Request $request): IBaseModel
	{
		$financialPlan = new FinancialPlan();
		$financialPlan = $financialPlan
			->storeMainSection($request)
			->storeManufacturingRevenueStreamsSection($request)
			->storeTradingRevenueStreamsSection($request);
			// ->storeFoodSection($request)
			// ->storeCasinoSection($request)
			// ->storeMeetingSection($request)
			// ->storeOtherSection($request)
			// ->storeSalesChannelsSection($request);

		return $financialPlan;
	}

	public function update(IBaseModel $financialPlan, Request $request): void
	{
		$financialPlan
			->updateMainSection($request)
			->updateManufacturingRevenueStreamsSection($request)
			->updateTradingRevenueStreamsSection($request);
			// ->updateRoomSection($request)
			// ->updateFoodSection($request)
			// ->updateCasinoSection($request)
			// ->updateMeetingSection($request)
			// ->updateOtherSection($request)
			// ->updateSalesChannelsSection($request);
	}
	public function formatSelectFor(string $selectedValue): string
	{
		$select = '<select name="selected_interval" class="select select2">';
		$interval = [
			'monthly' => __('Monthly'),
			'quarterly' => __('Quarterly'),
			'semi-annually' => __('Semi Annually'),
			'annually' => __('Annually')
		];
		foreach ($interval as $duration => $durationTranslated) {
			if ($duration == $selectedValue) {
				$select .= ' <option selected value="' . $duration . '">' . $durationTranslated . '</option>  ';
			} else {
				$select .= ' <option value="' . $duration . '">' . $durationTranslated . '</option>  ';
			}
		}
		$select .= "</select>";
		return $select;
	}
	public function paginate(Request $request): array
	{

		$filterData = $this->commonScope($request);

		$allFilterDataCounter = $filterData->count();

		$datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function (FinancialPlan $financialPlan, $index) {

			$financialPlan->creator_name = $financialPlan->getCreatorName();
			//		$financialPlan->created_at_formatted = formatDateFromString($financialPlan->created_at);
			//		$financialPlan->updated_at_formatted = formatDateFromString($financialPlan->updated_at);
			$financialPlan->order = $index + 1;
			$financialPlan->can_view_income_statement_actual_report = $financialPlan->incomeStatement ? $financialPlan->incomeStatement->canViewActualReport() : false;
		});
		return [
			'data' => $datePerPage,
			"draw" => (int)Request('draw'),
			"recordsTotal" => FinancialPlan::onlyCurrentCompany()->count(),
			"recordsFiltered" => $allFilterDataCounter,
		];
	}


	public function commonScope(Request $request): builder
	{
		return FinancialPlan::onlyCurrentCompany()->when($request->filled('search_input'), function (Builder $builder) use ($request) {

			$builder
				->where(function (Builder $builder) use ($request) {
					$builder->when($request->filled('search_input'), function (Builder $builder) use ($request) {
						$keyword = "%" . $request->get('search_input') . "%";
						$builder;
					});
				});
		})
			->orderBy('financial_plans.' . getDefaultOrderBy()['column'], getDefaultOrderBy()['direction']);
	}
}
