@extends('receiver.layout.receiver_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
@include('includes.title')
@include('receiver.contents.received.sections.received_table')

@include('receiver.contents.received.sections.final_action_off_canvas')



@endsection



@section('js')



<script type="text/javascript">
	  document.addEventListener("DOMContentLoaded", function() {
         // Datatables with Buttons
         var datatablesButtons = $("#datatables-buttons").DataTable({
            responsive: false,
            lengthChange: !1,
            buttons: [
            {
            extend:'print',
            title:'All Documents'
            },
            {
            extend:'csv',
            }

            ],
            scrollX: true
         });
         datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
         });
$('a#forward_icon').on('click', function(){
   $('input[name=id]').val($(this).data('history-id'));
   $('input[name=t_number]').val($(this).data('tracking-number'));
   $('.offcanvas-title').text('Document #' +$(this).data('tracking-number') )
});


$('#forward_form').on('submit', function (e) {
   e.preventDefault();
   var url = '/api/complete-document';
   var form = $(this).serialize();
   add_item(form,url);
   // $.ajax({
   //    url: base_url + ,
   //    method: 'POST',
   //    data: $(this).serialize(),
   //    dataType: 'json',
   //    beforeSend: function () {
   //       Swal.showLoading()
   //    },
   //    headers: {
   //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
   //       'Authorization': '<?php echo config('app.key') ?>'
   //    },
   //    success: function (data) {
   //       Swal.close();
   //       if (data.response) {

   //          Swal.fire({
   //             position: "top-end",
   //             icon: "success",
   //             title: data.message,
   //             showConfirmButton: false,
   //             timer: 1500
   //          });
   //          setTimeout(reload_page, 3000)

   //       } else {

   //          alert(data.message)

   //       }
   //    },
   //    error: function () {

   //    }

   // });
});
</script>

@endsection