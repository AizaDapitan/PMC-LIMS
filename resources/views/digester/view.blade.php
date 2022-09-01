@extends('layouts.app')
@section('content')
<view_digester-component :worksheet = "{{ $worksheet }}" :isReadyforApproval = "{{ $isReadyforApproval }}"></view_digester-component>
@endsection