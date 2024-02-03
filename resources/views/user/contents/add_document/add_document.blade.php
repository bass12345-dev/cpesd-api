@extends('user.layout.user_master')
@section('title', 'Add Document')
@section('content')
@include('includes.title')
<div class="row">
   <div class="col-12  col-md-7 ">
      @include('user.contents.add_document.sections.document_table')
   </div>
   <div class="col-12 col-md-5">
     @include('user.contents.add_document.sections.form')
   </div>
</div>

@endsection
@section('js')
<script type="text/javascript">

   document.addEventListener("DOMContentLoaded", function () {
   // Datatables with Buttons
   var datatablesButtons = $("#datatables-buttons").DataTable({
      responsive: true,
      lengthChange: !1,
      search : false,
      buttons: [{
            extend: 'print',
            title: 'All Documents'
         },
         {
            extend: 'csv',
         }

      ],
      scrollX: true
   });
   datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
});


$('#add_document').on('submit', function (e) {
   e.preventDefault();
   $.ajax({
      url: base_url + '/api/add-document',
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
            setTimeout(reload_page, 3000)

         } else {

            alert(data.message)

         }
      },
      error: function () {

      }

   });
});




</script>
@endsection