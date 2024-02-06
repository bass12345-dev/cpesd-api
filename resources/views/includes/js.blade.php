\@include('includes.modals.view_remarks_modal')
<script type="text/javascript"> var base_url = '<?php echo url('/'); ?>';  </script>
<script src=" {{ asset('assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src=" {{ asset('assets/js/datatables.js') }}"></script>
<script src="
https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js
"></script>
<script type="text/javascript">
function reload_page() {
   location.reload();
}
$('a#view_remarks').on('click', function(){
   $('.remarks').text($(this).data('remarks'));
});

$('select[name=type]').on('change', function(){

   if ($(this).val() == 'simple') {
      $('#remarks').attr('hidden',false);
   }else {
      $('#remarks').attr('hidden',true);
   }
});

function add_item(form,url){

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
         if (data.response) {

            Swal.fire({
               position: "top-end",
               icon: "success",
               title: data.message,
               showConfirmButton: false,
               timer: 1500
            });
            setTimeout(reload_page, 3000)

         } else {

            alert(data.message)

         }
      },
      error: function () {
         alert('something Wrong')
      }

   });

}


function update_item(id,form,url){

   $.ajax({
      url: base_url +url+id,
      method: 'PUT',
      dataType: 'json',
      data : form,
      beforeSend: function () {
         Swal.showLoading()
      },
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
         'Authorization': '<?php echo config('app.key') ?>'
      },
      success: function (data) {
         Swal.close();
         if (data.response) {

            Swal.fire({
               position: "top-end",
               icon: "success",
               title: data.message,
               showConfirmButton: false,
               timer: 1500
            });
            setTimeout(reload_page, 3000)

         } else {

            alert(data.message)

         }
      },
      error: function () {
         alert('something Wrong')
      }

   });

}

function delete_item(id,url){

Swal.fire({
  title: "Are you sure?",
  text: "",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {

       $.ajax({
      url: base_url +url+id,
      method: 'DELETE',
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
         if (data.response) {

            Swal.fire({
               position: "top-end",
               icon: "success",
               title: data.message,
               showConfirmButton: false,
               timer: 1500
            });
            setTimeout(reload_page, 3000)

         } else {

            alert(data.message)

         }
      },
      error: function () {
         alert('something Wrong')
      }

   });
  }
});

}
</script>


