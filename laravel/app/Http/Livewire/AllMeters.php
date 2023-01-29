<?php

namespace App\Http\Livewire;

use App\Models\meter;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AllMeters extends Component
{
    private $meters = [];
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';
    public $perPage = 10;
    public $currentPage = 1;

    public function getMeters()
    {
        return $this->meters;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount()
    {
        $this->meters = Meter::join('users', 'meters.user_id', '=', 'users.id')
            ->select(
                'meters.id as id',
                'meters.type as type',
                'meters.mpxn as mpxn',
                'users.id as customer_id',
                'users.name as customer_name',
                'meters.installation_date as installation_date',
                DB::raw("(SELECT COUNT(*) FROM meter_readings WHERE meter_id = meters.id) as number_of_readings"),
                DB::raw("(SELECT created_at FROM meter_readings WHERE meter_id = meters.id ORDER BY created_at DESC LIMIT 1) as last_read")
            )
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('meters.id', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.type', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.mpxn', 'like', '%' . $this->search . '%')
                        ->orWhere('users.name', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.installation_date', 'like', '%' . $this->search . '%');
                }
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        $this->meters = Meter::join('users', 'meters.user_id', '=', 'users.id')
            ->select(
                'meters.id as id',
                'meters.type as type',
                'meters.mpxn as mpxn',
                'users.id as customer_id',
                'users.name as customer_name',
                'meters.installation_date as installation_date',
                DB::raw("(SELECT COUNT(*) FROM meter_readings WHERE meter_id = meters.id) as number_of_readings"),
                DB::raw("(SELECT created_at FROM meter_readings WHERE meter_id = meters.id ORDER BY created_at DESC LIMIT 1) as last_read")
            )
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('meters.id', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.type', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.mpxn', 'like', '%' . $this->search . '%')
                        ->orWhere('users.name', 'like', '%' . $this->search . '%')
                        ->orWhere('meters.installation_date', 'like', '%' . $this->search . '%');
                }
            })
            ->paginate($this->perPage);

        return view('livewire.all-meters', [
            'meters' => $this->meters,
        ]);
    }
}