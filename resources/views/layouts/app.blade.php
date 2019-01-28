<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>
    @yield('headjs')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    {{--Bootstrap and Sass--}}
    <link rel="stylesheet" href="{{ url('css/app.css') }}">

    {{--AdminLTE and Less--}}
    <link rel="stylesheet" href="{{ url('css/admin.css') }}">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{--Plugins CSS--}}

    <link rel="stylesheet" href="{{ url(elixir('css/plugins.css')) }}">
    {{--custom css--}}
    <link rel="stylesheet" href="{{url('/opt/css/custom.css')}}">
    <link rel="stylesheet" href="{{url('/opt/intro/introjs.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    {{--<script src="{{url('/opt/sweetalert.min.js')}}"></script>--}}
    {{--<link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">--}}
    {{--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootcards/1.0.0/css/bootcards-ios.min.css">--}}


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--emoji --}}
    <link rel="stylesheet" href="{{url('/opt/emoji/emojionearea.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/iziToast.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <link rel="stylesheet" href="{{url('/css/custome.css')}}">


    @yield('css')
    <style>
        .col-md-1 img {
            width: 60px;
            border-radius: 4px;
            -webkit-box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 0px 31px 0px rgba(0, 0, 0, 0.15);
        }

        #themSelector {
            margin: 2px;
        }


    </style>
</head>
{{--<body class="hold-transition fixed sidebar-mini skin-red-light">--}}
<body class="hold-transition fixed sidebar-mini @if(Auth::user()->theme == "") skin-red @else {{Auth::user()->theme}} @endif">

@yield('content')
<script>
    function appPath() {
        return "{{url('/')}}";
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{--<script src="{{ url('js/app.js') }}"></script>--}}

<script src="{{url('/build/js/app-2833883924.js')}}"></script>
{{--<script src="{{ url('js/app.js') }}"></script>--}}
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://unpkg.com/flatpickr"></script>
<script src="{{url('/opt/pdfmake.min.js')}}"></script>
<script src="{{url('/opt/vfs_fonts.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script src="{{url('/opt/intro/intro.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="{{url('/opt/emoji/emojionearea.min.js')}}"></script>

<script type="text/javascript" src="{{url('/opt/toast.js')}}"></script>
<script type="text/javascript" src="{{url('/js/iziToast.min.js')}}"></script>


<script>

    $(document).ready(function () {

            $.ajax({
                type: 'GET',
                url: '{{url('updater.check')}}',
                async: false,
                success: function (response) {
                    console.log(response);
                    if (response.version != '') {
                        @if(!Request::is('software/update'))
                        // show notifications
                        iziToast.show({
                            id: 'haduken',
                            theme: 'dark',
                            title: 'New Update Available !',
                            displayMode: 2,
                            position: 'topCenter',
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX',
                            progressBarColor: 'rgb(0, 255, 184)',
                            imageWidth: 70,
                            layout: 1,
//                        timeout: 10000,
                            onClosing: function () {
                                console.info('onClosing');
                            },
                            onClosed: function (instance, toast, closedBy) {
                                console.info('Closed | closedBy: ' + closedBy);
                            },
                            iconColor: 'rgb(0, 255, 184)',
                            buttons: [
                                ['<a href=""><i class="fa fa-refresh"></i> Update Now</a>', function (instance, toast) {

                                    // instance.hide({ transitionOut: 'fadeOutUp' }, toast);

                                    window.location.replace("{{url('/software/update')}}");

                                }, true],
                                ['<button>Update Later</button>', function (instance, toast) {

                                    instance.hide({transitionOut: 'fadeOutUp'}, toast);


                                }]
                            ]
                        });
                        @endif


                        $('#update_notification').append('<strong>Update Available <span class="badge badge-pill badge-info">v. ' + response.version + '</span></strong><a style="text-decoration: none;" href="{{url('/updater.update')}}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update Now</a><br><br><br>');
                        $('#update_notification').append('<div class="box no-border">' +
                            '<div class="box-body"> ' + '<b style="color:black">'+
                            response.description + "</b>"+
                            '</div></div>');
                        $('#update_notification').show();
                    }
                }
            });


            $('#intro').click(function () {
                introJs().start();
            });

            var visited = "{{\App\Http\Controllers\VisitedController::isVisited(Request::url())}}";
            if (visited == "no") {
                introJs().start();
            }


            if (document.getElementById('status')) {
                $("#status").emojioneArea({
                    pickerPosition: "bottom"
                });
            }

            if (document.getElementById('skype')) {
                $("#message").emojioneArea();
            }
        }
    );
    // notification start


    document.addEventListener('DOMContentLoaded', function () {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
    });


    $('.lang').click(function () {
        var lang = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: '{{url('/language/change')}}',
            data: {
                'lang': lang
            },
            success: function (data) {
                if (data == "success") {
                    location.reload();
                } else {
                    alert(data);
                }
            },
            error: function (data) {
                alert("Something went wrong , Please check console message or log");
                console.log(data.responseText);
            }
        });
        alert("Changing language");
    })
</script>
@yield('js')
<script>
    $(document).ready(function () {


        var table = $('#mytable').DataTable({
            responsive: true,

            dom: '<""flB>tip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<button class="btn btn-success btn-xs fak"><i class="fa fa-file-excel-o"></i> Export all to excel</button>'
                },
                {
                    extend: 'csv',
                    text: '<button class="btn btn-warning btn-xs fak"><i class="fa fa-file-o"></i> Export all to csv</button>'
                },
                {
                    extend: 'pdf',
                    text: '<button class="btn btn-danger btn-xs fak"><i class="fa fa-file-pdf-o"></i> Export all to pdf</button>'
                },
                {
                    extend: 'print',
                    text: '<button class="btn btn-default btn-xs fak"><i class="fa fa-print"></i> Print all</button>'
                },
            ]
        });


    });

    $('input[name=optionsRadios]').click(function () {
        var theme = $('input[name=optionsRadios]:checked').val();
        $.ajax({
            url: '{{url('/settings/update/theme')}}',
            type: 'POST',
            data: {
                'theme': theme
            },
            success: function (data) {
                if (data == 'success') {
                    location.reload();
                } else {
                    console.log(data);
                }
            }
        });

    });


    introJs().addHints();

</script>
</body>
</html>
