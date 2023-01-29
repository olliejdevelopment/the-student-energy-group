<div>
    <form wire:submit.prevent="upload">
        <div class="form-group">
            <label for="file">Upload CSV file</label>
            <input type="file" wire:model="file" class="form-control" id="file">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button> @if($processing) <span class="text-success">Processing...</span> @endif
    </form>

    <br><br>
    <h4>Log</h4>
    <div style="width: 100%; background-color: #F5F5F5; padding: 10px; border: 1px solid lightgrey">
        
        {!! $log !!}
    </div>


    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        
</div>

