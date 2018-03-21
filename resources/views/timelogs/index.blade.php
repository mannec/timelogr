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
   		<div class ="col-md-6">
			<h1> Rapporterade tider </h1>
		</div>
		<div class="col-md-4">
			<a href="{{ URL::route('timelogs.reports') }}" class="treatmentBtn"><h2> Rapporter</h2></a>
		</div>
   </div>
	<hr>

	<div class ="row">
		<div class ="col-md-4">
			<h2><b> Datum </b> </h2>
		</div>

		<div class ="col-md-4">
			<h2> <b>Uppgift</b> </h2>
		</div>

		<div class ="col-md-4">
			<h2> <b> Timmar </b></h2>
		</div>
	</div>
	<hr>
	@foreach( $timelogs as $timelog)
	<div class ="row">
		<a href="{{ action('TimeController@show', [ $timelog->id ]) }}"></a>
		<div class ="col-md-4">
			 {{ $timelog->day }} 
		</div>
		<div class ="col-md-4">
			 {{ $timelog->description }}
		</div>
		<div class ="col-md-4">
			 {{ $timelog->hours }} 
		</div>
	</div>
	@endforeach

<hr>
	{!! Form::open() !!}
	<div class ="row">
		<div class ="col-md-3">
			{!! Form::label('description', 'Beskrivning:') !!} <br>
			{!! Form::text('description', 'Kodat') !!}
		</div>
		<div class ="col-md-3">
			{!! Form::label('day', 'Dag:') !!} <br>
			{!! Form::date('day', \Carbon\Carbon::now()) !!}
		</div>
		<div class ="col-md-3">
			{!! Form::label('hours', 'Antal timmar:') !!} <br>
			{!! Form::number('hours') !!}
		</div>

	</div>
	<br>
	<div class ="row">
		<div class ="col-md-4">
			{!! Form::submit('Logga tid') !!}
		</div>
	</div>


{!! Form::close() !!}
@endif
</div>
@endsection