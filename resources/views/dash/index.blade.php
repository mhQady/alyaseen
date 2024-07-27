@extends('dash.layout.app')
@section('title', __('main.dashboard'))
@section('main_folder', __('main.dashboard'))
@section('sub_folder', __('main.dashboard'))
@section('content')

<a class="btn btn-primary" href="{{ route('dash.test.notification') }}">Test Notification</a>

@endsection