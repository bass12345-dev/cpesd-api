 <div class="card">
      	 <div class="card-header">
            <h5 class="card-title mb-0">Add Document</h5>
         </div>
         <div class="card-body">
            <form id="add_document">
               <div class="form-row mb-2">
                  <div class="form-group col-md-12 mb-2">
                     <label for="inputEmail4">Tracking Number</label>
                     <input type="text" class="form-control" name="tracking_number" readonly="" >
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo base64_encode($user_data['user_id']) ?>" class="form-control"  >
                  <input type="hidden" name="office_id" value="<?php echo $user_data['office_id']; ?>" class="form-control"  >
                   <div class="form-group col-md-12 mb-2">
                     <label for="inputEmail4">Document name</label>
                     <input type="text" name="document_name" class="form-control"  >
                  </div>

                  <div class="form-group col-md-12 mb-2">
                     <label for="inputEmail4">Document Type</label>
                     <select class="form-control" name="document_type">
                        <option value="">Select Document Type</option>
                        <?php
                           foreach ($document_types as $row) :

                              echo "<option value='".$row->type_id."'>".$row->type_name."</option>";
                              # code...
                           endforeach;
                         ?>
                     </select>      
                  </div>

                  <div class="form-group col-md-12 mb-2">
                     <label for="inputEmail4" >Description</label>
                     <textarea class="form-control" name="description"></textarea>
                  </div>

                  <div class="form-group col-md-12 mb-2">
                     <label for="inputEmail4">Type</label>
                     <select class="form-control" name="type" >
                     	<option>Simple</option>
                     	<option>Complex</option>
                     </select>
                  </div>

               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>