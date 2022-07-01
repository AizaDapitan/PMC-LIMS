@extends('layouts.app')
@section('content')
<deptuser-dashboard></deptuser-dashboard>
@endsection

@section('pagejs')
<script>
      $(function(){
        'use strict'

        $('#example1').DataTable({
          language: {
            searchPlaceholder: 'Search',
            sSearch: '',
            lengthMenu: 'Show _MENU_ entries',
          },
          columnDefs: [
            { targets: 9, orderable: false }
          ],
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          "buttons": [
            { extend: "colvis", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="columns" class="mg-r-5"></i> Columns` },
            { extend: "copyHtml5", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="copy" class="mg-r-5"></i> Copy` },
            { extend: "csvHtml5", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="file-text" class="mg-r-5"></i> CSV` },
            { extend: "excelHtml5", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="file-text" class="mg-r-5"></i> Excel` },
            { extend: "pdfHtml5", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="file-text" class="mg-r-5"></i> PDF` },
            { extend: "print", className: "btn tx-13 btn-uppercase pd-x-15 btn-white tx-medium rounded", text: `<i data-feather="printer" class="mg-r-5"></i> Print` }
          ],
          dom: '<"d-flex flex-column-reverse flex-lg-row flex-md-row justify-content-between mb-2" <"col1"<"#table-append1">><"col2"B>><"row" <"col-md-6"l><"col-md-6 d-flex flex-column flex-lg-row flex-md-row justify-content-end"f<"#table-append2">>><"dataTables_responsive"t>ip',
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
        // Table Append Button/Dropdown
        $('#table-append1').append(`
          <div class="d-flex justify-content-start">
            <div class="mg-r-5">  
              <a href="create-form-transmittal-dept-user.html" class="btn btn-primary tx-13 btn-uppercase" type="button">
                <i data-feather="plus" class="mg-r-5"></i> Create
              </a>
              <button class="btn btn-white tx-13 btn-uppercase" type="button">
                <i data-feather="upload" class="mg-r-5"></i> Export
              </button>
            </div>
            <div>
              <button class="btn btn-white btn-sm dropdown-toggle tx-medium d-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="sliders" class="mg-r-5"></i> Actions
              </button>
              <div class="dropdown-menu bg-white">
                <a class="dropdown-item" href="#">Publish</a>
                <a class="dropdown-item" href="#">Private</a>
                <a class="dropdown-item text-danger" href="#">Delete</a>
              </div>
            </div>
        `);
        $('#table-append2').append(`
          <a class="btn tx-13 btn-success btn-uppercase mg-b-20 ml-lg-1 ml-md-1" href="#" data-toggle="modal" data-target="#advanceSearchModal">Advanced Search</a>
        `);
      });
    </script>
    <script>

      var dateFormat = 'mm/dd/yy',

      from1 = $('#dateFrom1')
          .datepicker({
          defaultDate: '+1w',
          numberOfMonths: 2
        })
        .on('change', function() {
          to1.datepicker('option','minDate', getDate( this ) );
        }),

      to1 = $('#dateTo1').datepicker({
          defaultDate: '+1w',
          numberOfMonths: 2
        })
        .on('change', function() {
          from1.datepicker('option','maxDate', getDate( this ) );
        });

      from2 = $('#dateFrom2')
          .datepicker({
          defaultDate: '+1w',
          numberOfMonths: 2
        })
        .on('change', function() {
          to2.datepicker('option','minDate', getDate( this ) );
        }),

      to2 = $('#dateTo2').datepicker({
          defaultDate: '+1w',
          numberOfMonths: 2
        })
        .on('change', function() {
          from2.datepicker('option','maxDate', getDate( this ) );
        });

      function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }

        return date;
      }
    </script>
@endsection