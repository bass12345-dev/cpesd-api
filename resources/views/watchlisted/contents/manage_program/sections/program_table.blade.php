<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-2">Documents</h5>
            <button class="btn btn-danger">Delete</button>

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
                           <a href="{{url('/watchlisted/admin/view_profile?id='.$row['program_id'])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>   
                            
                        </td>
                       
                     </tr>


               <?php endforeach; ?>
               
                  
            </tbody>
         </table>
      </div>




