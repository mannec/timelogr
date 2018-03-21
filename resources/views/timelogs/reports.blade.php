@extends('layouts.app')

@section('content')
<div class = "container">

@if(Auth::guest())
   <div class ="row">
   		<div class ="col-xs-6">
			<h1> Du måste logga in! </h1>
		</div>
   </div>

@elseif (Auth::user())
	<div class ="row">
		<div class="col-md-4">
			<h2>Sammanställning</h2>
		</div>
	</div>
	<br>
	<div class ="row">
		<div class ="col-md-4">
			Totalt antal jobbade timmar: {{ $totalHours}}
		</div>
	</div>
<hr>
<b>Timmar per dag</b>
@foreach( $hoursPerDay as $day)
	<div class ="row">
		<div class ="col-md-4">
			 Dag: {{ $day->day }} 
		</div>
		<div class ="col-md-4">
			 Timmar: {{ $day->total }}
		</div>
	</div>
@endforeach
<hr>
<b>Timmar per månad</b>
@foreach( $hoursPerMonth as $month)
	<div class ="row">
		<div class ="col-md-4">
			 Månad: {{ $month->month }} 
		</div>
		<div class ="col-md-4">
			 Timmar: {{ $month->total }}
		</div>
	</div>
@endforeach
<hr>
<b>Timmar per år</b>
@foreach( $hoursPerYear as $year)
	<div class ="row">
		<div class ="col-md-4">
			 År: {{ $year->year }} 
		</div>
		<div class ="col-md-4">
			 Timmar: {{ $year->total }}
		</div>
	</div>
@endforeach
</div>


@endif
@endsection