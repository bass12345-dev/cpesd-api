<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Documents</h5>
         </div>
         <table class="table table-hover table-striped " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
                  <th >Date Released</th>
                  <th >User </th>
                  <th >Date Received</th>
                  <th >User</th>
                  <th>Duration   </th>
                  <th>Remarks</th>

               </tr>
            </thead>
            <tbody>

               <?php foreach ($history as $row) : ?>
               <tr>
                  <td>{{$row['date_released']}}</td>
                  <td>{{$row['user1']}}</td>
                  <td>{{$row['date_received']}}</td>
                  <td>{{$row['user2']}}</td>
                  <td>{{$row['duration']}}</td>
                  <td><a href="javascript:;">View Remarks</a></td>
               </tr>
            <?php endforeach; ?>
            </tbody>
         </table>
      </div>