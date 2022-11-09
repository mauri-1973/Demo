<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                </div>
            </div>
        </nav>

        <main class="py-4">
        @yield('content')
        </main>
        @yield('footer-scripts')
    </div>
    <script>
    $(document).ready(function() {
        //Función inicial que carga los datos de los clientes registrados
        $("#example").html('');
        $("#example").html('<thead><tr><th>Id</th><th>Email</th><th>Fecha Ingreso</th><th>Acciones</th></tr></thead><tbody></tbody><tfoot><tr><th>Id</th><th>Email</th><th>Fecha Ingreso</th><th>Acciones</th></tr></tfoot>');
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "api/v1/clients", 
                "type": "GET",
                "dataType": "json",
                'beforeSend': function (request) {
                        request.setRequestHeader("X-CSRF-TOKEN", '{{ csrf_token() }}');
                },
                
            },
            "responsive": true,
            "columns": [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'join_date', name: 'join_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
            ],
            "order": [[1, 'asc']],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            }
        } );
    } );
    function initial()
    {
        //Función que reestructura la tabla de datos para mostrar los clientes
        $('#example').dataTable().fnDestroy();
        $("#example").html('');
        $("#example").html('<thead><tr><th>Id</th><th>Email</th><th>Fecha Ingreso</th><th>Acciones</th></tr></thead><tbody></tbody><tfoot><tr><th>Id</th><th>Email</th><th>Fecha Ingreso</th><th>Acciones</th></tr></tfoot>');
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "api/v1/clients", 
                "type": "GET",
                "dataType": "json",
                'beforeSend': function (request) {
                        request.setRequestHeader("X-CSRF-TOKEN", '{{ csrf_token() }}');
                },
                
            },
            "responsive": true,
            "columns": [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'join_date', name: 'join_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
            ],
            "order": [[1, 'asc']],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            }
        } );
        
    }
    function viewhistory(iduser)
    {
        //Función que reestructura la tabla de datos para mostrar los pagos de clientes
        $('#example').dataTable().fnDestroy();
        $("#example").html('');
        $("#example").html('<thead><tr><th>Id Pay</th><th>Payment Date</th><th>Expired Date</th><th>Status</th><th>Id Client</th><th>Ammount Pay</th><th>Ammount</th><th>Total</th><th>Acciones</th></tr></thead><tbody></tbody><tfoot><tr><th>Id Pay</th><th>Payment Date</th><th>Expired Date</th><th>Status</th><th>Id Client</th><th>Ammount Pay</th><th>Ammount</th><th>Total</th><th>Acciones</th></tr></tfoot>');
        $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "api/v1/payments", 
                "type": "GET",
                "dataType": "json",
                "data": {
                     "iduser": iduser,
                },
                'beforeSend': function (request) {
                        request.setRequestHeader("X-CSRF-TOKEN", '{{ csrf_token() }}');
                },
                
            },
            "responsive": true,
            "columns": [
            {data: 'uuid', name: 'uuid'},
            {data: 'payment_date', name: 'payment_date'},
            {data: 'expires_at', name: 'expires_at'},
            {data: 'status', name: 'status'},
            {data: 'client_id', name: 'client_id'},
            {data: 'clp_usd', name: 'clp_usd'},
            {data: 'usd_clp', name: 'usd_clp'},
            {data: 'total', name: 'total'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "columnDefs": [
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    },
            ],
            "order": [[2, 'asc']],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
            }
        } );
    }
    function addpay(idpay, paydate, expdate, status, idcli, pay, dolar)
    {
        //Función que abre la ventana modal para actualizar el pago de los clientes. Se utiliza un formulario directo al controlador api/v1/payments.store
        var todayDate = new Date().toISOString().slice(0, 10);
        $("#modalbody").html("");
        $("#modalbody").html('<div class="row"><div class="col-sm-10 offset-sm-1"><h3>Add Payment</h3>@if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div><br />@endif<form method="post" action="{{ url("api/v1/payments") }}">@csrf<div class="form-group"><label for="idpay">Id Pay:*</label><input type="text" class="form-control" name="idpay" value="'+idpay+'" readonly /> </div><div class="form-group"><label for="paydate">Pay Date:*</label><input type="text" class="form-control" name="paydate" value="'+todayDate+'" readonly /></div><div class="form-group"><label for="expdate">Pay Expired:</label><input type="text" class="form-control" name="expdate" value="'+expdate+'" readonly /></div><div class="form-group"><label for="status">Status:</label><input type="text" class="form-control" name="status" value="'+status+'" readonly /></div><div class="form-group"><label for="idcli">Id Client:</label><input type="text" class="form-control" name="idcli" value="'+idcli+'" readonly /></div><div class="form-group"><label for="pay">Pay:</label><input type="text" class="form-control" name="pay" value="'+pay+'" readonly /></div><div class="form-group"><label for="dolval">Dollar Value:</label><input type="text" class="form-control" name="dolvalue" value="'+dolar+'" readonly /></div><button type="submit" class="btn btn-primary">Update</button></form></div></div>');
        $("#exampleModal").modal("show");
        
        
    }
</script>
</body>
</html>
