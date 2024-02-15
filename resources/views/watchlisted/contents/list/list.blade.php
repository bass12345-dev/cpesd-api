@extends('watchlisted.layout.watchlisted_master')
@section('title', $title)
@section('content')
@include('includes.title')
@include('watchlisted.contents.list.sections.list_table')
@endsection

@section('js')
<script>

$('button#remove').on('click', function(){
    let items = [];
    $('input[name=person_id]:checked').map(function(item){

        items.push($(this).val());
    });

    var url = '/web/remove/';
    var data = {
                id : items,
                status : 'inactive'
    };



    add_item(data,url);
    
});
</script>
@endsection