@extends('layouts.app')
@section('content')
<edit_transmittal_analyst-component :transmittal = "{{ $transmittal }}"></edit_transmittal_analyst-component>
@endsection