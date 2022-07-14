@extends('layouts.app')
@section('content')
<edit_qaqcreceiver-component :transmittal = "{{ $transmittal }}"></edit_qaqcreceiver-component>
@endsection