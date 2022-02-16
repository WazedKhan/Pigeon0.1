@extends('admin.master')
@section('content')
<div class="card" style="width: 18rem;">
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




@endsection