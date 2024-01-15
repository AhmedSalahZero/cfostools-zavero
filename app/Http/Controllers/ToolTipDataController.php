<?php

namespace App\Http\Controllers;

use App\Models\ToolTipData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ToolTipDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = ToolTipData::groupBy('model_name')->get();

        return view('super_admin_view.tool_tip_data.index',compact('fields'));
    }
    public function sectionFields($id)
    {
        $section = ToolTipData::findOrFail($id);
        $fields = ToolTipData::where('model_name',$section->model_name)->get();


        return view('super_admin_view.tool_tip_data.fields',compact('fields'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('super_admin_view.tool_tip_data.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model_name = $request->model_name;
        $model = 'App\\Models\\' . $model_name;
        $model_obj = new $model;
        $columns  = Schema::getColumnListing($model_obj->getTable());
        $columns = (new ExportTable)->columnsFiltration($columns) ;
        $columns = array_keys($columns);
        $columns = collect($columns)->each(function($field) use($model_name,$request){

            return ToolTipData::create([
                'field' =>$field,
                'model_name' => $model_name,
                'section_name' => $request->section_name,
            ]);
        });
        toastr()->success('Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToolTipData  $toolTipData
     * @return \Illuminate\Http\Response
     */
    public function show(ToolTipData $toolTipData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToolTipData  $toolTipData
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toolTipData = ToolTipData::findOrFail($id);
        return view('super_admin_view.tool_tip_data.edit',compact('toolTipData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToolTipData  $toolTipData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $toolTipData = ToolTipData::findOrFail($id);

        $toolTipData->update(['data' => $request->data]);
        toastr()->success('Updated Successfully');
        return redirect()->back() ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToolTipData  $toolTipData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToolTipData $toolTipData)
    {
        //
    }
}
