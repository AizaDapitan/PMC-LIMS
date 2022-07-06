@extends('layouts.app')
@section('content')
<edit_deptuser-component :transmittal = "{{ $transmittal }}"></edit_deptuser-component>
@endsection
@section('pagejs')
<script>

var dateFormat = 'mm/dd/yy',
    dateToday = new Date();

$("#date-submitted").datepicker({
  dateFormat: dateFormat,
  defaultDate: "+1w",
  minDate: dateToday,
  onSelect: function(selectedDate) {
    var option = this.id == "from" ? "minDate" : "maxDate",
        instance = $(this).data("datepicker"),
        date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
  }
});

$("#date-needed").datepicker({
  dateFormat: dateFormat,
  defaultDate: "+1w",
  minDate: dateToday,
  onSelect: function(selectedDate) {
    var option = this.id == "from" ? "minDate" : "maxDate",
        instance = $(this).data("datepicker"),
        date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
  }
});
</script>
@endsection