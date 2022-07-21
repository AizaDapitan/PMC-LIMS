<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Meta -->
  <meta name="description" content="" />
  <meta name="author" />

  <!-- CSRF Token -->

  <title>Philsaga - Laboratory Information and Management System</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{env('APP_URL')}}/assets/img/favicon.png" />


  <!-- vendor css -->
  <link href="{{env('APP_URL')}}/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/typicons.font/typicons.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/prismjs/themes/prism-vs.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/datatables.net-buttons/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}/lib/select2/css/select2.min.css" rel="stylesheet">

  <!-- DashForge CSS -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/dashforge.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/assets/css/dashforge.dashboard.css">
  <!-- vue JS -->
  <link rel="stylesheet" href="{{env('APP_URL')}}/assets/primeicons-master/primeicons.css" />

  @yield('pagecss')
</head>

<body>

  <aside class="aside aside-fixed">
    <div class="aside-header">
      <div id="logo">
        <a href="{{env('APP_URL')}}/assets/img/logo-dark.svg" target="_blank" class="aside-logo standard-logo" data-dark-logo="{{env('APP_URL')}}/assets/img/logo-dark.svg"><img src="{{env('APP_URL')}}/assets/img/logo.svg" alt="LIMS logo"></a>
      </div>
      <a href="" class="aside-menu-link">
        <i data-feather="menu"></i>
        <i data-feather="x"></i>
      </a>
    </div>
    <div class="aside-body">
      <div class="aside-loggedin">
        <div class="d-flex justify-content-center">
          <a href="{{env('APP_URL')}}/assets/img/user.png" target="_blank" class="avatar wd-100"><img src="{{env('APP_URL')}}/assets/img/user.png" class="rounded-circle" alt="" /></a>
        </div>
        <div class="aside-loggedin-user tx-center">
          <h6 class="tx-semibold mg-b-0">{{ Auth::user()->name }}</h6>
          <p class="tx-color-03 tx-13 mg-b-0 tx-uppercase">{{ Auth::user()->role }}</p>
        </div>
      </div><!-- aside-loggedin -->
      <ul class="nav nav-aside">
        <li class="nav-label">LIMS</li>
        <li class="nav-item with-sub {{ (request()->is('deptuser/*')) ? 'active show' : '' }}">
          <a href="" class="nav-link"><i data-feather="home"></i> <span>Dept. Requesters(User)</span></a>
          <ul>
            <li class="{{ (request()->is('deptuser/dashboard*')) ? 'active' : '' }}"><a href="{{ route('deptuser.index') }}">Dashboard</a></li>
            <li class="{{ (request()->is('deptuser/create-transmittal')) ? 'active' : '' }}"><a href="{{ route('deptuser.create') }}">Create Transmittal</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item with-sub {{ (request()->is('deptofficer/*')) ? 'active show' : '' }}">
          <a href="#" class="nav-link"><i data-feather="home"></i> <span>Dept. Requesters(Officer)</span></a>
          <ul>
            <li class="{{ (request()->is('deptofficer/dashboard*')) ? 'active' : '' }}"><a href="{{ route('deptofficer.index') }}">Dashboard</a></li>
            
          </ul>
        </li> -->
        <li class="nav-item {{ (request()->is('deptofficer/dashboard*')) ? 'active' : '' }}"><a href="{{ route('deptofficer.index') }}" class="nav-link"><i data-feather="bell"></i> <span>Dept. Requesters(Officer)</span></a></li>
        <li class="nav-item {{ (request()->is('qaqcreceiver/dashboard*')) ? 'active' : '' }}"><a href="{{ route('qaqcreceiver.index') }}" class="nav-link"><i data-feather="bell"></i> <span>Receiving</span></a></li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="bell"></i> <span>Assayer</span></a>
          <ul>
            <li><a href="dashboard-qa-qc-assayer.html">Manage</a></li>
            <li><a href="#">Add New</a></li>
            <li><a href="#">Reassay</a></li>
          </ul>
        </li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="bell"></i> <span>Analyst</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="bell"></i> <span>Officer</span></a></li>
        
        <li class="nav-label mg-t-25">Maintenance</li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="users"></i> <span>User Maintenance</span></a>
          <ul>
            <li><a href="manage-users.html">Manage Users</a></li>
            <li><a href="create-new-user.html">Create New User</a></li>
          </ul>
        </li>
        <li class="nav-item with-sub {{ (request()->is('roles/*')) ? 'active show' : '' }}">
          <a href="" class="nav-link"><i data-feather="users"></i> <span>Roles</span></a>
          <ul>
            <li class="{{ (request()->is('roles/list*')) ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Manage</a></li>
            <li class="{{ (request()->is('roles/create')) ? 'active' : '' }}"><a href="{{ route('roles.create') }}">Create</a></li>
          </ul>
        </li>
        <li class="nav-item with-sub {{ (request()->is('permissions/*')) ? 'active show' : '' }}">
          <a href="" class="nav-link"><i data-feather="users"></i> <span>Permissions</span></a>
          <ul>
            <li class="{{ (request()->is('permissions/list*')) ? 'active' : '' }}"><a href="{{ route('permissions.index') }}">Manage</a></li>
            <li class="{{ (request()->is('permissions/create')) ? 'active' : '' }}"><a href="{{ route('permissions.create') }}">Add New</a></li>
          </ul>
        </li>
         <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>User Action Monitoring</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>Application Error Logs</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>Application Maintenance</span></a></li>
      </ul>
    </div>
  </aside>

  <div class="content ht-100v pd-0">
    <div class="content-header">
      <div class="content-search content-company wd-100p-f mx-wd-500-f excerpt-1 pd-r-20">
        <h3 class="tx-15 mg-b-0 text-md-white">Philsaga - Laboratory Information and Management System</h3>
      </div>

      <div class="dropdown dropdown-profile">
        <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
          <div class="avatar avatar-sm">
            <img src="{{env('APP_URL')}}/assets/img/user.png" class="rounded-circle" alt="" />
          </div>
        </a>
        <!-- dropdown-link -->
        <div class="dropdown-menu dropdown-menu-right tx-13">
          <h6 class="tx-semibold mg-b-5">{{ Auth::user()->name }}</h6>
          <p class="tx-12 tx-color-03">{{ Auth::user()->role }}</p>
          <div class="dropdown-divider"></div>

          <!-- <a href="account-settings.html" class="dropdown-item"><i data-feather="edit-3"></i> My Account Settings</a> -->
          <a href="{{ route('logout') }}" class="dropdown-item"><i data-feather="log-out"></i>Log Out</a>
        </div>
        <!-- dropdown-menu -->
      </div>
      <!-- dropdown -->
    </div><!-- content-header -->
    <notifications />
    <div class="content-body py-5 px-4" id="app">
      @yield('content')
    </div>


    <!-- Success -->
    <div class="pos-fixed b-10 r-10">
      <div id="toast_success" class="toast bg-success bd-0 wd-350" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success">
          <h6 class="tx-white tx-14 mg-b-0 mg-r-auto tx-semibold">
            <i data-feather="check-circle" width="14"></i> Success
          </h6>
          <button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
            <i data-feather="x" aria-hidden="true" class="tx-white wd-15"></i>
          </button>
        </div>
        @if (Session::has('success'))
        <div class="toast-body bg-success tx-white">
          {{ Session::get('success') }}
        </div>
        @endif
        remove
      </div>
    </div>

    <!-- Error -->
    <div class="pos-fixed b-10 r-10">
      <div id="toast_error" class="toast bg-danger bd-0 wd-350" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body pd-6 tx-white">
          <button type="button" class="ml-2 mb-1 close tx-normal tx-shadow-none" data-dismiss="toast" aria-label="Close">
            <span class="tx-white" aria-hidden="true">&times;</span>
          </button>
          <h6 class="mg-b-15 mg-t-15 tx-white">
            <i data-feather="alert-circle"></i> ERROR!
          </h6>
          <p>{{ Session::get('error') }}</p>
        </div>
      </div>
    </div>

    <!-- Error -->
    <div class="pos-fixed b-10 r-10">
      <div id="toastDynamicError" class="toast bg-danger bd-0 wd-350" data-delay="60000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body pd-6 tx-white">
          <button type="button" class="ml-2 mb-1 close tx-normal tx-shadow-none" data-dismiss="toast" aria-label="Close">
            <span class="tx-white" aria-hidden="true">&times;</span>
          </button>
          <h6 class="mg-b-15 mg-t-15 tx-white">
            <i data-feather="alert-circle"></i> ERROR!
          </h6>
          <p id="errorMessage"></p>
        </div>
      </div>
    </div>

    <div class="pos-absolute b-10 r-20 z-index-200">
      <div id="toastErrorMessage" class="toast bg-danger bd-0 wd-350" data-delay="10000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger">
          <h6 class="tx-white tx-14 mg-b-0 mg-r-auto tx-semibold">
            <i data-feather="x-circle" width="14"></i> Failed
          </h6>
          <button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
            <i data-feather="x" aria-hidden="true" class="tx-white wd-15"></i>
          </button>
        </div>
        <div class="toast-body bg-danger tx-white">
          <ul id="errorMessage" style="list-style-type: none; padding-inline-start: 0px">
            @if ($errors->any()) @foreach ($errors->all() as $error)
            <li><i class="mg-r-10"></i> {{ $error }}</li>
            @endforeach @endif
          </ul>
        </div>
      </div>
    </div>

    <div class="modal effect-scale" id="prompt-banner-error" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Failed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="bannerErrorMessage"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{env('APP_URL')}}/lib/jquery/jquery.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/feather-icons/feather.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- vendor script -->
    <script src="{{env('APP_URL')}}/lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/buttons.dataTables.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/buttons.bootstrap.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/jszip.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/pdfmake.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/datatables.net-buttons/js/vfs_fonts.js"></script>
    <script src="{{env('APP_URL')}}/lib/select2/js/select2.min.js"></script>
    <script src="{{env('APP_URL')}}/lib/jqueryui/jquery-ui.min.js"></script>

    <script src="{{env('APP_URL')}}/assets/js/dashforge.js"></script>
    <script src="{{env('APP_URL')}}/assets/js/dashforge.aside.js"></script>


    @yield('pagejs')
    <script>
      let saveFile = () => {
        // Get the data from each element on the form.
        const cssCode = editor.getCss();
        const htmlCode = editor.getHtml();

        // This variable stores all the data.
        let data = cssCode + " \r\n " + htmlCode;

        // Write data in 'Output.txt' .
        fs.writeFile("Output.txt", data, (err) => {
          // In case of a error throw err.
          if (err) throw err;
        });
      };
    </script>
</body>

</html>