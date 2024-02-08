

<div class="card flex-fill p-3">
         <div class="card-header">
            <h5 class="card-title mb-0">Information</h5>
         </div>
   <table class="table table-hover table-striped " style="width: 100%; "  >
      <tr>
         <td>Full Name</td>
         <td >{{$person_data['first_name']}} {{$person_data['middle_name']}}  {{$person_data['last_name']}} {{$person_data['extension']}}</td>
      </tr>
       <tr>
         <td>Email Address</td>
         <td>{{$person_data['email_address']}}</td>
      </tr>
       <tr>
         <td>Phone Number</td>
         <td>{{$person_data['phone_number']}}</td>
      </tr>
      <tr>
         <td>Address</td>
         <td>{{$person_data['address']}}</td>
      </tr>
      <tr>
         <td>Age</td>
         <td>{{$person_data['age']}}</td>
      </tr>
      <tr>
         <td>Added</td>
         <td>{{$person_data['created_at']}}</td>
      </tr>
       <tr>
         <td>Status</td>
         <td><span class="{{$person_data['status'] == 'active' ? 'bg-danger' : 'bg-success' }} p-2 text-black badge " style="font-size: 17px;">{{ $person_data['status'] == 'active'? 'Active' : 'Safe' }}</span></td>
      </tr>
      

   </table>      

</div>


