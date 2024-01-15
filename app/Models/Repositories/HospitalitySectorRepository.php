<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\HospitalitySector;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HospitalitySectorRepository implements IBaseRepository
{

	public function all(): Collection
	{
		return HospitalitySector::withAllRelations()->onlyCurrentCompany()->get();
	}

	public function allFormatted(): array
	{
		return HospitalitySector::onlyCurrentCompany()->get()->pluck('name', 'id')->toArray();
	}
	public function allFormattedForSelect()
	{
		$hospitalitySectors = $this->all();
		return formatOptionsForSelect($hospitalitySectors, 'getId', 'getName');
	}

	public function getAllExcept($id): ?Collection
	{
		return HospitalitySector::onlyCurrentCompany()->where('id', '!=', $id)->get();
	}

	public function query(): Builder
	{
		return HospitalitySector::onlyCurrentCompany()->query();
	}
	public function Random(): Builder
	{
		return HospitalitySector::onlyCurrentCompany()->inRandomOrder();
	}

	public function find(?int $id): HospitalitySector
	{
		return HospitalitySector::onlyCurrentCompany()->find($id);
	}

	public function getLatest($column = 'id'): ?HospitalitySector
	{
		return HospitalitySector::onlyCurrentCompany()->latest($column)->first();
	}
	public function store(Request $request): IBaseModel
	{
		$hospitalitySector = new HospitalitySector();
		$hospitalitySector = $hospitalitySector
			->storeMainSection($request)
			->storeRoomSection($request)
			->storeFoodSection($request)
			->storeCasinoSection($request)
			->storeMeetingSection($request)
			->storeOtherSection($request)
			->storeSalesChannelsSection($request);

		return $hospitalitySector;
	}

	public function update(IBaseModel $hospitalitySector, Request $request): void
	{
		$hospitalitySector
			->updateMainSection($request)
			->updateRoomSection($request)
			->updateFoodSection($request)
			->updateCasinoSection($request)
			->updateMeetingSection($request)
			->updateOtherSection($request)
			->updateSalesChannelsSection($request);
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

		$datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function (HospitalitySector $hospitalitySector, $index) {

			$hospitalitySector->creator_name = $hospitalitySector->getCreatorName();
			//		$hospitalitySector->created_at_formatted = formatDateFromString($hospitalitySector->created_at);
			//		$hospitalitySector->updated_at_formatted = formatDateFromString($hospitalitySector->updated_at);
			$hospitalitySector->order = $index + 1;
			$hospitalitySector->can_view_income_statement_actual_report = $hospitalitySector->incomeStatement ? $hospitalitySector->incomeStatement->canViewActualReport() : false;
		});
		return [
			'data' => $datePerPage,
			"draw" => (int)Request('draw'),
			"recordsTotal" => HospitalitySector::onlyCurrentCompany()->count(),
			"recordsFiltered" => $allFilterDataCounter,
		];
	}


	public function commonScope(Request $request): builder
	{
		return HospitalitySector::onlyCurrentCompany()->when($request->filled('search_input'), function (Builder $builder) use ($request) {

			$builder
				->where(function (Builder $builder) use ($request) {
					$builder->when($request->filled('search_input'), function (Builder $builder) use ($request) {
						$keyword = "%" . $request->get('search_input') . "%";
						$builder;
					});
				});
		})
			->orderBy('hospitality_sectors.' . getDefaultOrderBy()['column'], getDefaultOrderBy()['direction']);
	}
}
