@extends('watchlisted.layout.watchlisted_master')
@section('title', 'Add')
@section('content')
@include('includes.title')
@include('watchlisted.contents.add.sections.add_form')
@endsection

@section('js')
<script type="text/javascript">

$('#add_document').on('submit', function (e) {
   e.preventDefault();
   var url = '/api/add';
   var form = $(this).serialize();


      Swal.fire({
     title: "Review First Before Submitting",
     text: "",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Submit"
   }).then((result) => {
     if (result.isConfirmed) {
        // add_item(form,url);
        //  $('#add_document').find('button').attr('disabled',true);
        //  // $('#add_document')[0].reset();

              $.ajax({
				      url: base_url + url,
				      method: 'POST',
				      data: form,
				      dataType: 'json',
				      beforeSend: function () {
				         Swal.showLoading();
				          $('#add_document').find('button').attr('disabled',true);

				      },
				      headers: {
				         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				         'Authorization': '<?php echo config('app.key') ?>'
				      },
				      success: function (data) {
				         Swal.close();
				          $('#add_document')[0].reset();
				          $('#add_document').find('button').attr('disabled',false);
				         if (data.response) {
						      Swal.fire({
						     title: data.message,
						     text: "",
						     icon: "success",
						     showCancelButton: true,
						     confirmButtonColor: "#3085d6",
						     cancelButtonColor: "#d33",
						     confirmButtonText: "View Profile"
						   }).then((result) => {

						   	window.location.href = base_url + '/watchlisted/admin/view_profile?id='+ data.id;

						   });
				            // setTimeout(reload_page, 3000);
				           

				         } else {

				            alert(data.message)

				         }
				      },
				      error: function () {
				         alert('something Wrong')
				      }

				   });
     }
   });

  
});

</script>
@endsection