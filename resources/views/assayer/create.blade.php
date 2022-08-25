@extends('layouts.app')
@section('content')
<create_worksheet_assayer-component :transids = "'{{ $transids }}'" :transmittal = "{{ $transmittal }}"></create_worksheet_assayer-component>
@endsection
@section('pagejs')
<script>
      var dateFormat = 'mm/dd/yy';   	
      $("#date-shift-assayed").datepicker({
        dateFormat: dateFormat,
        defaultDate: "+1w"
      });
      $("#date-shift-assayed").datepicker("setDate", $("#date-shift-assayed").attr("data-date-value"));
    </script>
@endsection