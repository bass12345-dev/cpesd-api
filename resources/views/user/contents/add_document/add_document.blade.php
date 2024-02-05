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
       "ordering": false,
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
   var url = '/api/add-document';
   var form = $(this).serialize();
   add_item(form,url);
});




</script>
@endsection