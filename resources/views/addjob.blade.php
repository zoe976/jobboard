@extends('layouts.app')

@section('title', 'Add Job')


@section('content')
	<div class="row">
		<a href="{{url('/jobs')}}">Jobs</a>
	</div>
	<div class="row">
		<h1>Add job</h1>
	</div>
	<div class="row">
		@if (session('status'))
		    <div class="alert">
		        {{ session('status') }}
		    </div>
		@endif
	</div>
	
	<div class="row">
		 <form action="{{ url('/add_job') }}" method="POST">
		 	 @csrf
		  <div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
		  </div>
		  <div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
		    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		  </div>
		  <div class="form-group">
		    <label for="description">Description</label>
		    <textarea class="form-control" rows="4" cols="50" id="description" name="description" placeholder="Description" required=""></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>

@endsection



