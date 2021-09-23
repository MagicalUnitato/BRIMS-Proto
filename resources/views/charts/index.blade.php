<!DOCTYPE html>
<head>
    <title>BRIMS Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
        <h2>Average Upload and Download Speed in Mbps per Provider</h2>
        <canvas id="averageSpeed" class="rounded shadow"></canvas>
        <canvas id="monthSpeed" class="rounded shadow"></canvas>
        <form onSubmit="" method="post" id="chartSubmit">
            @csrf
            <select class="custom-select mr-sm-2" name="selectYear" id="selectYear">
                <option selected>Choose Year</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
            </select>
            <select class="custom-select mr-sm-2" name="serviceProviderName" id="serviceProviderName">
                <option selected>Choose Service Provider</option>
                <option value="DITO">DITO</option>
                <option value="GLOBE">GLOBE</option>
                <option value="SMART">SMART</option>
                <option value="PLDT">PLDT</option>
            </select>
            <select class="custom-select mr-sm-2" name="selectStartMonth" id="selectStartMonth">
                <option selected>Choose Starting Month</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select class="custom-select mr-sm-2" name="selectEndMonth" id="selectEndMonth">
                <option selected>Choose Ending Month</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <input type="submit" value="Send">
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- CHARTS -->
<script>
        async function getData(){
            var api_url='http://localhost:8000/api/averageSpeeds';
            const response = await fetch(api_url);
            const data = await response.json();
            var ctx = document.getElementById('averageSpeed').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
        // The data for our dataset
                data: {
                    labels: data.chartDownloadAve.labels,
                    datasets: [
                        {
                            label: "Download",
                            backgroundColor: 'green',
                            data:  data.chartDownloadAve.dataset,
                        },
                        {
                            label: 'Upload',
                            backgroundColor: 'blue' ,
                            data:  data.chartUploadAve.dataset ,
                        },
                    ]
                },
        // Configuration options go here
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {if (value % 1 === 0) {return value;}}
                            },
                            scaleLabel: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: '#122C4B',
                            fontFamily: "'Muli', sans-serif",
                            padding: 25,
                            boxWidth: 25,
                            fontSize: 14,
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 0,
                            bottom: 10
                        }
                    }
                }
            });
    }
getData();
</script>
<script>
    async function getData(){
        //serviceProvider, startMonth, endMonth, startYear,endYear
        //customDateSpeed/{serviceProvider},{startMonth},{endMonth},{startYear},{endYear}
        var api_url='http://localhost:8000/api/customDateSpeed/' + 'DITO' + ',' + 01 + ',' + 12 + ',' + 2020 + ',' + 2021;
        const response = await fetch(api_url);
        const data = await response.json();
        lineChart(data);
    }
    getData();
    
    function lineChart(data){
        console.log(data);
        var ctx = document.getElementById('monthSpeed').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
    // The data for our dataset
            data: {
                labels: data.lineGraphMonthDownload.labels,
                datasets: [
                    {
                        label: 'Download',
                        fill:'false',
                        backgroundColor: 'green',
                        borderColor:'green',
                        data:  data.lineGraphMonthDownload.dataset ,
                    },
                    {
                        label: 'Upload',
                        fill:'false',
                        backgroundColor: 'blue' ,
                        borderColor:'blue',
                        data:  {!! json_encode($lineGraphMonthUpload->dataset)!!} ,
                    },
                ]
            },
    // Configuration options go here
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Line Chart'
                }
                }
            },
        });
    }
</script>
</html>