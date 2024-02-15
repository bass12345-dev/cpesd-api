 <div class="card">
      	 <div class="card-header">
            <h5 class="card-title mb-0"></h5>
         </div>
         <div class="card-body">
            <form id="update_form">
               <div class="form-row mb-2 ">
                  
                  <div class="row">

                      <div class=" col-md-6 mb-3">
                           <label for="inputEmail4">Old Security Code</label>
                           <input type="hidden" name="id" value="{{$watch_id}}">
                           <input type="password" name="old" class="form-control" autocomplete=""  required>
                        </div>
                  <div class="col-md-6 mb-3">
                           <label for="inputEmail4">New Security Code</label>
                           <input type="password" name="new" class="form-control" autocomplete="" required >
                        </div>
                     
                  </div>
                  

               </div>
               <button type="submit" class="btn btn-primary">Update</button>
            </form>
         </div>
      </div>