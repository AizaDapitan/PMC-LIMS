@extends('layouts.app')
@section('content')
<receive_digester-component :transmittal = "{{ $transmittal }}"></receive_digester-component>
@endsection