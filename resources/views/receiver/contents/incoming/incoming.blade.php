@extends('receiver.layout.receiver_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
@include('includes.title')
@include('receiver.contents.incoming.sections.incoming_table')





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


$('a.received_document').on('click', function(){

   var id = $(this).data('id');
   Swal.fire({
     title: "Are you sure?",
     text: "",
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Received Document"
   }).then((result) => {
     if (result.isConfirmed) {
       received_document(id);
     }
   });
});

function received_document(id){
      $.ajax({
      url: base_url + '/api/receive-document',
      method: 'POST',
      data: {id : id},
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
            setTimeout(reload_page, 2000)

         } else {

            alert(data.message)

         }
      },
      error: function () {
         alert('something wrong')
      }

   });
}

</script>

@endsection