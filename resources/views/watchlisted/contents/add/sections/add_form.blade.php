 <div class="card">
      	 <div class="card-header">
            <h5 class="card-title mb-0">Add Watchlisted</h5>
         </div>
         <div class="card-body">
            <form id="add_document">
               <div class="form-row mb-2">
                  
                  <div class="row">
                       <div class="form-group col-md-6 mb-3">
                           <label for="inputEmail4">First Name<span class="text-danger">*</span></label>
                           <input type="text" name="firstName" class="form-control" required >
                        </div>
                        <div class="form-group col-md-6 mb-3">
                           <label for="inputEmail4">Last Name<span class="text-danger">*</span></label>
                           <input type="text" name="lastName" class="form-control" required >
                        </div>
                        
                  </div>

                    <div class="row">
                       <div class="form-group col-md-6 mb-3">
                           <label for="inputEmail4">Middle Name<span class="text-danger">*</span></label>
                           <input type="text" name="middleName'" class="form-control" >
                        </div>
                        <div class="form-group col-md-6 mb-3">
                           <label for="inputEmail4">Extension</label>
                           <input type="text" name="extension" class="form-control"  >
                        </div>
                        
                  </div>
                  <div class="form-group col-md-12 mb-3">
                     <label for="inputEmail4">Barangay</label>
                     <select class="form-control" name="address" required>
                     	<option value="" selected>Select Barangay</option>
                        <?php foreach ($barangay as $row) : ?>
                        <option value="{{$row}}">{{$row}}</option>
                      <?php endforeach; ?>
                      </select>
                    
                  </div>
                   <div class="form-group col-md-12 mb-3">
                           <label for="inputEmail4">Phone Number</label>
                           <input type="number" name="phoneNumber" class="form-control"  >
                        </div>
                   <div class="form-group col-md-12 mb-3">
                           <label for="inputEmail4">Email Address</label>
                           <input type="email" name="document_name" class="form-control" >
                        </div>
                  <div class="form-group col-md-12 mb-3">
                           <label for="inputEmail4">Age</label>
                           <input type="number" name="age" class="form-control" >
                        </div>

               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>