@extends('layouts.layout')

@section('content')

    <h2>Background Uploader</h2>
    <p>Use this file uploader to submit a large file to be processed by <pre style="border: 1px solid lightgrey; padding: 4px">Artisan::queue import:readings {file}</pre></p>
    <br>
    @livewire('upload-csv-background')
@endsection