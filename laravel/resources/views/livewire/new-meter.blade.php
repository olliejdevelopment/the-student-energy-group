{{-- mpan = ELEC 21 digit starting with S --}}
{{-- mprn = GAS 10 digit starting with M --}}

<div>
    <form wire:submit.prevent="store">
        <div class="form-group">
            <label for="type">Type</label>
            <select wire:model.lazy="type" class="form-control @error('type') is-invalid @enderror" id="type">
                <option value="">Select Type</option>
                <option value="electricity">Electricity</option>
                <option value="gas">Gas</option>
            </select>
            @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            
            @if($type == "electricity")
                <label for="mpxn">MPAN</label>
                <span class="badge badge-warning">21 digits starting with S</span>
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPAN">
            @elseif($type == "gas")
                <label for="mpxn">MPRN</label>
                <span class="badge badge-warning">10 digits starting with S</span>
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPRN">
            @else
                <label for="mpxn">MPXN</label>
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPXN">
            @endif
            
            @error('mpxn')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="installation_date">Installation Date</label>
            <input type="date" wire:model.lazy="installation_date" class="form-control @error('installation_date') is-invalid @enderror" id="installation_date" placeholder="Enter Installation Date">
            @error('installation_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_id">Customer</label>
            <select wire:model.lazy="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                <option value="">Select Customer</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="estimated_annual_consumption">Estimated Annual Consumption</label>
            <input type="text" wire:model.lazy="estimated_annual_consumption" class="form-control @error('estimated_annual_consumption') is-invalid @enderror" id="estimated_annual_consumption" placeholder="Enter Estimated Annual Consumption">
            @if($estimated_annual_consumption_warning)
            <div style="color: orange">
                {{ $estimated_annual_consumption_warning }} 
            </div>
            @endif
            @error('estimated_annual_consumption')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
