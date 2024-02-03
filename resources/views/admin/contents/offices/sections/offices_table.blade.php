<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Documents</h5>
         </div>
         <table class="table table-hover  " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
                  <th class="d-none d-xl-table-cell">Office</th>
                  <th class="d-none d-xl-table-cell">Created</th>
                
                  <th class="d-none d-md-table-cell">Action</th>
               </tr>
            </thead>
            <tbody>
                  <?php
                   $i = 1;
                   foreach ($offices as $office) :?>
                     <tr>
                        <td class="d-none d-xl-table-cell">{{$office['office']}}</td>
                        <td class="d-none d-xl-table-cell">{{$office['created']}}}</td>
                        <td>    
                           <div class="btn-group dropstart">
                             <i class="fa fa-ellipsis-v " class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                             <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="">View </a></li>
                                  <li><a class="dropdown-item" href="#">Update</a></li>
                                  <li><a class="dropdown-item" href="#">Remove</a></li>
                                </ul>
                           </div>
                        </td>
                     </tr>
                <?php endforeach; ?>    
            </tbody>
         </table>
      </div>