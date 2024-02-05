<div class="row">
   <div class="col-xl-12 col-xxl-12 d-flex">
      <div class="w-100">
         <div class="row">
            <div class="col-sm-3">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col mt-0">
                           <h5 class="card-title">All Documents</h5>
                        </div>
                        <div class="col-auto">
                           <div class="stat text-primary">
                              <i class="align-middle" data-feather="file"></i>
                           </div>
                        </div>
                     </div>
                     <h1 class="mt-1 mb-3">{{$count['count_documents']}}</h1>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col mt-0">
                           <h5 class="card-title">Offices</h5>
                        </div>
                        <div class="col-auto">
                           <div class="stat text-primary">
                              <i class="fas fa-building align-middle" ></i>
                           </div>
                        </div>
                     </div>
                     <h1 class="mt-1 mb-3">{{$count['count_document_types']}}</h1>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col mt-0">
                           <h5 class="card-title">Document Types</h5>
                        </div>
                        <div class="col-auto">
                           <div class="stat text-primary">
                              <i class="fas fa-file-text align-middle" ></i>
                           </div>
                        </div>
                     </div>
                     <h1 class="mt-1 mb-3">{{$count['count_offices']}}</h1>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col mt-0">
                           <h5 class="card-title">Users</h5>
                        </div>
                        <div class="col-auto">
                           <div class="stat text-primary">
                              <i class="align-middle" data-feather="users"></i>
                           </div>
                        </div>
                     </div>
                     <h1 class="mt-1 mb-3">{{$count['count_users']}}</h1>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>