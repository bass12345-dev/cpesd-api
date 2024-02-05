<!DOCTYPE html>
<html lang="en">
<head>
	@include('includes.meta')
	@include('includes.css')
</head>
<body>
	<div class="wrapper">
		@include('receiver.layout.receiver_includes.receiver_sidebar')
		<div class="main">
			@include('receiver.layout.receiver_includes.receiver_topbar')
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