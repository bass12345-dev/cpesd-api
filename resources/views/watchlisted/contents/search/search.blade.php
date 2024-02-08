@extends('watchlisted.layout.watchlisted_master')
@section('title', $title)
@section('content')
@include('includes.title')
<div class="row">
	<div class="col-md-4">
@include('watchlisted.contents.search.sections.search_form')
	</div>
	<div class="col-md-8">
@include('watchlisted.contents.search.sections.result_table')
	</div>
@endsection
@section('js')
<script>

$('#search_form').on('submit', function(e){
	e.preventDefault();

	var url = '/api/search-query';
	var form = $(this).serialize();
	var first_name = $('input[name=first_name]').val();
   	var last_name = $('input[name=last_name]').val();
   	$('#datatables-buttons').DataTable().destroy();
   	if (first_name == '' && last_name == '') {
      alert('please input First Name or Last Name');
   } else {
      search_name_result(url,form)
   }

});
	

function search_name_result(url,form){
		 $.ajax({
      url: base_url + url,
      method: 'POST',
      data: form,
      dataType: 'json',
      beforeSend: function () {
         Swal.showLoading()
      },
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         'Authorization': '<?php echo config('app.key') ?>'
      },
      success: function (data) {
         Swal.close();
         var s = data.length > 1 ? 's' : '';
         var text = "Result"+s +' '+ data.length;
    
        	$('img#search_image').attr('hidden',true);
        	$('#search').attr('hidden',false);	
        	
        	$('h5#count_result').text(text);
        	 $('#datatables-buttons').DataTable({
        	 	 "ordering": false,
            search: true,
            "data": data,
            'columns': [

       
           {
               data: null,
               render: function (data, type, row) {

               	var extenstion = row.extenstion != null ? row.extenstion : '';
               	var middle_name = row.middle_name != null ? row.middle_name : '';

                  return row.first_name +' '+ middle_name +' '+ row.last_name +' '+ extenstion ;
               }
            }, 
            {
               data: 'age',
            }, 
            {
               data: 'address',
            },
             {
               data: 'email_address',
            }, 

             {
               data: 'phone_number',
            }, 

            

            {
               data: null,
               render: function (data, type, row) {
                  return '<a href="'+base_url+'/watchlisted/admin/view_profile?id='+row.person_id+'" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
               }
            }, 


            ]
        	 });


 
      },
      error: function () {
         alert('something Wrong')
      }

   });	
}


</script>

@endsection