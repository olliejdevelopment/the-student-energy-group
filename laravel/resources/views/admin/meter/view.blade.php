@extends('layouts.layout')

@section('content')

    <div style="background-color: lightgrey; padding: 10px; margin-bottom: 20px; border-radius: 5px">
        <h3>Meter {{ $meter->mpxn }}</h3>
        <p>Use this page to view information about a meter and it's recent readings.</p>
        {{-- add meter reading button --}}
        <a href="{{ route('admin.meter.custom.reading.add', $meter->id) }}" class="btn btn-primary">Add Meter Reading</a>
    </div>
    <div class="row">
        <div class="col">
            <div style="width: 650px;">
            <table class="table table-striped" style="width: 700px">
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
            <table class="table table-striped" style="width: 700px">
                <thead>
                <tr>
                    <th>Reading ID</th>
                    <th>Reading Date</th>
                    <th>Reading Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($meter_readings as $meter_reading)
                    <tr>
                        <td>{{ $meter_reading->id }}</td>
                        <td>{{ $meter_reading->reading_date }}</td>
                        <td>{{ $meter_reading->reading_value }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col">
    
    <div id="chart_div" style="width: 900px; height: 400px;"></div>

    </div>
</div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
 
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Reading Date');
        data.addColumn('number', 'Reading Value');

        data.addRows([
            @foreach($meter_readings as $meter_reading)
                [ "{{ $meter_reading->reading_date }}", {{ $meter_reading->reading_value }} ],
            @endforeach
        ]);

        var options = {
            title: 'Meter Readings of the past 12 months',
            curveType: 'function',
            legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>

    @endsection
