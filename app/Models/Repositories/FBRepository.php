<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\models\FB ; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FBRepository implements IBaseRepository
{

	public function all(): Collection
	{
		return FB::withAllRelations()->onlyCurrentCompany()->get();
	}

	public function allFormatted(): array
	{
		return FB::onlyCurrentCompany()->get()->pluck('name', 'id')->toArray();
	}
	public function allFormattedForSelect()
	{
		$fbs = $this->all();
		return formatOptionsForSelect($fbs, 'getId', 'getName');
	}

	public function getAllExcept($id): ?Collection
	{
		return FB::onlyCurrentCompany()->where('id', '!=', $id)->get();
	}

	public function query(): Builder
	{
		return FB::onlyCurrentCompany()->query();
	}
	public function Random(): Builder
	{
		return FB::onlyCurrentCompany()->inRandomOrder();
	}

	public function find(?int $id): FB
	{
		return FB::onlyCurrentCompany()->find($id);
	}

	public function getLatest($column = 'id'): ?FB
	{
		return FB::onlyCurrentCompany()->latest($column)->first();
	}
	public function store(Request $request): IBaseModel
	{
		$fb = new FB();
		$fb = $fb
			->storeMainSection($request)
			->storeRoomSection($request)
			->storeFoodSection($request)
			->storeCasinoSection($request)
			->storeMeetingSection($request)
			->storeOtherSection($request)
			->storeSalesChannelsSection($request);

		return $fb;
	}

	public function update(IBaseModel $fb, Request $request): void
	{
		$fb
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

		$datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function (FB $fb, $index) {

			$fb->creator_name = $fb->getCreatorName();
			//		$fb->created_at_formatted = formatDateFromString($fb->created_at);
			//		$fb->updated_at_formatted = formatDateFromString($fb->updated_at);
			$fb->order = $index + 1;
			$fb->can_view_income_statement_actual_report = $fb->incomeStatement ? $fb->incomeStatement->canViewActualReport() : false;
		});
		return [
			'data' => $datePerPage,
			"draw" => (int)Request('draw'),
			"recordsTotal" => FB::onlyCurrentCompany()->count(),
			"recordsFiltered" => $allFilterDataCounter,
		];
	}


	public function commonScope(Request $request): builder
	{
		return FB::onlyCurrentCompany()->when($request->filled('search_input'), function (Builder $builder) use ($request) {

			$builder
				->where(function (Builder $builder) use ($request) {
					$builder->when($request->filled('search_input'), function (Builder $builder) use ($request) {
						$keyword = "%" . $request->get('search_input') . "%";
						$builder;
					});
				});
		})
			->orderBy('fbs.' . getDefaultOrderBy()['column'], getDefaultOrderBy()['direction']);
	}
}
