@extends('layouts.layout')

@section('content')

    <h2>New Meter Reading</h2>
    <p>Use this form to create a new meter reading.</p>
    <br>
    @if($meter)
    @livewire('new-meter-reading', ['meter' => $meter])
    @else
    @livewire('new-meter-reading')
    @endif
@endsection