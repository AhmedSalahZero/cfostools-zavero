<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('super_admin_view.sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_sections  = Section::mainSections()->orderBy('order')->get();
        $sub_sections  = Section::where('sub_of','!=',0)->orderBy('order')->get();

        return view('super_admin_view.sections.form',compact('main_sections','sub_sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = Section::create($request->all());
        // $section->route !== null ? $this->permissionsForSections($section) : "";
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $main_sections  = Section::mainSections()->orderBy('order')->get();
        $sub_sections  = Section::where('sub_of','!=',0)->orderBy('order')->get();

        return view('super_admin_view.sections.form',compact('section','main_sections','sub_sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $section->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
    public function permissionsForSections($section)
    {
        $route = $section->route;
        $route_array = explode('.',$route);
        $route = $route_array[0];
        Permission::create(['name' => 'view '.$route]);
        Permission::create(['name' => 'create '.$route]);
        Permission::create(['name' => 'edit '.$route]);
        Permission::create(['name' => 'delete '.$route]);
    }
}
