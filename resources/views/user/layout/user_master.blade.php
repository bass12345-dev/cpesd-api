<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.meta')
	@include('includes.css')
</head>
<body>
	<div class="wrapper">
		@include('user.layout.user_includes.user_sidebar')
		<div class="main">
			@include('user.layout.user_includes.user_topbar')
			<main class="content">
				<div class="container-fluid p-0">
					@yield('content')
				</div>
			</main>
		</div>
	</div>
</body>
@include('includes.js')
@yield('js')

</html>