<?php

namespace App\Http\Livewire;

use App\Models\meterReading;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class UploadCsv extends Component
{
    use WithFileUploads;

    public $reading_value;
    public $reading_date;
    public $meter_mpxn;
    public $file;
    public $log;
    public $processing = false;

    public function render()
    {
        return view('livewire.upload-csv');
    }

    public function upload()
    {
        $this->processing = true;
        $validator = Validator::make(
            [
                'file' => $this->file,
                'extension' => strtolower($this->file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required',
                'extension' => 'required|in:csv',
            ]
        );

        if ($validator->fails()) {
            $this->processing = false;
            session()->flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        $path = $this->file->store('temp');

        $data = file_get_contents(storage_path('app/' . $path));
        $data = explode(PHP_EOL, $data);

        foreach ($data as $key => $value) {

            if(!$value){
                continue;
            }
            $value = explode(',', $value);

            $reading_value = $value[0];
            $reading_date = $value[1];
            $mpxn = $value[2];

            $validator = Validator::make(
                [
                    'reading_value' => $reading_value,
                    'reading_date' => $reading_date,
                    'meter_mpxn' => $mpxn,
                ],
                [
                    'reading_value' => 'required|numeric|int|min:0',
                    'reading_date' => 'required|date|date_format:Y-m-d',
                    'meter_mpxn' => 'required|exists:meters,mpxn',
                ]
            );

            if ($validator->fails()) {
                $this->log .= "Error : Row $key - Reading $reading_value for meter $mpxn on $reading_date failed to import.<br>";
            }
            else{
                $meter = DB::table('meters')->where('mpxn', $mpxn)->first();
        
                $meterReading = new meterReading();
                $meterReading->reading_value = $reading_value;
                $meterReading->reading_date = $reading_date;
                $meterReading->meter_id = $meter->id;
                $meterReading->is_estimated = '0';
                $meterReading->save();

                $this->log .= "Success : Row $key - Reading $reading_value for meter $mpxn on $reading_date imported successfully.<br>";

            }

        }
        $this->processing = false;
        session()->flash('success', 'Data imported successfully.');
        return redirect()->back();
    }
}
