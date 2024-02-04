@extends('user.layout.user_master')
@section('title', 'My Documents')
@section('content')

@include('includes.title')
<div class="row">
   <div class="col-md-12 col-12   ">
      @include('user.contents.my_documents.sections.document_table')
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
            "ordering": false
 
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
</script>

@endsection