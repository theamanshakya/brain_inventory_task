<html>

<head>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/script.js') }}"></script>
    <style>
        .card {
            box-shadow: 0px 0px 10px gainsboro;
            padding: 20px;
            border-radius: 20px;
            overflow-x: scroll;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var res = null
        var start = null
        var end = null
        var months = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                start = start.format('YYYY-MM-DD');
                end = end.format('YYYY-MM-DD');
                var myJsonData = {
                    from: start,
                    to: end
                }
                $.get('/tripValues/inrange', myJsonData, function (response) {
                    console.log(response);
                    res = response;
                    google.charts.setOnLoadCallback(drawChart1, res);
                })
            });
        });

        $.get('/tripValues', function (response) {
            res = response;
            google.charts.setOnLoadCallback(drawChart1, res);
        })

        google.charts.load("current", {
            packages: ["corechart"]
        });

        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['In Discussion', res.inDiscCount],
                ['Accepted', res.acceptedCount],
                ['Rejected', res.rejectedCount],
            ]);

            var options = {
                title: 'Quotes',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }

        var res2 = null

        // REFERRENCE

        $(function () {
            $('input[name="daterange2"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                start = start.format('YYYY-MM-DD');
                end = end.format('YYYY-MM-DD');
                var myJsonData = {
                    from: start,
                    to: end
                }
                $.get('/anotherCount/inrange', myJsonData, function (response) {
                    console.log(response);
                    res2 = response;
                    google.charts.setOnLoadCallback(drawChart2, res2);
                })
            });
        });

        // REFERRENCE

        $.get('/anotherCount', function (response) {
            res2 = response;
            google.charts.setOnLoadCallback(drawChart2, res2);
        })

        google.charts.load("current", {
            packages: ["corechart"]
        });

        function drawChart2() {


            var data2 = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['In Progress', res2.inProgress],
                ['Completed', res2.completed],
                ['Cancelled', res2.cancelled],
            ]);

            var options2 = {
                title: 'Trip',
                pieHole: 0.4,
            };

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);
        }

        // column chart
        res3 = null

        // TODO

        $('filter').change(function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            console.log(valueSelected);
        });

        var myJsonData = {
            from: start,
            to: end
        }

        $.get('/tripFilter', myJsonData, function (response) {
            res3 = response;
            google.charts.setOnLoadCallback(drawChart3, res3);
        })

        $.get('/commission', function (response) {
            res3 = response;
        })

        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart3, res3);
        function drawChart3() {

            var trips = [
                ['Trip Name', 'Booking Cost', 'Commission Cost']
            ];

            res3.forEach(element => {
                trips.push([element.trip_name, element.booking_cost, element.commission_cost]);
            });

            var data3 = google.visualization.arrayToDataTable(trips);

            var options3 = {
                chart: {
                    title: 'Trips Commission',
                }
            };

            var chartc = new google.charts.Bar(document.getElementById('columnchart_material'));

            chartc.draw(data3, google.charts.Bar.convertOptions(options3));
        }

        // line chart
        var res4;
        google.charts.load('current', { 'packages': ['line'] });
        google.charts.setOnLoadCallback(drawChart4);
        var myJsonData = {
            from: start,
            to: end
        }

        $.get('/tripFilter', myJsonData, function (response) {
            res4 = response;
            google.charts.setOnLoadCallback(drawChart3, res4);
        })

        $.get('/sales', function (response) {
            var salesPerformance = [];
            res4 = response;
            var currentMonth = 0;
            var prevMonth = 0;
            var currentSum = 0;
            console.log("Hello");
            for (let index = 0; index < res4.length; index++) {
                const element = res4[index];
                var tempMonth = new Date(element.booking_date).getMonth();
                currentMonth = prevMonth;
                console.log(tempMonth);

                if (tempMonth == currentMonth) {
                    currentSum += element.booking_cost;
                    salesPerformance.push([currentMonth , currentSum]);
                } else {
                    salesPerformance.push([currentMonth , currentSum]);
                    currentSum = 0;
                    prevMonth++;
                }
            }
            console.log(salesPerformance);
            drawChart4(salesPerformance);
        })


        function drawChart4(salesPerformance) {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Month');
            data.addColumn('number', 'Total Booking Cost');

            data.addRows(
              salesPerformance
            );

            var options = {
                chart: {
                    title: 'Sales Performance',
                },
                width: 900,
                height: 500
            };

            var chart = new google.charts.Line(document.getElementById('linechart_material'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>
</head>

<body>

    <div class="container w-4/5 md:w-3/4  m-auto my-6">
        <div class="grid grid-cols-2 gap-4">
            <div class="card">
                <input class="p-3 border rounded-lg" type="text" name="daterange" value="01/02/2021 - 01/03/2021" />

                <div id="donutchart" class="w-full h-96"></div>
            </div>

            <div class="card">
                <input class="p-3 border rounded-lg" type="text" name="daterange2" value="01/02/2021 - 01/03/2021" />

                <div id="donutchart2" class="w-full h-96"></div>

            </div>
            <div class="card col-span-2">
                <select class="px-4 py-2 border rounded-lg" name="filter" id="filter">
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>

                <div id="columnchart_material" class="w-full mt-8 h-96"></div>

            </div>
            <div class="card col-span-2">
                <select class="px-4 py-2 border rounded-lg" name="filter" id="linechartFilter">
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>

                <div id="linechart_material" class="w-full mt-8 h-96"></div>

            </div>
        </div>
    </div>
</body>

</html>
