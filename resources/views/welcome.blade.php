<!DOCTYPE html>
<html>
<head>
    <title>BRIMS Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Raw Data</h2>
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Provider</th>
                    <th>Upload</th>
                    <th>Download</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Date Created</th>
                    <th>Time Created</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">Charts</h2>
        <form action="{{url('data/getProvider')}}" method="get">
            {{csrf_field()}}
             <div class="form-group">
               <label for="stockPrice">Service Provider:</label>
               <select class="selectpicker" name="serviceProvider">
                  <option value="DITO">DITO</option>
                  <option value="SMART">SMART</option>
                  <option value="GLOBE">GLOBE</option>
                  <option value="PLDT">PLDT</option>
                  <option value="CONVERGE">CONVERGE</option>
              </select>
            </div>
             <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div>
            <canvas id="averageDay"></canvas>
        </div>
    </div>  
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('data.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'serviceProvider', name: 'serviceProvider'},
            {data: 'upload', name: 'upload'},
            {data: 'download', name: 'download'},
            {data: 'longitude', name: 'longitude'},
            {data: 'latitude', name: 'latitude'},
            {data: 'created_at', name: 'created_at'},
            {data: 'time_created', name: 'time_created'},
        ]
    });
    
  });
</script>
<script type="text/javascript">

</script>
</html>