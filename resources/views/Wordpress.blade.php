@extends('layouts.app')
@section('title','Wordpress')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="wppage"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="row">

                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                @foreach(\App\WpSite::where('userId',Auth::user()->id)->get() as $wp)
                                    <div class="col-md-3">
                                        <div class="info-box">
                                                <span class="info-box-icon bg-gray"><i
                                                            class="fa fa-wordpress"></i></span>

                                            <div class="info-box-content">

                                                <span class="info-box-number">{{$wp->name}}</span>
                                                <div class="btn-group btn-block">
                                                    <button data-id="{{$wp->id}}"
                                                            class="btn delWp btn-xs btn-danger"><i
                                                                class="fa fa-trash"></i>
                                                        Delete
                                                    </button>
                                                    <a href="{{$wp->url}}" target="_blank"
                                                       class="btn btn-xs btn-primary"><i class="fa fa-link"></i>
                                                        Visit</a>
                                                </div>

                                                <a href="{{url('/wordpress/site').'/'.$wp->id}}"
                                                   class="btn btn-xs btn-success btn-block">Manage</a>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div><!-- /.nav-tabs-custom -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>

        @include('components.footer')
    </div>
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
@section('js')
    <script>
        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this post!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/wpdel')}}',
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        if (data == 'success') {
                            swal('Success', 'Deleted', 'success');
                        }
                        else {
                            swal('Error', data, 'error');
                        }
                    }
                })
            });


        })
    </script>
@endsection
