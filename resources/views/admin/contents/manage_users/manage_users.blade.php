@extends('admin.layout.admin_master')
@section('title', $title)
@section('content')
@include('includes.title')
<div class="row">
   <div class="col-md-12">
    @include('admin.contents.manage_users.sections.users_table')
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


$('a.set-inactive').on('click', function(){
var id = $(this).data('id');
let data = {status: 'inactive'}
var url = '/api/remove-user/';
update_item(id,data,url);
});

$('a.set-active').on('click', function(){
var id = $(this).data('id');
let data = {status: 'active'}
var url = '/api/remove-user/';
update_item(id,data,url);
});

$('a.delete').on('click', function(){
var id = $(this).data('id');
var url = '/api/delete-user/';
delete_item(id,url)
});
</script>

@endsection