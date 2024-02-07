@extends('watchlisted.layout.watchlisted_master')
@section('title', 'Dashboard')
@section('content')
@include('includes.title')
<div class="row">
	<div class="col-md-4">
@include('watchlisted.contents.search.sections.search_form')
	</div>
	<div class="col-md-8">
@include('watchlisted.contents.search.sections.result_table')
	</div>
@endsection