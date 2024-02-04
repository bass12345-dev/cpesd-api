@extends('admin.layout.admin_master')
@section('title', 'My Documents')
@section('content')

@include('includes.title')
<div class="row">
   <div class="col-12 col-md-6">
       @include('admin.contents.view.sections.document_information')
   
   </div>
   <div class="col-12  col-md-6 ">
       @include('admin.contents.view.sections.history')
   </div>
   
</div>
@endsection
@section('js')

<script>

   document.addEventListener("DOMContentLoaded", function () {
   // Datatables with Buttons
   var datatablesButtons = $("#datatables-buttons").DataTable({
      responsive: false,
      lengthChange: !1,
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

</script>

@endsection