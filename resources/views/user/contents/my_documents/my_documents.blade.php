@extends('user.layout.user_master')
@section('title', $title)
@section('content')

@include('includes.title')
<div class="row">
   <div class="col-md-12 col-12   ">
      @include('user.contents.my_documents.sections.document_table')
   </div>
</div>

@include('user.contents.my_documents.modals.update_document_modal')
@endsection
@section('js')

<script>
       document.addEventListener("DOMContentLoaded", function() {
         // Datatables with Buttons
         var datatablesButtons = $("#datatables-buttons").DataTable({
            responsive: false,
            lengthChange: !1,
            "ordering": false,
 
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


$('a.update_document').on('click', function(){
   $('input[name=t_number]').val($(this).data('tracking-number'));
   $('input[name=document_name]').val($(this).data('name'));
   $('select[name=document_type]').val($(this).data('type'));
   $('textarea[name=description]').val($(this).data('description'));
   // $('select[name=type]').val($(this).data('destination'));
});


$('#update_document').on('submit', function(e){
   e.preventDefault();
   var url = '/api/update_document/';
   var form = $('form#update_document').serialize();
   var id = $('input[name=t_number]').val();
   update_item(id,form,url);

});


$('a.remove_document').on('click', function(){

   var id = $(this).data('id');
   var t = $(this).data('track');
   Swal.fire({
     title: "Are you sure?",
     text: "Document #" + t ,
     icon: "warning",
     showCancelButton: true,
     confirmButtonColor: "#3085d6",
     cancelButtonColor: "#d33",
     confirmButtonText: "Remove Document"
   }).then((result) => {
     if (result.isConfirmed) {
       delete_document(id);
     }
   });
});

function delete_document(id){
      let form = {
                  id : id
                  }
      var url = '/api/delete-my-document';
      add_item(form,url);
}
</script>

@endsection