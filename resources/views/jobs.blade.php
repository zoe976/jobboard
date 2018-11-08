@extends('layouts.app')

@section('title', 'Jobs')


@section('content')


<div class="row">
	 <h1>Jobs</h1>
</div>
<div class="row">
	<ul>
	@foreach ($jobs as $job)
	<li>
		<h2>{{$job->title}}</h2>
		<p>{{$job->description}}</p>
	</li>
    	
	@endforeach
	</ul>
</div>
  
    
@endsection



