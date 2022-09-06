@extends('layouts.app')
@section('content')
<receive_analyst-component :transmittal = "{{ $transmittal }}"></receive_analyst-component>
@endsection