@extends('layouts.app')
@section('content')
<edit_worksheet_assayer-component :worksheet = "{{ $worksheet }}"></edit_worksheet_assayer-component>
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