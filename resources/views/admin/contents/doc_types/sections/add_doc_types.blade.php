 <div class="card">
      	 <div class="card-header">
            <h5 class="card-title mb-0">Add Document Type</h5>
         </div>
         <div class="card-body">
            <form id="add_document">
               <div class="form-row mb-2">
                 
                  <input type="hidden" name="user_id" value="<?php echo base64_encode($user_data['user_id']) ?>" class="form-control"  >
                  <input type="hidden" name="office_id" value="<?php echo $user_data['office_id']; ?>" class="form-control"  >
                   <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Type</label>

                     <input type="text" name="document_name" class="form-control" required >
                  </div>
                  

               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>