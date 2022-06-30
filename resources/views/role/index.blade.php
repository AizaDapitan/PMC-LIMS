@extends('layouts.app')

@section('content')
<index_role-component :roles="{{ $roles }}"></index_role-component>
@endsection