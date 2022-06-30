@extends('layouts.app')

@section('content')
<index_permission-component :permissions = "{{ $permissions }}" ></index_permission-component>
@endsection