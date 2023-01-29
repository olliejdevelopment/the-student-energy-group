@extends('layouts.layout')

@section('content')

    <h2>Foreground Uploader</h2>
    <p>Upload a small file to be processed in realtime.</p>
    <br>
    @livewire('upload-csv')
@endsection