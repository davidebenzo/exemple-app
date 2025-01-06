<?php

namespace App\Livewire;

use App\Models\CommercialActivity;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class CommercialActivitiesDelivery extends Component
{
    use WithPagination;
    public $commercialActivityId; // Rinomina da $id a $commercialActivityId

    public $search  = '';

  


    public function render()
    {
 
        if (!$this->commercialActivityId) {
            abort(404, 'ID attività non fornito.');
        }

        // Recupera l'attività commerciale con l'ID specificato
        $commercialActivity = CommercialActivity::findOrFail($this->commercialActivityId);
        $cities = $commercialActivity->deliveryCities()
        ->where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.commercial-activities-delivery', compact('cities'));
    }

}
