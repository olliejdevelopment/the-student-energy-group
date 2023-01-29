<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\meter;
use App\Models\meterReading;

class NewMeterReading extends Component
{
    public $meter_id;
    public $reading_value;
    public $reading_date;
    public $meter_id_set;

    public function render()
    {
        $meters = Meter::all();

        return view('livewire.new-meter-reading', [
            'meters' => $meters
        ]);
    }

    public function mount($meter)
    {
        $this->meter_id_set = $meter;
        $this->meter = $meter;
        $this->meter_id = $meter->id;
    }

    public function storeReading()
    {
        $this->validate([
            'meter_id' => 'required|exists:meters,id',
            'reading_value' => 'required|numeric',
            'reading_date' => 'required|date'
        ]);

        // Add your logic to store the meter reading here
        $meter_reading = new meterReading;
        $meter_reading->meter_id = $this->meter_id;
        $meter_reading->reading_value = $this->reading_value;
        $meter_reading->reading_date = $this->reading_date;
        $meter_reading->save();

        session()->flash('message', 'Meter Reading added successfully.');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        // $this->meter_id = null;
        $this->reading_value = null;
        $this->reading_date = null;
    }
}