@extends('layouts.admin-layout')
@section('title','Dashboard')
@section('content')
<h2>Restaurant Admin</h2>
<div class="d-flex gap-2 mt-3">
  <a href="{{ route('categories.index') }}" class="btn btn-primary">Categories</a>
  <a href="{{ route('meals.index') }}" class="btn btn-primary">Meals</a>
</div>
@endsection
