<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-2">Documents</h5>
         </div>
         

         <table class="table table-hover table-striped " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                 
                  <th>#</th>
                  <th>Program</th>
                  <th>Program Description</th>
                  <th>Created</th>
                  <th>Actions</th>
                 
               </tr>
            </thead>
            <tbody>

               <?php $i = 1;  foreach ($programs as $row) : ?>

                <tr>
                       
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['program']; ?></td>
                        <td><?php echo $row['program_description']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td> 
                           <div class="btn-group dropstart">
                             <i class="fa fa-ellipsis-v " class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                             <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" id="update" href="javascript:;" data-id="{{$row['program_id']}}" data-name="{{$row['program']}}" data-description="{{$row['program_description']}}">Update</a></li>
                                  <li><a class="dropdown-item" href="#" id="remove" href="javascript:;" data-id="{{$row['program_id']}}">Remove</a></li>
                                </ul>
                           </div>                 
                        </td>
                       
                     </tr>


               <?php endforeach; ?>
               
                  
            </tbody>
         </table>
      </div>




