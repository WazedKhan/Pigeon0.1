@extends('admin.master')
@section('content')
<div id="divToPrint">
<div class="card-deck">
	<div class="card">
	  <div class="card-body">
		<h5 class="card-title text-center">Users</h5>
        <p class="card-text">In previous 
        <form action="{{ route('admin.home') }}" method="get">
          @csrf
          <input type="number" name="search" value="{{ $search }}">
        </form>  
          <h6 class="card-title text-center">days new users are: <strong class="text-primary">{{ $data->count() }}</strong> </h6></p>
	  </div>
	</div>
	<div class="card">
	  <div class="card-body">

		<!DOCTYPE html>
<html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<body>
<div
id="myChart" style="width:600%; max-width:300px; height:300px;">
</div>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Contry', 'Mhl'],
  ['Blocked',{{ $blocked->count() }}],
  ['Online',{{ $online->count() }}],
  ['Offline',{{ $offline->count() }}],
]);

var options = {
  title:'User Info'
};

var chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>

</body>
</html>

	  </div>
	</div>
  </div>

<br> <br>


<!DOCTYPE HTML>
<html>
<head>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "Current Inforamtion of the Pigeon"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "column",
			dataPoints: [
				{ label: "User",  y: {{ $data->count() }}  },
				{ label: "Post", y: {{ $post->count() }}  },
				{ label: "Groups", y: {{ $group->count() }}  },
				{ label: "Image",  y: {{ $group->count() }}  },
				{ label: "Shares",  y: {{ $share->count() }}  }
			]
		}
		]
	});
	chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>
</div>
 <br> <br>
<input class="btn btn-primary text-center" type="button" onClick="PrintDiv('divToPrint');" value="Print">
   
@endsection
<script language="javascript">
    function PrintDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>