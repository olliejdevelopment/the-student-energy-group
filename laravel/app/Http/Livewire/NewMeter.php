<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\meter;

class NewMeter extends Component
{

    public $mpxn;
    public $installation_date;
    public $type;


    public function store()
    {
        $this->validate([
            'mpxn' => 'required',
            'installation_date' => 'required',
            'type' => 'required',
        ]);

        $meter = new meter();
        $meter->mpxn = $this->mpxn;
        $meter->installation_date = $this->installation_date;
        $meter->type = $this->type;
        $meter->save();
        die("Saved");
        // $this->resetInputFields();
        // $this->emit('meterAdded');
    }

    public function render()
    {

        $prefix = ($this->type == 'electricity') ? 'S' : (($this->type == 'gas') ? 'M' : '');
        $this->mpxn = $prefix . preg_replace('/[^0-9]/', '', $this->mpxn);

        return view('livewire.new-meter');
    }
}
