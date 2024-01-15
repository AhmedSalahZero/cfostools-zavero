<?php

namespace App\Models\Traits\Mutators;

use App\Models\Casino;
use App\Models\Food;
use App\Models\HospitalitySector;
use App\Models\Meeting;
use App\Models\Other;
use App\Models\Room;
use App\Models\SalesChannel;
use Illuminate\Http\Request;

trait FBMutator
{
	protected function getMainFields(): array
	{
		return [
			'creator_id', 'company_id', 'study_name', 'property_name',
			'start_rating', 'star_rating', 'country_id', 'state_id',
			'study_start_date', 'duration_in_years', 'study_end_date',
			'development_start_month', 'development_start_date',
			'development_duration', 'operation_start_month', 'operation_start_date', 'financial_year_start_month', 'main_functional_currency', 'additional_currency', 'exchange_rate', 'corporate_taxes_rate', 'investment_return_rate', 'perpetual_growth_rate',
			'rooms_count', 'average_guest_count',
			'total_f&b_facility_count', 'total_f&b_cover_count',
			'total_casino_cover_count', 'total_casino_facility_count',
			'total_meeting_facility_count', 'total_meeting_cover_count',
			'has_casino_section', 'property_status', 
			'is_total_rooms',
			'is_total_foods',
			'is_total_casinos', 'is_total_meetings', 'has_meeting_section', 'has_other_section', 'is_total_other'
		];
	}

	public function storeMainSection(Request $request)
	{
		$hospitalitySector = HospitalitySector::create($request->except(['_token']));
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$studyDates = $hospitalitySector->getStudyDates() ;
		// dd($studyDates);
		$datesAndIndexesHelpers = $hospitalitySector->datesAndIndexesHelpers($studyDates);
		$datesIndexWithYearIndex=$datesAndIndexesHelpers['datesIndexWithYearIndex']; 
		$yearIndexWithYear=$datesAndIndexesHelpers['yearIndexWithYear']; 
		$dateIndexWithDate=$datesAndIndexesHelpers['dateIndexWithDate']; 
		$dateWithMonthNumber=$datesAndIndexesHelpers['dateWithMonthNumber']; 
		// dd($hospitalitySector);
		$hospitalitySector->updateStudyAndOperationDates($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
	
		return $hospitalitySector;
	}
	public function updateMainSection(Request $request)
	{
		$this->update(array_merge($request->only($this->getMainFields()), [
			'has_other_section' => $request->boolean('has_other_section'),
			'has_meeting_section' => $request->boolean('has_meeting_section'),
			'has_casino_section' => $request->boolean('has_casino_section'),
			'has_food_section' => $request->boolean('has_food_section')
		]));
		$hospitalitySector = $this->fresh();
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$studyDates = $hospitalitySector->getStudyDates() ;
		$datesAndIndexesHelpers = $hospitalitySector->datesAndIndexesHelpers($studyDates);
		$datesIndexWithYearIndex=$datesAndIndexesHelpers['datesIndexWithYearIndex']; 
		$yearIndexWithYear=$datesAndIndexesHelpers['yearIndexWithYear']; 
		$dateIndexWithDate=$datesAndIndexesHelpers['dateIndexWithDate']; 
		$dateWithMonthNumber=$datesAndIndexesHelpers['dateWithMonthNumber']; 
		
		$this->updateStudyAndOperationDates($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		return $this;
	}
	public function storeRoomSection(Request $request)
	{
			foreach ((array) $request->get('rooms') as $roomArray){
				$roomTypeId = is_numeric($roomArray['room_type_id']) ? $roomArray['room_type_id'] : 0;
				$this->rooms()->create(array_merge($roomArray , [
					'name'=> getRoomsTypes()[$roomTypeId]['title'] ?? null ,
					'room_type_id'=>$roomTypeId
				]));
				
			}
		return $this;
	}
	public function updateRoomSection(Request $request)
	{
		$deleteAll = false  ;
		$relationName = 'rooms' ;
		$identifier = Room::getRoomIdentifierColumnName() ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}

	public function storeFoodSection(Request $request)
	{
		if ($request->get('has_food_section') ) {
			foreach ((array) $request->get('foods') as $foodArray)
				$this->foods()->create($foodArray);
		}
		return $this;
	}
	public function updateRepeaterModel(Request $request,bool $deleteAll , string $relationName , string $identifier)
	{
		
		
		
		
		
		if($deleteAll){
			$this->$relationName()->delete();
			return $this ;
		}
		// 
		$oldStoredIds = $this->$relationName->pluck($identifier)->toArray();
		$itemsFromRequest = (array)$request->get($relationName);
		$idsOfRequest = extraKeysFromTwoDimArr($itemsFromRequest,$identifier) ;
		$idsToRemove = array_diff($oldStoredIds , $idsOfRequest);
		$idsToAdd = array_diff($idsOfRequest , $oldStoredIds );
		$idsToKeep = array_intersect($oldStoredIds,$idsOfRequest);
		foreach($idsToKeep as $idToKeep){
			$model = $this->$relationName->where($identifier,$idToKeep)->first() ;
			$data = searchKeyFromTwoDimArray($itemsFromRequest,$identifier,$idToKeep) ;
			$model->update($data);
		}
		foreach($idsToRemove as $idToRemove){
		
			 $this->$relationName->where($identifier,$idToRemove)->first()->delete();
		}
		foreach($idsToAdd as $idsToAdd){
			$data = searchKeyFromTwoDimArray($itemsFromRequest,$identifier,$idsToAdd);
			$this->$relationName()->create($data);
		}
		return $this;
	}
	
	public function updateFoodSection(Request $request)
	{
		$deleteAll =  !$request->get('has_food_section') ;
		$relationName = 'foods' ;
		$identifier = Food::getFoodIdentifierColumnName() ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}

	public function storeCasinoSection(Request $request)
	{
		if ($request->get('has_casino_section') ) {
			foreach ((array) $request->get('casinos') as $casinoArray)
				$this->casinos()->create($casinoArray);
		}
		return $this;
	}

	public function updateCasinoSection(Request $request)
	{
		$deleteAll =  !$request->get('has_casino_section');
		$relationName = 'casinos' ;
		$identifier = Casino::getCasinoIdentifierColumnName() ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
		
	}


	public function storeMeetingSection(Request $request)
	{

		if ($request->get('has_meeting_section') ) {
			foreach ((array) $request->get('meetings') as $meetingArray)
				$this->meetings()->create($meetingArray);
		}
		return $this;
	}

	public function updateMeetingSection(Request $request)
	{
		$deleteAll =  !$request->get('has_meeting_section');
		$relationName = 'meetings' ;
		$identifier = Meeting::getMeetingIdentifierColumnName() ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}
	
	public function storeOtherSection(Request $request)
	{
		if ($request->get('has_other_section') ) {
			foreach ((array) $request->get('others') as $otherArray)
				$this->others()->create($otherArray);
		}
		return $this;
	}
	
	public function updateOtherSection(Request $request)
	{
		$deleteAll =  !$request->get('has_other_section');
		$relationName = 'others' ;
		$identifier = Other::getOtherIdentifierColumnName() ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}
	public function storeSalesChannelsSection(Request $request)
	{
		if ($request->get('has_sales_channels')) {
			foreach ((array) $request->get('salesChannels') as $otherArray)
				$this->salesChannels()->create($otherArray);
		}
		return $this;
	}

	public function updateSalesChannelsSection(Request $request)
	{
		$deleteAll = !$request->get('has_sales_channels');
		$relationName = 'salesChannels' ;
		$identifier = SalesChannel::getSalesChannelIdentifierColumnName() ;
		
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}
	public function updateStudyAndOperationDates(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber)
	{
		$operationDurationDates = $this->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,false);
		
		$studyDurationDates = $this->getStudyDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,false);
		$operationDurationDates = $this->editOperationDatesStartingIndex($operationDurationDates,$studyDurationDates);
		$this->update([
			'study_dates'=>$studyDurationDates,
			'operation_dates'=>$operationDurationDates,
		]);
	}
	protected function editOperationDatesStartingIndex($operationDurationDates,$studyDurationDates){
		$firstIndexInOperationDates = $operationDurationDates[0] ?? null;
		if(!$firstIndexInOperationDates)
		{
			return [];
		}
		$newDates = [];
		$firstIndex = array_search($firstIndexInOperationDates , $studyDurationDates);
		$loop = 0 ;
		foreach($operationDurationDates as $oldIndex=>$value){
				if($loop == 0){
					$newDates[$firstIndex] = $value;
				}else{
					$newDates[]=$value ;
				}
				$loop++;
		}
		return $newDates ;
	}
}
