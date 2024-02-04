<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Final Actions</h5>
         </div>
         <table class="table table-hover  " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
                  <th class="d-none d-xl-table-cell">#</th>
                  <th class="d-none d-xl-table-cell">Name</th>
                
                  <th class="d-none d-md-table-cell">Address</th>
                  <th class="d-none d-md-table-cell">Email</th>
                  <th class="d-none d-md-table-cell">Phone Number</th>
                   <th class="d-none d-md-table-cell">Status</th>
                  <th class="d-none d-md-table-cell">Actions</th>
                 
               </tr>
            </thead>
            <tbody>
               <?php $i = 1;  foreach($users as $row) : 
               $status = $row->user_status == 'active' ? '<span class="badge bg-success p-2">Active</span>' : '<span class="badge bg-danger p-2">Inactive</span>';

               $button1 = $row->user_status == 'active' ? '<a class="btn btn-warning"><i class="fas fa-close"></i></a>' : '';
               $button3 = $row->user_status != 'active' ? '<a class="btn btn-danger"><i class="fas fa-trash"></i></a>' : '';
                ?>
                  <tr>
                     <td>{{$i++}}</td>
                     <td>{{$row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension}}</td>
                     <td>{{$row->address}}</td>
                     <td>{{$row->email_address}}</td>
                     <td>{{$row->contact_number}}</td>
                     <td><?php echo $status ?></td>
                     <td >
                        <?php echo $button1; ?>
                        <a class="btn btn-success"><i  class="fas fa-key" ></i></a>
                        <?php echo $button3; ?>
                     </td>
                  </tr>
               <?php endforeach; ?>
                  
            </tbody>
         </table>
      </div>