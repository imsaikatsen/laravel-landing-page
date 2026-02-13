@extends('layouts.dashboard')

@section('content')

<div class="alert alert-light border shadow-sm">
    Welcome back, <strong>{{ Auth::user()->name }}</strong>!
</div>

@endsection
