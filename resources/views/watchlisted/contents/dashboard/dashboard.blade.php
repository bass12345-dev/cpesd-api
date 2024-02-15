@extends('watchlisted.layout.watchlisted_master')
@section('title', $title)
@section('content')
@include('includes.title')
@include('watchlisted.contents.dashboard.sections.count')
@include('watchlisted.contents.dashboard.sections.barangay')
@endsection
@section('js')
<script type="text/javascript">


	function load_chart(){
			   $.ajax({
			      url: base_url + '/web/data-per-barangay',
			      method: 'GET',
			      dataType: 'json',
			      success: function (data) {
			      	
			      	try{

			      		// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "horizontalBar",
				data: {
					labels: data.label,
					datasets: [{
						
						backgroundColor: window.theme.danger,
						borderColor: window.theme.danger,
						hoverBackgroundColor: window.theme.danger,
						hoverBorderColor: window.theme.danger,
						data: data.active,
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: true
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: true,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});

			      	} catch(error){
			      		alert('Something Wrong')
			      	}
			      },
			      error: function (xhr, status, error) {},
			   });

}




	document.addEventListener("DOMContentLoaded", function() {
			load_chart();
		});
</script>

@endsection