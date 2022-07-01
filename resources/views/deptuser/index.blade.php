@extends('layouts.app')

@section('content')
<index_deptuser-component :deptusers="{{ $deptusers }}"></index_deptuser-component>
@endsection