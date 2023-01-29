# THE STUDENT ENERGY GROUP
Software Developer Technical Test

## Introduction

**Ollie Fulleylove's** submission for the Student Energy Group Software Developer Technical Test. This is a simple Laravel web application that allows users to create and manage Meter and Meter Reading records.

### Packages Used
1. [Laravel](https://laravel.com/)
2. [Laravel Jetstream](https://jetstream.laravel.com/1.x/introduction.html)
3. [Spatie Laravel Permission]
4. [Laravel Excel](https://docs.laravel-excel.com/3.1/getting-started/installation.html)

## Installation
1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Run `php artisan migrate`
6. Run `php artisan serve`

## Task 1 - Database
The database used for this project is MySQL. The database migrations can be found in the `database/migrations` directory.

There are no seeders for this project.

The database connection details can be found in the `.env` file.

There are two models in this project, `Meter` and `MeterReading`. The `Meter` model has a one-to-many relationship with the `MeterReading` model. The `Meter` Model also has a many-to-many relationship with the `User` model. Foreign keys are used to link the models together.

## Task 2 - Meters

All Meters have a MPXN identifier. Meters can be either `Gas` or `Electricity`. 
`Gas` meters have a 21 character MPXN identifier starting with M
`Electricity` meters have a 10 character MPXN identifier starting with S.
### Create a Meter
1. Click on the `Meters` link in the navigation bar.
2. Click on the `Create Meter` button.
3. Enter the required details and click on the `Create Meter` button.

### Browse Meters
1. Click on the `Meters` link in the navigation bar.
2. Use the search bar to search through the meters. 
3. To sort the meters, click on the column headings.

### View a Meter
1. Click on the `Meters` link in the navigation bar.
2. Click on the `MPXN` identifier on the meter you want to view.

## Task 3 - Meter Readings

Meter readings are associated with a meter. Each meter reading has a reading date and a reading value. 

### Create a Meter Reading

1. Click on the `Meters` link in the navigation bar.
2. Click on the `MPXN` identifier on the meter you want to add a reading to.
3. Click on the `Create Meter Reading` button.
4. Enter the required details and click on the `Create Meter Reading` button.

### Browse Meter Readings
1. Click on the `Meters` link in the navigation bar.
2. Click on the MPXN of the meter you want to view the readings for.

## Task 4 - Estimated Readings (Optional A)

### Create an Estimated Reading
1. Click on the `Meters` link in the navigation bar.
2. Click on the `MPXN` identifier on the meter you want to add an estimated reading to.
3. Click on the `Create Estimated Reading` button.
4. Set the estimate select to yes. 

### Validation
- If there are no meter readings for the meter, then no estimated reading will be created.
- If a reading is more than 25% different than an estimated reading, then a warning will be displayed. The user can still create the reading.

## Task 5 - Upload Meter Readings (Optional B)

## Simple Upload
1. Click on the `Meters` link in the navigation bar.
2. Click on simple upload

## Background Upload
1. Click on the `Meters` link in the navigation bar.
2. Click on background upload

Both of these pages use the same validation. A file with 3 columns is expected, no headings. 
- The first column is the reading value
- The second column is the reading date
- The third column is the MPXN

The background process uses a artisan command to process the file. The command can be run using `php artisan process:readings {file}`. The file is expected to be in the `storage/app` directory.

the background process also uses a queue to process the readings. The queue can be run using `php artisan queue:work`.





