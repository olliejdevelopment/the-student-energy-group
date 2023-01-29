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
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPAN">
            @elseif($type == "gas")
            <label for="mpxn">MPRN</label>
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPRN">
            @else
            <label for="mpxn">MPXN</label>
                <input type="text" wire:model.lazy="mpxn" class="form-control @error('mpxn') is-invalid @enderror" id="mpxn" placeholder="Enter MPXN">
            @endif
            
            @error('mpxn')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
