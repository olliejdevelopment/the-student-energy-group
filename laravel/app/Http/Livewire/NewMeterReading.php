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
    public $is_estimate;
    public $meter;
    public $reading_value_warning;

    public function render()
    {
        $meters = Meter::all();

        $this->reading_value_warning = '';

        if($this->is_estimate == true){
            if($this->reading_date)
            {
                $previousReading = $this->meter->getLatestReading();

                if (!$previousReading) {
                    $this->reading_value_warning = 'No previous reading found for this meter, but you have selected to estimate the reading.';
                    return view('livewire.new-meter-reading', [
                        'meters' => $meters
                    ]);
                }

                else{
                    $this->reading_value = $this->meter->estimateReading(
                        $this->meter->meter_readings->last()->reading_value,
                        $this->meter->meter_readings->last()->reading_date,
                        $this->meter->estimated_annual_consumption,
                        $this->reading_date
                    );
                }
            
            }

        }

        $previousReading = $this->meter->getLatestReading();
        if(!$previousReading)
        {
            $this->reading_value_warning = 'No previous reading found for this meter.';
        }
        else{
            if($this->reading_value)
            {
                $expectedReading = $this->meter->estimateReading(
                    $this->meter->meter_readings->last()->reading_value,
                    $this->meter->meter_readings->last()->reading_date,
                    $this->meter->estimated_annual_consumption,
                    $this->reading_date
                );
    
                $percentDifference = abs($this->reading_value - $expectedReading) / $expectedReading * 100;
    
                if($percentDifference > 25)
                {
                    $this->reading_value_warning = 'This reading is ' . round($percentDifference - 25) . '% different from the expected reading.';
                    
                }
            }

        }
        
        

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

        $previousReading = $this->meter->getLatestReading();
        if (!$previousReading) {
            if($this->is_estimate == true)
            {
                $this->reading_value_warning = 'No previous reading found for this meter, but you have selected to estimate the reading.';
                return redirect()->back();
            }
        }

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