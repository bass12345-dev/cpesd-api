<div class="card flex-fill">
         <div class="card-header">
            <h5 class="card-title mb-0">Documents</h5>
         </div>
         <table class="table table-hover my-0" id="documents">
            <thead>
               <tr>
                
                  <th class="d-none d-xl-table-cell">No.</th>
                  <th class="d-none d-xl-table-cell">Encoded By</th>
                
                  <th class="d-none d-md-table-cell">Document Number</th>
               </tr>
            </thead>
            <tbody>
                  <?php
                   $i = 1;
                   foreach ($documents as $row) :?>
                     <tr>
                        <td class="d-none d-xl-table-cell"><?php echo $i++; ?></td>
                        <td class="d-none d-xl-table-cell"><?php echo  $row->first_name.' '.$row->middle_name.' '.$row->last_name.' '.$row->extension; ?></td>
                        <td><?php echo $row->tracking_number; ?></td>
                     </tr>
                <?php endforeach; ?>    
            </tbody>
         </table>
      </div>