@extends('admin.layout.admin_master')
@section('title', $title)
@section('content')
@include('includes.title')

  <div class="col-12 mt-5">
                            <div class="card  animate__animated animate__zoomInDown " style="border: 1px solid;">
                                <div class="card-body">
                                    <div class="row">
                                        <form action="{{url('/back_up_db')}}" method="POST">
                                        	 @csrf
	                                        <div class="col-md-12">
	                                             <button class="btn  pull-right mb-2 back-up-database btn-primary">Back Up Now</button>
	                                        </div>
                                    	</form>
                                    </div>   
                                </div>
                            </div>
                        </div>
  


@endsection
@section('js')



@endsection