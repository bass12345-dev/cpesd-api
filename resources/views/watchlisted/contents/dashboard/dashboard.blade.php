@extends('watchlisted.layout.watchlisted_master')
@section('title', 'Dashboard')
@section('content')
@include('includes.title')
@include('watchlisted.contents.dashboard.sections.count')
@endsection