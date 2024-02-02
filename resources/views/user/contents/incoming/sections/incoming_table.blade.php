<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Documents</h5>
         </div>
         <table class="table table-hover table-striped " id="datatables-buttons" style="width: 100%; "  >
            <thead>
               <tr>
                
                  <th class="">Tracking Number</th>
                  <th class="">Document Name</th>
                  <th class="">From</th>
                  <th class="">Document Type</th>
                  <th class="">Remarks</th>
                  <th class="">Released Date - Time</th>
                  <th class="">Action</th>
               </tr>
            </thead>
            <tbody>

              <?php foreach ($incoming_documents as $row) :  ?>
                <tr>
                  <td>{{$row['tracking_number']}}</td>
                  <td>{{$row['document_name']}}</td>
                  <td>{{$row['from']}}</td>
                  <td>{{$row['type_name']}}</td>
                  <td><a href="javascript:;" >View Remarks</a></td>
                  <td>{{$row['released_date']}}</td>
                  <td>    
                           <div class="btn-group dropstart">
                             <i class="fa fa-ellipsis-v " class="dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                             <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" id="received_document" href="#" data-id="{{$row['history_id']}}">Received</a></li>
                                  <li><a class="dropdown-item" href="#">View Information</a></li>
                                </ul>
                           </div>
                        </td>
                </tr>
              <?php endforeach; ?> 
            </tbody>
         </table>
      </div>




