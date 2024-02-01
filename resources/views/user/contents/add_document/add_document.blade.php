@extends('user.layout.user_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
<div class="mb-3">
   <h1 class="h3 d-inline align-middle">Add Document</h1>
</div>
<div class="row">
   <div class="col-12 col-lg-6 col-xxl-6 d-flex">
      @include('user.contents.add_document.sections.document_table')
   </div>
   <div class="col-12 col-lg-6">
     @include('user.contents.add_document.sections.form')
   </div>
</div>

@endsection
@section('js')
<script type="text/javascript">

   $('#documents').dataTable();

   function get_last(){

      $.ajax({
         url : base_url + '/api/get-last',
         method : 'GET',
         dataType: 'json',
         headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }, 
         beforeSend : function(){
            Swal.showLoading()
         }, 
         success : function(data){
            Swal.close();
            $('input[name=tracking_number]').val(data.number);
         },
         error : function(){

            alert('Please Reload the page or adtoa and developer')

         }
         
      })

   }
   get_last();

   $('#add_document').on('submit', function(e){
      e.preventDefault();
      $.ajax({
         url : base_url + '/api/add-document',
         method : 'POST',
         data : $(this).serialize(),
         dataType: 'json',
         beforeSend : function(){
            Swal.showLoading()
         }, 
         headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  'Authorization': '<?php echo config('app.key') ?>'
         }, 
         success : function(data){
            Swal.close();
            if (data.response) {

               alert(data.message)

            }else {

               alert(data.message)

            }
         },
         error : function(){

         }
         
      });
   });
</script>
@endsection