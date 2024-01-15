<?php

namespace App\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ImportData implements
        // ToModel,
        ToCollection,
        WithChunkReading,
        ShouldQueue,
        WithCalculatedFormulas,
        WithHeadingRow,
        WithBatchInserts,
        WithEvents

{
    use RegistersEventListeners  ;
    public $timeout = 50000*60;
    public $failOnTimeout = true;

    public static $static_model;
    public static $company_id;
    public $modelFields;
    public $format;
    public $model;
    private $companyId ;
    private $batch ;
    // private $rows = 0 ;

    public function __construct($company_id, $format, $model, $modelFields , $jobId)
    {
        
        Self::$company_id = $company_id;
        Self::$static_model = $model;
        $this->modelFields = $modelFields;
        $this->format = $format;
        $this->model = $model;
        $this->companyId = $company_id ; 
        $this->job_id = $jobId ; 
        // $this->batch = $batch;

    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    // public function getRowCount(): int
    // {
    //     return $this->rows;
    // }

   public function collection(Collection $chunks)
    {
        
        $dates = [];
        foreach($chunks as $key=>$rows)
        {
            $data = $this->dataCustomizationImport($rows);
            $dates[] = $data ; 
            
         }
         
        $key = Str::random(10).'for_company_'.$this->companyId;
        Cache::forever($key , $dates );
        DB::table('caching_company')->insert([
            'key_name'=>$key , 
            'company_id'=>$this->companyId,
            'job_id'=>$this->job_id
        ]);    
        
    }
    
    // public function model(array $row)
    // {
    //     $model_name = 'App\\Models\\' . $this->model;
    //     $data = $this->dataCustomizationImport($row);
        
    //     return new $model_name($data);
    // }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 50000;
    }
    public function dateFormatting($date)
    {
        if (is_numeric($date)) {
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
        } else {
            // logger('date = ' .$date);
            // {{ log }}
            if (str_contains($date, '/')) {
                $this->format = str_replace('-', '/', $this->format);
            }
            // logger('format' . $this->format);
            $strtotimeValue = date_create_from_format($this->format, $date);
            // logger('strtotime' . $strtotimeValue);
            // logger('---------------------');
            $date =  $strtotimeValue->format('Y-m-d');
        }
        return $date ;
    }

    public function dataCustomizationImport($row )
    {
        $data = [];
        $row_with_no_spaces = [];
        foreach ($row as $key => $value) {
            $row_with_no_spaces[trim($key)] = trim($value);
        }

        foreach ($this->modelFields as $field_name => $row_name) {
            if (is_int($row_name)) {
                $data[$field_name] = $row_name;
            } else {
                if (isset($row_with_no_spaces[$row_name])) {
                    if (str_contains($field_name, 'date') || str_contains($field_name, 'Date')) {
                        $data[$field_name] = $this->dateFormatting($row_with_no_spaces[$row_name]);
                    } else {
                        $item = str_replace('\\','',$row_with_no_spaces[$row_name]);
                        $data[$field_name] = trim(preg_replace('/\s+/', ' ', $item)) ;
                    }
                } else {
                    $data[$field_name] = null;
                }
            }
        }
        $data['id'] = generateIdForExcelRow($this->companyId);
        return $data;
    }



}
