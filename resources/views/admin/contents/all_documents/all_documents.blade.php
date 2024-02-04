@extends('admin.layout.admin_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
@include('includes.title')
@include('admin.contents.all_documents.sections.all_documents_table')
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