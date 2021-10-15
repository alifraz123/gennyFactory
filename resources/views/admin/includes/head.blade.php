<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminassets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminassets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <style>
    body{
        font-size: 14px;
    }
</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="adminassets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav style="background-color: #343a40;" class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" style="color: white;" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item ">
          <span style="color: white;" class="nav-link "  >
         <p id="AccountHeadValue">{{Session::get('AH')}}</p> 
          </span>

        </li>
        
        <li class="nav-item d-none d-sm-inline-block">
          <div style="font-weight: bold;color: darkkhaki;color:white" class="nav-link">
            <select class="select2" onchange="setSessionAH(this.value)"  id="AccountHead">
              <option disabled selected>Select AccountHead...</option>
            </select>
          </div>
        </li>


      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        @guest

        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item ">
          <span style="color: white;">
            
          </span>
        </li>

        
        <li class="nav-item ">
          <span style="color: white;" class="nav-link "  >
         <p id="AccountHeadCompanyName">{{Session::get('CompanyName')}}</p> 
          </span>

        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <div style="font-weight: bold;color: darkkhaki;color:white" class="nav-link">
            <select class="select2" onchange="setSessionCompany(this.value)" name="" id="Companies">
              <option disabled selected>Choose company name...</option>
            </select>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a id="navbarDropdown" style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>



        @endguest
      </ul>

    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
      $.ajax({
            url: 'getAccountHeadFromUserAccountTable',
            type: 'get',
            success: function(data) {
                // console.log(data)
                var roles = '';
                roles += '<option disabled selected>Choose accounthead...</option>';
                    data.forEach(el => {
                        roles += `
                    <option value="${el.AccountHead}">${el.AccountHead}</option>
                    `;
                        document.getElementById('AccountHead').innerHTML = roles;
                    });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

        function  setSessionAH(value){
          // alert(value)
          $.ajax({
            url: 'setSessionAH',
            type: 'get',
            data : {
              value:value
            },
            success: function(data) {
                // console.log(data)
                location.reload();
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        }

        $.ajax({
            url: 'getCompaniesFromAccountsCompany',
            type: 'get',
            success: function(data) {
                // console.log(data)
                var roles = '';
                roles += '<option disabled selected>Choose companies...</option>';
                    data.forEach(el => {
                        roles += `
                    <option value="${el.CompanyName}">${el.CompanyName}</option>
                    `;
                        document.getElementById('Companies').innerHTML = roles;
                    });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

        function  setSessionCompany(value){
          // alert(value)
          $.ajax({
            url: 'setSessionCompany',
            type: 'get',
            data : {
              value:value
            },
            success: function(data) {
                // console.log(data)
                location.reload();
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        }

       
    </script>
    <!-- /.navbar -->