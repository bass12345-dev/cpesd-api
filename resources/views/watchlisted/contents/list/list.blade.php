@extends('watchlisted.layout.watchlisted_master')
@section('title', $title)
@section('content')
@include('includes.title')
@include('watchlisted.contents.list.sections.list_table')
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


$('button#remove').on('click', function(){
    let items = [];
    $('input[name=person_id]:checked').map(function(item){

        items.push($(this).val());
    });

    var url = '/api/remove/';
    var data = {
                id : items,
                status : 'inactive'
    };



    add_item(data,url);
    
});
</script>
@endsection