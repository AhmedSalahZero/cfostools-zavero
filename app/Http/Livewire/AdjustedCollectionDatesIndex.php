<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AdjustedCollectionDate;
use Illuminate\Http\Request;

class AdjustedCollectionDatesIndex extends Component
{


    public function mount()
    {
        $this->adjusted_collection_dates = AdjustedCollectionDate::all();
    }
    public function store()
    {
        $this->validate();

        AdjustedCollectionDate::create([
            'date' => $this->date,
        ]);
        $this->emitSelf('store');
        $this->adjusted_collection_dates = AdjustedCollectionDate::all();
    }
    public function render()
    {
        return view('livewire.adjusted-collection_dates.form')->extends('layouts.dashboard');
    }
    public function delete($id)
    {
        AdjustedCollectionDate::findOrFail($id)->delete();
        $this->emitSelf('delete_row');
        $this->adjusted_collection_dates = AdjustedCollectionDate::all();
    }
}
