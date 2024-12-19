<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommercialActivitiesRequest;
use App\Http\Requests\UpdateCommercialActivitiesRequest;
use App\Models\CommercialActivity;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str; 

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
    public function show($id, $slug)
    {
        // Recupera l'attività commerciale con l'ID specificato
        $commercialActivity = CommercialActivity::findOrFail($id);
    
        // Verifica che lo slug corrisponda al nome dell'attività (ad esempio "ragione-sociale-attivita")
        if ($slug !== Str::slug($commercialActivity->company)) {
            // Se lo slug non corrisponde, reindirizza all'URL corretto
          
            return redirect()->route('commercial-activities.show', [
                'id' => $commercialActivity->id,
                'slug' => Str::slug($commercialActivity->company),
            ]);
        }
    
        // Restituisci la vista o il contenuto desiderato
        $cities = $commercialActivity->deliveryCities()->paginate(10);
        return view('commercial-activities.show', compact('commercialActivity', 'cities'));
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
