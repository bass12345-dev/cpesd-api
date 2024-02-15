<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="PESO OROQUIETA DTS">
	<meta name="author" content="Basil John C. Mañabo">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="keywords" content="PESO OROQUIETA DTS">
	<title>Login</title>
	@include('includes.css')
	<style type="text/css">
		body{
			background-color: #3F6BA4;
			background-size: cover;
			height: 100vh;
		}
	</style>
</head>

<body>
	<main class="d-flex w-100" >
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">


						<div class="card">
							<div class="card-body">
								<a href="{{url('/')}}"><i class="fas fa-arrow-left"></i></a>
								<div class="text-center mt-4">
									<h1 class="h2 text-black">Welcome back!!</h1>
									
								</div>
								<div class="m-sm-3">
									<form id="login_form">
										<div class="mb-3">
	
											<input class="form-control form-control-lg" type="password" name="code" placeholder="Enter Code" />
										</div>

										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Submit</button>
									

										</div>

									</form>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>


	</main>

	

</body>

@include('includes.js')

<script type="text/javascript">

$('#login_form').on('submit', function (e) {
   e.preventDefault();
   $.ajax({
      url: base_url + '/web/verify-code',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function () {
         Swal.showLoading()
      },
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      success: function (data) {
         Swal.close();
         if (data.response) {

            Swal.fire({
               position: "top-end",
               icon: "success",
               title: data.mes,
               showConfirmButton: false,
               timer: 1500
            });
           location.reload();

         } else {

            alert(data.message)

         }
      },
      error: function () {

      }

   });
});
	
</script>

</html>