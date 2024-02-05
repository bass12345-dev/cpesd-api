

<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Information</h5>
         </div>
   <table class="table table-hover table-striped " style="width: 100%; "  >
      <tr>
         <td>Document Name</td>
         <td class="text-start">{{$doc_data['document_name']}}</td>
      </tr>
       <tr>
         <td>Tracking Number</td>
         <td>{{$doc_data['tracking_number']}}</td>
      </tr>
       <tr>
         <td>Encoded/Added By</td>
         <td>{{$doc_data['encoded_by']}}</td>
      </tr>
      <tr>
         <td>Office</td>
         <td>{{$doc_data['office']}}</td>
      </tr>
      <tr>
         <td>Document Type</td>
         <td>{{$doc_data['document_type']}}</td>
      </tr>
      <tr>
         <td>Description</td>
         <td>{{$doc_data['description']}}</td>
      </tr>
       <tr>
         <td>Qr Code</td>
         <td><img src="{{$doc_data['qr']}}"></td>
      </tr>
       <tr>
         <td>Status</td>
         <td><span class="{{$doc_data['is'] == true ? 'bg-success' : 'bg-danger' }} p-2 text-black badge " style="font-size: 17px;">{{ $doc_data['is'] == true? 'Completed' : 'Pending' }}</span></td>
      </tr>


   
      </tr>

   </table>      

</div>


