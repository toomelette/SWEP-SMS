<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<title>Dissemination Log</title>

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

		<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/print.css') }}">

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

		<style type="text/css">

		.arrow {
			position: absolute;
			overflow: hidden;
			display: inline-block;
			font-size: 3px;
			width: 3em;
			height: 3em;
			border-top: 2px solid black;
			border-right: 2px solid black ;
			transform: rotate(54deg) skew(20deg);
		}

		.no-margin{
			margin: 0px;
		}

		table{
			width: 100%;
		}
		table td,th{
			padding: 0 5px;
			border: 1px solid black !important;
		}

	
		table td:first-child{
			width: 12%;
		}

		table td:nth-child(2){
			width: 15%;
		}
		table td:last-child{
			width: 5%;
		}

		table th{
			background-color: #179101;
			color : white;
		}

		body{
			font-size: 12px;
		}

		@media print {
			table th{
				background-color: #179101 !important;
				color : white !important;
    			-webkit-print-color-adjust: exact; 
			}



			.blue{
				color: blue !important
			}
		}
		.text-center{
			text-align: center;
		}
		</style>
	</head>

	<body onload=""  onafterprint="window.close()">

	 	<div class="wrapper">
	 		<center>
		 		<span class="no-margin blue text-center" style="font-size: 16px">
		 			<b>
		 				RECORDS - Reports for Dissemination of Documents
		 			</b>
		 		</span>
		 		<p class="no-margin">
		 			{{date("F d, Y",strtotime($inclusive_dates['from']))}} to {{date("F d, Y",strtotime($inclusive_dates['to']))}}
		 		</p>
	 		</center>

			<hr>
			
			@if(count($logs) > 0)
				<table>
					<thead>
						<tr>
							<th>Date</th>
							<th>Ref no.</th>
							<th>Subject</th>
							<th>No. of Disseminated</th>
						</tr>
					</thead>
					<tbody>
						@php
							$total = 0;
						@endphp
						@foreach($logs as $key_date => $log_date)
							@foreach($log_date as $key_ref => $log_ref)
							@php	
								$total = $total + count($log_ref['found']);
							@endphp
								<tr>
									<td>{{date("F d, Y",strtotime($key_date))}}</td>
									<td>{{$key_ref}}</td>
									<td>{{$log_ref['subject']}}</td>
									<td style="text-align:right">{{count($log_ref['found'])}}</td>
								</tr>
							@endforeach
						@endforeach

						<tr style="font-size: 14px">
							<td colspan="3" class="green" ><b>TOTAL</b></td>
							<td style="text-align: right">
								<b>
									{{number_format($total) }}
								</b>	
							</td>
						</tr>

					</tbody>
				</table>
			@else
				<h4 class="text-center">No log found</h4>
			@endif
	 	</div>
	</body>
</html>

