@extends('admin.layout.admin_master')
@section('title', $title)
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
            ordering : false,
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


$('a#remove_office').on('click', function(){
   var id = $(this).data('id');
   var url = '/api/delete-office/';
   delete_item(id,url);
});



$('a#update_office').on('click', function(){
   var id = $(this).data('id');
   var office = $(this).data('office');
   $('input[name=office_id]').val(id);
   $('input[name=office]').val(office);
   $('#add_office').find('button.submit').text('Update');
   $('#add_office').find('button.cancel_update').attr('hidden', false);
   $('.card-title').text('Update '+office+ ' Office');
});

$('#add_office').find('button.cancel_update').on('click', function(){
   $(this).attr('hidden',true);
   $('input[name=office_id]').val('');
   $('input[name=office]').val('');
   $('#add_office').find('button.submit').text('Submit');
    $('.card-title').text('Add Office');
});



$('#add_office').on('submit', function (e) {
   e.preventDefault();
   var form = $(this).serialize();
   var id = $('input[name=office_id]').val();

   if (!id) {
      var url = '/api/add-office';
     add_item(form,url);
   }else {
      var url = '/api/update_office/';
      update_item(id,form,url);
      
   }

    $('#add_office').find('button').attr('disabled',true);

});



</script>

@endsection