<?php

namespace App\Http\Controllers;

use App\Exports\HeadersExport;
use App\Models\Company;
use App\Models\CustomizedFieldsExportation;
use App\Models\TablesField;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ExportTable extends Controller
{
    /**
     * Redirect To the View Of fields For Each Model
    */
    public  function customizedTableField(Company $company, $model, $view)
    {
        $model_name = 'App\\Models\\' . $model;
        $model_obj = new $model_name;
        $columns  = Schema::getColumnListing($model_obj->getTable());
        $modelExportableFields = CustomizedFieldsExportation::where('model_name', $model)
        ->where('company_id', $company->id)->first();
        $selected_fields = ($modelExportableFields !== null) ? $modelExportableFields->fields : [];
        if ($view == 'selected_fields') {
            return  $this->columnsFiltration($model,$company,$view ,$selected_fields) ;
        }
        $columnsWithViewingNames =  $this->columnsFiltration($model,$company,$view,$selected_fields);
        return view('client_view.Exportation.fieldsSelectionToBeExported', compact('columnsWithViewingNames', 'company', 'model', 'view', 'selected_fields'));
    }
    /**
     * Saving Chosen Exportable Fields
     */
    public  function customizedTableFieldSave(Request $request,Company $company,$model, $view)
    {
        $this->validation($request);

        $request['company_id'] = $company->id;
        $fields = [];
        $fields = $request['fields'];
        count(array_intersect($fields, ['quantity_discount','cash_discount','special_discount','other_discounts'])) == 0
                ?: $fields[count($fields)] = 'sales_value'  ;
        $fields[count($fields)] = 'net_sales_value'  ;
        $request['fields'] = $fields;

        $modelExportableFields = CustomizedFieldsExportation::where('model_name', $model)
            ->where('company_id', $company->id)->first();
        $modelExportableFields !== null ? $modelExportableFields->update($request->all())
            : CustomizedFieldsExportation::create($request->all());

        $columnsWithViewingNames =$this->columnsFiltration($model,$company,'selected_fields',$request->fields);

        return (new HeadersExport($company->id,$columnsWithViewingNames ))->download($model.'Fields.xlsx');

    }

    /**
     * Filtering Fields and returns Exportable Fields
    */
    public function columnsFiltrationForFirstTime($columns)
    {
        // Columns That Will Be Excluded
        $columnsToBeExcluded = [
            "id",
            "company_id",
            "updated_by",
            "created_by",
            "created_at",
            "updated_at",
            "deleted_at"
        ];

        // Looping Through Columns Needs To Be Excluded
        foreach ($columnsToBeExcluded as $columnToBeExcluded) {
            // Check if the Current column included in the exclusion array To Be unset from the main Array Of Columns
            if (false !== $found = array_search($columnToBeExcluded, $columns)) {
                unset($columns[$found]);
            }
        }
        $columnsWithViewingNames = $this->DisplayFieldsNames($columns);


        return $columnsWithViewingNames;
    }
    public function columnsFiltration($model_name,$company,$view,$selected_fields)
    {
        if ($view == 'selected_fields') {

            $columnsWithViewingNames = TablesField::where('model_name',$model_name)
                                                  ->whereIn('field_name',$selected_fields)
                                                  ->pluck('view_name','field_name')
                                                  ->toArray();
        }else {
            $columnsWithViewingNames = TablesField::where('model_name',$model_name)
                                                  ->pluck('view_name','field_name')
                                                  ->toArray();

        }

        return $columnsWithViewingNames;
    }
    /**
        * Adding Display Name For Each Column
    */
    public function DisplayFieldsNames($columns,$translate=false)
    {

        $columnsWithViewingNames = [];
        array_walk($columns, function ($columnName, $key) use (&$columnsWithViewingNames,$translate) {
            if (str_contains($columnName,'_id_')) {
                $viewingName = ucwords(str_replace('_id_', ' ', $columnName));
            }else{
                $viewingName = ucwords(str_replace('_', ' ', $columnName));
            }
            // if (str_contains($columnName,'product_item')) {
            //     $viewingName = str_replace('Sku', 'Item', $viewingName);

            // }

            $columnsWithViewingNames[$columnName] = $translate === true ?  __($viewingName) : $viewingName;
        });
        return $columnsWithViewingNames;
    }
    /**
     * validation
    */
    public function validation($request)
    {
        $validation = [];
        if (!isset($request->fields) || (count($request->fields) == 0 )) {
            $validation['fields'] = 'required';
        }
        $this->validate($request,@$validation,[
            'fields.required' => __("You must choose fields to be exported into excel sheet"),
        ]);
    }


}
