<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Documents</h5>
         </div>
         <table class="table table-hover table-striped " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
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
                   foreach ($documents as $row) :
                     $delete_button  = DB::table('history')->where('t_number', $row['tracking_number'])->count() > 1 ? true : false;
                     ?>
                     <tr>
                       
                        <td><?php echo $row['tracking_number']; ?></td>
                        <td><?php echo $row['document_name']; ?></td>
                        <td><?php echo $row['type_name']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <td><?php echo $row['is']; ?></td>
                        <td>    
                           <div class="btn-group dropstart">
                             <i class="fa fa-ellipsis-v " class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                             <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{url('/dts/user/view?tn='.$row['tracking_number'])}}">View </a></li>
                                  <?php if ($delete_button == false) {
                                     echo '<li><a class="dropdown-item update_document" 
                                     data-tracking-number="'.$row['tracking_number'].'" 
                                     data-name="'.$row['document_name'].'" 
                                     data-type="'.$row['doc_type'].'" 
                                     data-description="'.$row['description'].'" 
                                     data-destination="'.$row['destination_type'].'" 
                                     href="javascript:;" class="" data-bs-toggle="modal" data-bs-target="#update_document">Update</a></li>
                                       <li><a class="dropdown-item remove_document" href="javascript:;" data-id="'.$row['document_id'].'" data-track="'.$row['tracking_number'].'"  >Remove</a></li>';
                                  } ?>
                                  
                                  
                                </ul>
                           </div>
                        </td>
                     </tr>
                <?php endforeach; ?>    
            </tbody>
         </table>
      </div>




