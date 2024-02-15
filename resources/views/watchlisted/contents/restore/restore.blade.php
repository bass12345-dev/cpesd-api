@extends('watchlisted.layout.watchlisted_master')
@section('title', $title)
@section('content')
@include('includes.title')
@include('watchlisted.contents.restore.sections.restore_table')
@endsection

@section('js')
<script>



$('button#delete').on('click', function(){
    let items = [];
    $('input[name=person_id]:checked').map(function(item){

        items.push($(this).val());
    });

    var url = '/api/delete/';
    var data = {
                id : items,
  
    };
   add_item(data,url);
    
});


$('button#restore').on('click', function(){
    let items = [];
    $('input[name=person_id]:checked').map(function(item){

        items.push($(this).val());
    });

    var url = '/api/set-active/';
    var data = {
                id : items,
                status : 'active'
  
    };
   add_item(data,url);
    
});
</script>
@endsection