<!DOCTYPE html>
<html lang="en">

<head>
	@include('includes.meta')
	@include('includes.css')
	<style type="text/css">
		body{
			background-image: url("{{ asset('assets/img/background-track.jpg') }}");
			background-size: cover;
/*			background-repeat: repeat-x;*/
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
								<a href="{{url('/dts')}}"><i class="fas fa-arrow-left"></i></a>
								<div class="text-center mt-4">

									<h1 class="h2 text-black">Register</h1>
									
								</div>
								<div class="m-sm-3">
									<form id="login_form">
										<div class="mb-3">
											<label class="form-label">First Name</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Middle Name</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Last Name</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Jr Sr ... Extension</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Contact Number</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Email Address </label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Barangay*</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Office</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input class="form-control form-control-lg" type="text" name="username"  />
										</div>
									

										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Submit</button>
									

										</div>

										<!-- <div class="d-grid gap-2 mt-1">
											<a href="{{url('/dts/track')}}" class="btn btn-lg btn-success">Track Documents</a>
										</div> -->
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
      url: base_url + '/verify-user',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function () {
         Swal.showLoading()
      },
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         'Authorization': '<?php echo config('app.key') ?>'
      },
      success: function (data) {
         Swal.close();
         if (data.response) {

            Swal.fire({
               position: "top-end",
               icon: "success",
               title: data.message,
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