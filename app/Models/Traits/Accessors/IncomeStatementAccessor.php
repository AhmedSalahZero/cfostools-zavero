<?php

namespace App\Models\Traits\Accessors;

use Carbon\Carbon;

trait IncomeStatementAccessor
{
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getCompanyId(): int
    {
        return $this->company->id ?? 0;
    }
    public function getCompanyName(): string
    {
        return $this->company->getName();
    }
    public function getCreatorName(): string
    {
        return $this->creator->name ?? __('N/A');
    }
    public function getIntervalFormatted(): array
    {
        $startDate = Carbon::make($this->start_from);
        if ($this->duration_type == 'annually') {
            $method = 'addYear';
            $endDate = Carbon::make($this->start_from)->addYears($this->duration);
        } else {
            $method = 'addMonth';
            $endDate = Carbon::make($this->start_from)->addMonths($this->duration - 1);
        }
        return \generateDatesBetweenTwoDates($startDate, $endDate, $method, 'M\'Y', false, 'Y-m-d');
    }
    public function hasMainRowPayload(int $incomeStatementItemId): bool
    {
        return $this->subItems()->wherePivot('income_statement_item_id', $incomeStatementItemId)->wherePivot('sub_item_name', null)->exists();
    }
    public function isDependsOn(): bool
    {
        return $this->depends_on;
    }
}
