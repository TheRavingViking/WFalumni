@extends('layouts.app')

@section('content')
    <html>
    <head>
        <script type="text/javascript">
            google.charts.load("upcoming", {packages:["map"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Lat', 'Long', 'Name'],
                    [37.4232, -122.0853, 'Work'],
                    [37.4289, -122.1697, 'University'],
                    [37.6153, -122.3900, 'Airport'],
                    [37.4422, -122.1731, 'Shopping']
                ]);

                var map = new google.visualization.Map(document.getElementById('map_div'));
                map.draw(data, {
                    showTooltip: true,
                    showInfoWindow: true
                });
            }

        </script>
    </head>

    <body>
    <div id="map_div" style="width: 100%; height: 100%"></div>
    </body>
    </html>
@endsection