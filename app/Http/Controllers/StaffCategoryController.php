<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffCategoryRequest;
use App\Http\Requests\UpdateStaffCategoryRequest;
use App\Models\StaffCategory;

class StaffCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStaffCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaffCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffCategory  $staffCategory
     * @return \Illuminate\Http\Response
     */
    public function show(StaffCategory $staffCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffCategory  $staffCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffCategory $staffCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStaffCategoryRequest  $request
     * @param  \App\Models\StaffCategory  $staffCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffCategoryRequest $request, StaffCategory $staffCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffCategory  $staffCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffCategory $staffCategory)
    {
        //
    }
}
