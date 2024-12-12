<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommercialActivitiesRequest;
use App\Http\Requests\UpdateCommercialActivitiesRequest;
use App\Models\CommercialActivity;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CommercialActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $activities = CommercialActivity::where('user_id', auth()->id())->get();
        return view('commercial-activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $regions = Region::all();
        return view('commercial-activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommercialActivitiesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CommercialActivity $commercialActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommercialActivity $commercialActivity)
    {
        return view('commercial-activities.edit', compact('commercialActivity'));
    }

    /**
     * Update the specified resource in storage.
     */
 

    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommercialActivity $commercialActivity)
    {
        //
    }
}
