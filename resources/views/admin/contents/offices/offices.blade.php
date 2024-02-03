@extends('admin.layout.admin_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
@include('includes.title')


<div class="row">
   <div class="col-12  col-md-7 ">
      @include('admin.contents.offices.sections.offices_table')
   </div>
   <div class="col-12 col-md-5">
    @include('admin.contents.offices.sections.add_office')
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
</script>

@endsection