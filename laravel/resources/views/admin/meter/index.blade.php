@extends('layouts.layout')

@section('content')

    <h2>All Meters</h2>
    <p>Use this table to list, sort and search through all meters.</p>
    <br>
    <a class="btn btn-primary" href="{{ route('admin.meter.add') }}">Create Meter</a>
    <a class="btn btn-success" href="{{ route('admin.upload.frontend') }}">Simple Upload</a>
    <a class="btn btn-success" href="{{ route('admin.upload.backend') }}">Background Upload</a>
    <br>
    <br>
    @livewire('all-meters')
@endsection