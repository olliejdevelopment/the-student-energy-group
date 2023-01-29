<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\meterReading;
use App\Models\meter;

class BackgroundImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:readings {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import meter readings from a CSV file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->argument('file');

        if (!file_exists($file)) {
            $this->error("File $file not found");
            return;
        }

        $data = file_get_contents($file);
        $data = explode(PHP_EOL, $data);

        foreach ($data as $key => $value) {

            if (!$value) {
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
                $this->error("Error : Row $key - Reading $reading_value for meter $mpxn on $reading_date failed to import.");
            } else {
                $meter = DB::table('meters')->where('mpxn', $mpxn)->first();

                $meterReading = new MeterReading();
                $meterReading->reading_value = $reading_value;
                $meterReading->reading_date = $reading_date;
                $meterReading->meter_id = $meter->id;
                $meterReading->is_estimated = 0;
                $meterReading->save();

                $this->info("Success : Row $key - Reading $reading_value for meter $mpxn on $reading_date imported successfully.");
            }
        }

        $this->info("Import complete");
    }



}
