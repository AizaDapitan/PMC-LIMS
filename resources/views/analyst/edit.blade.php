@extends('layouts.app')
@section('content')
<edit_analyst-component :worksheet = "{{ $worksheet }}"></edit_analyst-component>
@endsection