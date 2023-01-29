<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Livewire\WithFileUploads;

class UploadCsvBackground extends Component
{
    use WithFileUploads;

    public $file;
    public $output = '';
    public $isProcessing = false;

    public function render()
    {
        return view('livewire.upload-csv-background');
    }

    public function upload()
    {
        $this->validate([
            'file' => 'required|file|mimes:csv',
        ]);

        $path = Storage::putFile('temp', $this->file);
        $filePath = Storage::path($path);

        $this->isProcessing = true;
        Artisan::queue('import:readings', ['file' => $filePath]);
        $this->output = 'Processing file. Please wait ...';

    }

    public function updatedOutput($output)
    {
        $this->output = $output;

        if ($output == 'Processing complete.') {
            $this->isProcessing = false;
        }
    }
}
