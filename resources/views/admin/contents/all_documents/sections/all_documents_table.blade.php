<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-2">Documents</h5>
            <button class="btn btn-danger"> Delete</button>

         </div>
         

         <table class="table table-hover table-striped " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                  <th class=""></th>
                  <th class="">#</th>
                  <th class="">Tracking Number</th>
                  <th class="">Document Name</th>
                  <th class="">Document Type</th>
                  <th class="">Created</th>
                  <th class="">Status</th>
                  <th class="">Actions</th>
               </tr>
            </thead>
            <tbody>
                  <?php
                   $i = 1;
                   foreach ($documents as $row) :?>
                     <tr>
                        <td><input type="checkbox"></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['tracking_number']; ?></td>
                        <td><?php echo $row['document_name']; ?></td>
                        <td><?php echo $row['type_name']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td><?php echo $row['is'] == 'Pending' ? '<span class="badge p-2 bg-danger">Pending</span>' : '<span class="badge p-2 bg-success">Completed</span>'; ?></td>
                        <td> 
                           <a href="{{url('/dts/admin/view?tn='.$row['tracking_number'])}}" ><i class="fas fa-eye"></i></a>   
                           
                        </td>
                     </tr>
                <?php endforeach; ?>    
            </tbody>
         </table>
      </div>




