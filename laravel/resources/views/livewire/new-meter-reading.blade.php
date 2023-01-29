<div>
    <form wire:submit.prevent="storeReading">
        <div class="form-group">
            <label for="meter_id">Meter</label>
            {{-- if meter_id_set lock select --}}
            
            @if($meter_id_set)
            <input type="text" class="form-control" value="{{ $meter->mpxn }}" disabled>
            @else

            <select wire:model.lazy="meter_id" class="form-control @error('meter_id') is-invalid @enderror" id="meter_id">
                
                <option value="">Select Meter</option>
                @foreach($meters as $meter)
                <option value="{{ $meter->id }}">{{ $meter->mpxn }}</option>
                @endforeach
            </select>
            @endif
            @error('meter_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="reading_date">Reading Date</label>
            <input type="date" wire:model.lazy="reading_date" class="form-control @error('reading_date') is-invalid @enderror" id="reading_date" placeholder="Enter Reading Date">
            @error('reading_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- is_estimate --}}
        <div class="form-group">
            <label for="is_estimate">Is Estimate</label>
            <select wire:model.lazy="is_estimate" class="form-control @error('is_estimate') is-invalid @enderror" id="is_estimate">
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('is_estimate')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reading">Reading</label>
            <input type="text" wire:model.lazy="reading_value" class="form-control @error('reading_value') is-invalid @enderror" id="reading_value" placeholder="Enter Reading">
            @if($reading_value_warning)
            <div style="color: orange">
                {{ $reading_value_warning }}
            </div>
            @endif
            @error('reading_value')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @if (session()->has('message'))
    <div class="alert alert-success mt-3">
        {{ session('message') }}
    </div>
@endif
</div>