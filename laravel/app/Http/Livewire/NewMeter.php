<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\meter;

class NewMeter extends Component
{

    public $mpxn;
    public $installation_date;
    public $type;
    public $user_id;
    public $type_warning;
    public $estimated_annual_consumption;
    public $estimated_annual_consumption_warning;

    public function store()
    {
        $this->validate([
            'mpxn' => 'required|alpha_num',
            'installation_date' => 'required',
            'type' => 'required',
            'user_id' => 'required|exists:users,id',
            'estimated_annual_consumption' => 'required|numeric'

        ]);
    
        if ($this->type === 'electricity') {
            $this->validate([
                'mpxn' => 'required|alpha_num|starts_with:S|size:21',
            ]);
        } else if ($this->type === 'gas') {
            $this->validate([
                'mpxn' => 'required|alpha_num|starts_with:M|size:10',
            ]);
        }

        $meter = new meter();
        $meter->mpxn = $this->mpxn;
        $meter->installation_date = $this->installation_date;
        $meter->type = $this->type;
        $meter->user_id = $this->user_id;
        $meter->estimated_annual_consumption = $this->estimated_annual_consumption;
        $meter->save();

        return redirect()->route('admin.meter.index');

    }

    public function render()
    {

        $prefix = ($this->type == 'electricity') ? 'S' : (($this->type == 'gas') ? 'M' : '');
        $this->mpxn = $prefix . preg_replace('/[^0-9]/', '', $this->mpxn);

        if($this->estimated_annual_consumption)
        {
            if($this->estimated_annual_consumption < 2000 || $this->estimated_annual_consumption > 8000)
            {
                $this->estimated_annual_consumption_warning = 'Estimated annual consumption is ususally expected to be between 2000 and 8000';
            }
            else{
                $this->estimated_annual_consumption_warning = '';
            }
        }


        return view('livewire.new-meter', [
            'users' => \App\Models\User::all(),
        ]);
    }
}
