 <div class="card">
      	 <div class="card-header">
            <h5 class="card-title mb-0">Add Document</h5>
         </div>
         <div class="card-body">
            <form id="add_document">
               <div class="form-row mb-2">
                  <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Tracking Number</label>
                     <input type="text" class="form-control" name="tracking_number" value="{{$reference_number}}" readonly="" >
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo base64_encode($user_data['user_id']) ?>" class="form-control"  >
                  <input type="hidden" name="office_id" value="<?php echo $user_data['office_id']; ?>" class="form-control"  >
                   <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Document name</label>
                     <input type="text" name="document_name" class="form-control" required >
                  </div>

                  <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Document Type</label>
                     <select class="form-control" name="document_type" required>
                        <option value="">Select Document Type</option>
                        <?php
                           foreach ($document_types as $row) :

                              echo "<option value='".$row->type_id."'>".$row->type_name."</option>";
                              # code...
                           endforeach;
                         ?>
                     </select>      
                  </div>

                  <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4" >Description</label>
                     <textarea class="form-control" name="description" style="height: 10rem;" required></textarea>
                  </div>

                  <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Type</label>
                     <select class="form-control" name="type" >
                     	<option value="complex">Complex</option>
                        <option value="simple">Simple</option>
                     </select>
                  </div>

                  <div class="form-group col-md-12 mb-3" id= "remarks" hidden>
                     <label for="inputEmail4" >Remarks</label>
                     <textarea class="form-control" name="remarks" style="height: 10rem;" ></textarea>
                  </div>

               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>