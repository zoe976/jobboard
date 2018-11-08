<!DOCTYPE html>
<html>
<head>
	 <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <title>@yield('title')</title>

    <!-- Styles -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
	<div class="container">		
			@yield('content')
	</div>
</body>
</html>