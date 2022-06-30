@extends('layouts.app')

@section('pagecss')
<style>
        td {
            padding: 5px 10px !important;
        }
        .access-tbl {
            border-radius: 6px;
            background: #f9f9f9;
        }
    </style>
@endsection
@section('content')
    <edit_role-component :role = "{{ json_encode($role) }}"></edit_role-component>
@endsection

@section('pagejs')

        <script src="{{env('APP_URL')}}/assets/lib/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
        <script src="{{env('APP_URL')}}/assets/lib/parsleyjs/parsley.min.js"></script>
        <script src="{{env('APP_URL')}}/assets/lib/jquery-steps/build/jquery.steps.min.js"></script>
        <script src="{{env('APP_URL')}}/assets/lib/jqueryui/jquery-ui.min.js"></script>
        <script src="{{env('APP_URL')}}/assets/js/listing.js"></script>

        <script>
            $(document).ready(function() {
                $('.card-select .card-header, .card-select .card-body').click(function () {
                    let parentDiv = $(this).parent();
                    let checkInput = parentDiv.hasClass("bg-primary");
                    if(checkInput) {
                        parentDiv.removeClass("text-white");
                        parentDiv.find("input[type='checkbox']").prop('checked', false);
                        parentDiv.removeClass("bg-primary");
                        parentDiv.find("select").prop('disabled', true);
                    } else {
                        parentDiv.addClass("bg-primary");
                        parentDiv.addClass("text-white");
                        parentDiv.find("input[type='checkbox']").prop('checked', true);
                        parentDiv.find("select").prop('disabled', false);
                    }
                });
                $('#accordion').accordion({
                    heightStyle: 'content',
                    collapsible: true,
                    active: false
                });
            });
			$('#wizard2').steps({
                headerTag: 'h3',
                bodyTag: 'section',
                autoFocus: true,
                transitionEffect: 1,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                onStepChanging: function (event, currentIndex, newIndex) {

                    return true;
                }
                });
		</script>
        
@endsection