@extends('user.layout.user_master')
@section('title', $title)
@section('content')

@include('includes.title')
<div class="row">
   <div class="col-md-12 col-12   ">
      @include('user.contents.incoming.sections.incoming_table')
   </div>
</div>
@endsection
@section('js')

<script>
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
      let form = {
                  id : id
                  }
      var url = '/api/receive-document';
      add_item(form,url);
}
</script>

@endsection