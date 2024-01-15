<?php

namespace App\Traits;

use App\Dates\DurationYears;
use App\Traits\GeneralFunctions;
use Carbon\Carbon;

trait Intervals
{
    ## There Are 3 Types Of Intervals
    // 1 - Beginning Balance Interval
    // 2 - End Balance Interval
    // 3 - Intervals Summation
    ################# To Calculate Intervals For Only One Level of Data -OR- Multi arrays Bun In rthe same level Without SubArrays
    public static function intervals($data, $years, $requested_interval , $levels = 'multi',$type_of_interval = 'intervals_summation', $report_with_total = true, $report_with_percentages = true, $show_header_totals = true)
    {
        $first_index = array_key_first($data);

        $years_intervals_months['monthly'] =  (isset($data[$first_index]) && (count($data[$first_index]) > 0)) ? array_keys($data[$first_index]) : [];
        $data_intervals['monthly'] = $levels == 'multi' ? $data : $data[$first_index];


        $data_totals = [];


        if (@count($data) > 0) {
            $years_intervals_months = self::intervalsDates($years_intervals_months, $years ,$requested_interval);

            foreach ($data as $key => $values) {
                $intervalType = is_array($type_of_interval) ? $type_of_interval[$key] : 'intervals_summation';


                // 1 - Beginning Balance Interval
                if ($intervalType == 'beginning_balance_interval') {
                    foreach ($years_intervals_months as $interval => $monthes) {
                        $data_intervals[$interval] = self::beginningBalanceInterval($monthes, $values, $data_intervals, $interval, $key, $levels);
                        $data_intervals[$interval] = self::sortingData($levels, $data_intervals, $interval, $key);
                        $levels == 'multi' ? $data_totals[$interval] = GeneralFunctions::finalTotal($data_intervals[$interval]) : '';
                        $levels == 'multi' ? $data_totals[$interval] = GeneralFunctions::finalTotal($data_intervals[$interval]) : '';
                    }
                }
                // 2 - End Balance Interval
                elseif ($intervalType == 'end_balance_interval') {
                    foreach ($years_intervals_months as $interval => $monthes) {
                        $data_intervals[$interval] = self::endBalanceInterval($monthes, $values, $data_intervals, $interval, $key, $levels);
                        $data_intervals[$interval] = self::sortingData($levels, $data_intervals, $interval, $key);
                        $levels == 'multi' ? $data_totals[$interval] = GeneralFunctions::finalTotal($data_intervals[$interval]) : '';
                    }
                }
                // 3 - Intervals Summation
                elseif ($intervalType == 'intervals_summation') {
                    foreach ($years_intervals_months as $interval => $monthes) {
                        $data_intervals[$interval] = self::intervalsSummation($monthes, $values, $data_intervals, $interval, $key, $levels);
                        $data_intervals[$interval] = self::sortingData($levels, $data_intervals, $interval, $key);
                        $levels == 'multi' ? $data_totals[$interval] = GeneralFunctions::finalTotal($data_intervals[$interval]) : '';
                    }
                }
            }
        }
        return ['data_intervals' => $data_intervals, 'years_intervals_months' => $years_intervals_months, 'data_totals' => $data_totals, 'settings' => ['total' => $report_with_total, 'percentage' => $report_with_percentages, 'show_header_totals' => $show_header_totals]];
    }
    public static function intervalsWithSubArrays($data, $years, $requested_interval,$levels = 'multi', $type_of_interval = 'intervals_summation', $report_with_total = true, $report_with_percentages = true, $show_header_totals = true)
    {
        $intervals = [];
        $settings = [
            'report_with_total' => $report_with_total,
            'report_with_percentages'   => $report_with_percentages,
            'show_header_totals'    => $show_header_totals,
        ];

        foreach ($data as $key => $value) {
            // if there are Two levels of data
            if (!is_array(array_shift(array_shift($value)))) {

                $intervals = self::CalculatingIntervalsForTheValues($intervals, $value, $years, $requested_interval,$levels, $type_of_interval, $key, $settings);
            }
            // If there are Three Levels Of Data
            else {
                foreach ($value as $name_of_sub => $sub_value) {
                    if (is_array(array_shift($sub_value))) {
                        $name_of_sub_array = $name_of_sub;
                        $data_values = $sub_value;
                    }else{
                        $name_of_sub_array = 'one_dimension';
                        $data_values = [$name_of_sub => $value[$name_of_sub]];
                    }
                    $intervals = self::CalculatingIntervalsForTheValues($intervals, $data_values, $years,$requested_interval, $levels, $type_of_interval, $key, $settings, $name_of_sub_array);
                }
            }
        }
        return $intervals;
    }
    public static function CalculatingIntervalsForTheValues($intervals, $value, $years,$requested_interval, $levels, $type_of_interval, $key, $settings, $name_of_sub = null)
    {

        $intervals_per_sub = self::intervals($value, $years,$requested_interval, $levels, $type_of_interval);

        foreach ($intervals_per_sub['data_intervals'] as $interval => $interval_data) {
            $name = $name_of_sub;
            if ($name_of_sub !== null) {
                if($name_of_sub === 'one_dimension'){
                    $name =array_key_first($value);
                    $intervals['data_intervals'][$interval][$key][$name] =  ($intervals_per_sub['data_intervals'][$interval][$name]);
                }else{
                    $intervals['data_intervals'][$interval][$key][$name] =  $intervals_per_sub['data_intervals'][$interval];
                }
                $total= GeneralFunctions::finalTotal($intervals['data_intervals'][$interval][$key][$name]);
                $intervals['data_totals'][$interval] = GeneralFunctions::summationOfTwoArrays($intervals['data_totals'][$interval] ?? [], $total);
                $intervals['years_intervals_months'] = $intervals_per_sub['years_intervals_months'];
                $intervals['settings'] = ['total' => $settings['report_with_total'], 'percentage' => $settings['report_with_percentages'], 'show_header_totals' => $settings['show_header_totals']];
            } else {

                $intervals['data_intervals'][$interval][$key] = $intervals_per_sub['data_intervals'][$interval];
                $intervals['data_intervals'][$interval][$key]['total'] = GeneralFunctions::finalTotal($intervals['data_intervals'][$interval][$key]);
                $intervals['data_totals'][$interval] = GeneralFunctions::summationOfTwoArrays($intervals['data_totals'][$interval] ?? [], $intervals['data_intervals'][$interval][$key]['total']);
                $intervals['years_intervals_months'] = $intervals_per_sub['years_intervals_months'];
                $intervals['settings'] = ['total' => $settings['report_with_total'], 'percentage' => $settings['report_with_percentages'], 'show_header_totals' => $settings['show_header_totals']];
            }
        }
        return $intervals;
    }
    // 1 - Beginning Balance Interval
    public static function beginningBalanceInterval($monthes, $values, $data_intervals, $interval, $key, $levels)
    {
        $total_per_interval = 0;
        $dates = array_unique(array_merge($monthes, array_keys($values)));
        array_multisort(array_map('strtotime', $dates), SORT_ASC, $dates);

        array_walk($dates, function ($date, $index) use ($monthes, $values, $interval, &$data_intervals, &$total_per_interval, $key, $levels) {

            if ($found = false !== array_search($date, $monthes)) {
                $total_per_interval = $values[$date] ?? 0;
                if ($interval == 'quarterly') {
                    $bedinning_date = GeneralFunctions::dateCalc($date, (-2));
                    $total_per_interval = $values[$bedinning_date] ?? 0;
                } elseif ($interval == 'semi_annually') {
                    $bedinning_date = GeneralFunctions::dateCalc($date, (-5));
                    $total_per_interval = $values[$bedinning_date] ?? 0;
                } elseif ($interval == 'annually') {
                    $bedinning_date = GeneralFunctions::dateCalc($date, (-11));
                    $total_per_interval = $values[$bedinning_date] ?? 0;
                }
                $levels == 'multi' ?  $data_intervals[$interval][$key][$date] = $total_per_interval
                    : $data_intervals[$interval][$date] = $total_per_interval;
                $total_per_interval = 0;
            }
        });
        return $data_intervals[$interval];
    }
    // 2 - End Balance Interval
    public static function endBalanceInterval($monthes, $values, $data_intervals, $interval, $key, $levels)
    {
        $total_per_interval = 0;
        $dates = array_unique(array_merge($monthes, array_keys($values)));
        array_multisort(array_map('strtotime', $dates), SORT_ASC, $dates);

        array_walk($dates, function ($date, $index) use ($monthes, $values, $interval, &$data_intervals, &$total_per_interval, $key, $levels) {

            if ($found = false !== array_search($date, $monthes)) {
                $total_per_interval = $values[$date] ?? 0;

                $levels == 'multi' ?  $data_intervals[$interval][$key][$date] = $total_per_interval
                    : $data_intervals[$interval][$date] = $total_per_interval;
                $total_per_interval = 0;
            }
        });
        return $data_intervals[$interval];
    }
    // 3- Intervals Summation
    public static function intervalsSummation($monthes, $values, $data_intervals, $interval, $key, $levels)
    {
        $total_per_interval = 0;
        $dates = array_unique(array_merge($monthes, array_keys($values)));
        array_multisort(array_map('strtotime', $dates), SORT_ASC, $dates);

        array_walk($dates, function ($date, $index) use ($monthes, $values, $interval, &$data_intervals, &$total_per_interval, $key, $levels) {

            if ($found = false !== array_search($date, $monthes)) {
                $total_per_interval += $values[$date] ?? 0;

                $levels == 'multi' ?  $data_intervals[$interval][$key][$date] = $total_per_interval
                    : $data_intervals[$interval][$date] = $total_per_interval;
                $total_per_interval = 0;
            } elseif (isset($values[$date])) {
                $total_per_interval += $values[$date] ?? 0;
            }
        });
        // if($levels == 'multi'){
        //     foreach ($data_intervals[$interval] as $key => $value) {
        //         array_multisort(array_map('strtotime', array_keys($data_intervals[$interval][$key])), SORT_ASC, $data_intervals[$interval][$key]);
        //     }
        // }
        return $data_intervals[$interval];
    }
    // To Calculate The intervals Dates
    public static function intervalsDates($years_intervals_months, $years,$requested_interval='monthly')
    {

        // $years = (new DurationYears)->years($years['start_date'], 0, $years['duration'], 'years_only');

        //Creating Tree Arrays For Each Interval
        // $intervals_names = ['monthly'];

        $intervals = [
            'monthly'  => ['01-01', '01-02', '01-03', '01-04', '01-05', '01-06', '01-07', '01-08', '01-09', '01-10', '01-11', '01-12'],
            'quarterly' => ['01-03', '01-06', '01-09', '01-12'],
            'semi-annually' => ['01-06', '01-12'],
            'annually'  => ['01-12']
        ];


            $counter = 0;
            foreach ($years as $year) {
                foreach ($intervals[$requested_interval] ?? $intervals['annually'] as $interval_name => $month) {
                    $new_month = $month . '-' . $year;
                    $dt = Carbon::parse($new_month);
                    $new_month = $dt->endOfMonth()->format('d-m-Y');
                    $years_intervals_months[$requested_interval][$counter] = $new_month;
                    $counter++;
                }
            }
        return $years_intervals_months;
    }
    // Sorting
    public static function sortingData($levels, $data_intervals, $interval, $key)
    {
        $levels == 'multi' ?
            array_multisort(array_map('strtotime', array_keys($data_intervals[$interval][$key])), SORT_ASC, $data_intervals[$interval][$key])
            :
            array_multisort(array_map('strtotime', array_keys($data_intervals[$interval])), SORT_ASC, $data_intervals[$interval]);
        return $data_intervals[$interval];
    }
}
