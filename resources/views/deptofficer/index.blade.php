@extends('layouts.app')

@section('content')
<index_deptofficer-component :deptofficers="{{ $deptofficers }}"></index_deptofficer-component>
@endsection