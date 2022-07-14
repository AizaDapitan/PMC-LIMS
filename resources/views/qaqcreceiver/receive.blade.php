@extends('layouts.app')
@section('content')
<receive_qaqcreceiver-component :transmittal = "{{ $transmittal }}"></receive_qaqcreceiver-component>
@endsection