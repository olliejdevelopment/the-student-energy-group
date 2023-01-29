@extends('layouts.layout')

@section('content')

    <h2>Meter {{ $meter->mpxn }}</h2>
    <p>Use this page to view information about a meter and it's recent readings.</p>

        <table class="table table-striped" style="width: 600px">
          <tbody>
            <tr>
              <th>ID</th>
              <td>{{ $meter->id }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $meter->created_at }}</td>
            <tr>
              <th>Type</th>
              <td>{{ $meter->type }}</td>
            </tr>
            <tr>
              <th>MPXN</th>
              <td>{{ $meter->mpxn }}</td>
            </tr>
            <tr>
              <th>Customer Name</th>
              <td>{{ $meter->user->name }}</td>
            </tr>
            <tr>
              <th>Installation Date</th>
              <td>{{ $meter->installation_date }}</td>
            </tr>
            <tr>
              <th>Number of Readings</th>
              <td>{{ $meter_readings->count() }}</td>
            </tr>
          </tbody>
        </table>
      </div>

@endsection
