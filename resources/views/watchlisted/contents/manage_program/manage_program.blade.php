@extends('watchlisted.layout.watchlisted_master')
@section('title', 'Manage Program')
@section('content')
@include('includes.title')
<div class="row">
	<div class="col-md-7">
		@include('watchlisted.contents.manage_program.sections.program_table')
	</div>
	<div class="col-md-5">
		@include('watchlisted.contents.manage_program.sections.add_form')
	</div>
</div>

@endsection