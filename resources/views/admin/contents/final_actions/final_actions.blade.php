@extends('admin.layout.admin_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
@include('includes.title')


<div class="row">
   <div class="col-12  col-md-7 ">
      @include('admin.contents.final_actions.sections.actions_table')
   </div>
   <div class="col-12 col-md-5">
    @include('admin.contents.final_actions.sections.add_actions')
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


$('a#remove').on('click', function(){
   var id = $(this).data('id');
   var url = '/api/delete-action/';
   delete_item(id,url);
});



$('a#update').on('click', function(){
   var id = $(this).data('id');
   var item_name = $(this).data('name');
   $('input[name=id]').val(id);
   $('input[name=type]').val(item_name);
   $('#add_form').find('button.submit').text('Update');
   $('#add_form').find('button.cancel_update').attr('hidden', false);
   $('.card-title').text('Update '+item_name+ ' Action');
});

$('#add_form').find('button.cancel_update').on('click', function(){
   $(this).attr('hidden',true);
   $('input[name=id]').val('');
   $('input[name=type]').val('');
   $('#add_form').find('button.submit').text('Submit');
    $('.card-title').text('Add Action');
});



$('#add_form').on('submit', function (e) {
   e.preventDefault();
   var form = $(this).serialize();
   var id = $('input[name=id]').val();

   if (!id) {
     var url = '/api/add-action';
     add_item(form,url);
   }else {
      var url = '/api/update_action/';
      update_item(id,form,url);
      
   }


    $('#add_office').find('button').attr('disabled',true);

});

</script>

@endsection