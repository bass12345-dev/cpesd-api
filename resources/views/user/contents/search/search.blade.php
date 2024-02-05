@extends('user.layout.user_master')
@section('title', 'My Documents')
@section('content')

@include('includes.title')
<div class="container">
                    <div class="row height d-flex justify-content-center ">

                      <div class="col-md-8">
                      	<form id="search_form">

                        <div class="search">
                          <i class="fa fa-search"></i>
                          <input type="text" class="form-control" placeholder="Enter Tracking Number" name="tracking_number" required>
                          <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    	</form>
                        
                      </div>
                      
                    </div>
                </div>
@endsection
@section('js')

<script type="text/javascript">

	$('form#search_form').on('submit', function(e){
		e.preventDefault();
		window.location.href = base_url + '/dts/user/view?tn=' +$('input[name=tracking_number]').val();
	})
	
</script>

@endsection