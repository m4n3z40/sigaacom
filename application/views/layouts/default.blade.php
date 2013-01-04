<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Application Name</title>
	<meta name="description" content="Application Description">
	<meta name="viewport" content="width=device-width">
		
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/bootstrap-responsive.css') }}
	{{ HTML::style('css/main.css') }}
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				{{ HTML::link('/', 'SIGAACOM', ['class' => 'brand']) }}

				<ul class="nav">
					@yield('main-nav')
				</ul>
			</div>
		</div>
	</div>

	<div class="main-content container">
		@yield('content')
	</div>
	
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('js/plugins.js') }}
	{{ HTML::script('js/main.js') }}
</body>
</html>