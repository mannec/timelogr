@extends('layouts.app')

@section('content')

@if(Auth::guest())
   <div class ="row">
   		<div class ="col-xs-6">
			<h1> Du måste logga in! </h1>
		</div>
   </div>

@elseif (Auth::user())
<div class = "container">

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
			<a href="{{action('TimeController@store')}}" class="btn btn-default"> Logga tid </a>
		</div>
	</div>

</div>
{!! Form::close() !!}

@endif
@endsection