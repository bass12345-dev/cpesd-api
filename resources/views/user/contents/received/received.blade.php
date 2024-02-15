@extends('user.layout.user_master')
@section('title', $title)
@section('content')

@include('includes.title')
<div class="row">
   <div class="col-md-12 col-12   ">
      @include('user.contents.received.sections.received_table')
   </div>
</div>
@include('user.contents.received.sections.forward_offcanvas')

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


$('a#forward_icon').on('click', function(){
   $('input[name=history_id]').val($(this).data('history-id'));
   $('input[name=tracking_number]').val($(this).data('tracking-number'));
   $('.offcanvas-title').text('Forward Document #' +$(this).data('tracking-number') )
})

$('#forward_form').on('submit', function (e) {
   e.preventDefault();
   var url = '/api/forward-document';
   var form = $(this).serialize();
   add_item(form,url);
    $('#forward_form').find('button').attr('disabled',true);
});


</script>

@endsection