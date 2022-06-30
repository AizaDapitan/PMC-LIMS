@extends('layouts.app')
@section('content')
    <edit_permission-component :permission = "{{ json_encode($permission) }}"></edit_permission-component>
@endsection