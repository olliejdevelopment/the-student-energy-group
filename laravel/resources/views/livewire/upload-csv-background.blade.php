<div>
    <form wire:submit.prevent="upload">
        <input type="file" wire:model="file">
        <button type="submit">Upload</button>
    </form>

    @if($isProcessing)
        <div>
            {{ $output }}
        </div>
    @endif
</div>