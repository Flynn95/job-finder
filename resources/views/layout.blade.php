<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/font-awesome.min.css"/>

	@yield('header')
	
</head>

<body>
	@yield('navigator')

	@yield('content')

	@yield('footer')

	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	@yield('afterscript')
</body>
</html>