<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Final Actions</h5>
         </div>
         <table class="table table-hover  " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
                  <th >Type</th>
                  <th >Created</th>
                
                  <th >Action</th>
               </tr>
            </thead>
            <tbody>
                  <?php
                   $i = 1;
                   foreach ($actions as $row) :?>
                     <tr>
                        <td >{{$row['type_name']}}</td>
                        <td >{{$row['created']}}}</td>
                        <td>    
                           <div class="btn-group dropstart">
                             <i class="fa fa-ellipsis-v " class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" id="update" href="javascript:;" data-id="{{$row['type_id']}}" data-name="{{$row['type_name']}}">Update</a></li>
                                  <li><a class="dropdown-item" id="remove" href="javascript:;" data-id="{{$row['type_id']}}">Remove</a></li>
                              </ul>
                           </div>
                        </td>
                     </tr>
                <?php endforeach; ?>    
            </tbody>
         </table>
      </div>