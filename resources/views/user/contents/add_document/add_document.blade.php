@extends('user.layout.user_master')
<!-- @section('title', 'Dashboard') -->
@section('content')
<div class="mb-3">
   <h1 class="h3 d-inline align-middle">Add Document</h1>
</div>
<div class="row">
   <div class="col-12 col-lg-6 col-xxl-6 d-flex">
      <div class="card flex-fill">
         <div class="card-header">
            <h5 class="card-title mb-0">Latest Projects</h5>
         </div>
         <table class="table table-hover my-0">
            <thead>
               <tr>
                  <th>Name</th>
                  <th class="d-none d-xl-table-cell">Start Date</th>
                  <th class="d-none d-xl-table-cell">End Date</th>
                  <th>Status</th>
                  <th class="d-none d-md-table-cell">Assignee</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Project Apollo</td>
                  <td class="d-none d-xl-table-cell">01/01/2023</td>
                  <td class="d-none d-xl-table-cell">31/06/2023</td>
                  <td><span class="badge bg-success">Done</span></td>
                  <td class="d-none d-md-table-cell">Vanessa Tucker</td>
               </tr>
              
            </tbody>
         </table>
      </div>
   </div>
   <div class="col-12 col-lg-6">
     @include('user.contents.add_document.sections.form')
   </div>
</div>

@endsection
@section('js')
<script type="text/javascript">

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