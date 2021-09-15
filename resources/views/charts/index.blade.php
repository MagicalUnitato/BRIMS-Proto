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
        <form action="{{action('ChartController@index')}}" method="post">
            <select class="custom-select mr-sm-2" id="selectYear">
                <option selected>Choose Year</option>
            </select>
            <select class="custom-select mr-sm-2" id="selectStartMonth">
                <option selected>Choose Starting Month</option>
            </select>
            <select class="custom-select mr-sm-2" id="selectEndMonth">
                <option selected>Choose Ending Month</option>
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
    var ctx = document.getElementById('averageSpeed').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
// The data for our dataset
        data: {
            labels:  {!!json_encode($chartUploadAve->labels)!!} ,
            datasets: [
                {
                    label: 'Download',
                    backgroundColor: 'green',
                    data:  {!! json_encode($chartDownloadAve->dataset)!!} ,
                },
                {
                    label: 'Upload',
                    backgroundColor: 'blue' ,
                    data:  {!! json_encode($chartUploadAve->dataset)!!} ,
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
</script>
<script>
    var select = document.getElementById("selectStartMonth"); 

    for(var i = 0; i < 12; i++){
        var opt = i;
        var el = document.createElement("option");
        el.textContent = opt;
        el.value = opt;
        select.appendChild(el);
    }​
</script>
</html>