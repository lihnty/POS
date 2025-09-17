@extends('layouts.app')
@section('content_title', 'Dashboard')
@section('content')
<div class="card">
    <div class="card-body">
        Welcome to the Aplication POS kasir <strong class="capitalize">{{ auth()->user()->name }}</strong>
    </div>
</div>
@endsection