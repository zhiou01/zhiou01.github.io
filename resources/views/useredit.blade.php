@extends('layouts.app')
@section('title','Edit user | SocialLit')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div  style="padding:10px" class="row">
                    <div  class="box no-border">
                        <div class="box-body">
                            <div class="col-md-12">

                                <div class="col-md-6">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                            <input class="form-control" id="email"
                                                   placeholder="Your Email" value="{{$email}}" type="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name"><i class="fa fa-user"></i> Name</label>
                                            <input class="form-control" id="name"
                                                   placeholder="Your Name" value="{{$name}}" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="pass"><i class="fa fa-key"></i> Password</label>
                                            <input class="form-control" value="" id="pass"
                                                   placeholder="Password" type="password">
                                        </div>

                                        {{-- Available plugins list--}}

                                        <div id="plugins" class="form-group">
                                            <div class="form-group">
                                                <label>Available features</label>
                                            </div>

                                            <div class="form-group">
                                                <label>Select more Packages/features for this users</label>
                                            </div>
                                            @foreach($plugins as $plugin)
                                                <div class="box @if(\App\Http\Controllers\Plugins::check($plugin['name'],$id)) box-success @endif">


                                                    <div class="box-header">

                                                        <kbd>{{$plugin['name']}}</kbd> <br>
                                                    </div>

                                                    <div class="box-body">
                                                        {!! $plugin['description'] !!}
                                                    </div>
                                                    <div class="box-footer">

                                                        <div class="btn-group-xs">
                                                            <button data-id="{{$plugin['name']}}"
                                                                    @if(!\App\Http\Controllers\Plugins::check($plugin['name'],$id)) disabled
                                                                    @endif class="btn btn-danger btn-disable">Disable
                                                            </button>
                                                            <button data-id="{{$plugin['name']}}"
                                                                    @if(\App\Http\Controllers\Plugins::check($plugin['name'],$id)) disabled
                                                                    @endif class="btn btn-primary btn-enable">Enable
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="box-footer">
                                            <button id="save" class="btn btn-block btn-success"><i
                                                        class="fa fa-save"></i>
                                                Update User
                                            </button>
                                        </div>



                                    </div><!-- /.box-body -->
                                </div>

                                <div class="col-md-6">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Packages</label>
                                            </div>

                                            <div class="form-group">
                                                <label>Select packages for this user</label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input id="fb" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'fb')) checked @endif>
                                                    <i class="fa fa-facebook"></i> Facebook
                                                </label>
                                            </div>


                                            <div class="checkbox">
                                                <label>
                                                    <input id="tw" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'tw')) checked @endif>
                                                    <i class="fa fa-twitter"></i> Twitter
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="tu" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'tu')) checked @endif>
                                                    <i class="fa fa-tumblr"></i> Tumblr
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="wp" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'wp')) checked @endif>
                                                    <i class="fa fa-wordpress"></i> Wordpress
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="ln" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'ln')) checked @endif>
                                                    <i class="fa fa-linkedin"></i> Linkedin
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="in" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'in')) checked @endif>
                                                    <i class="fa fa-instagram"></i> Instagram
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input id="pinterest" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'pinterest')) checked @endif>
                                                    <i class="fa fa-pinterest"></i> Pinterest
                                                </label>
                                            </div>


                                            <div class="checkbox">
                                                <label>
                                                    <input id="fbBot" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'fbBot')) checked @endif>
                                                    <i class="fa fa-comment"></i> Facebook Messenger Bot
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input id="slackBot" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'slackBot')) checked @endif>
                                                    <i class="fa fa-slack"></i> Slack Bot
                                                </label>
                                            </div>


                                            <div class="checkbox">
                                                <label>
                                                    <input id="reddit" type="checkbox"
                                                           @if(\App\Http\Controllers\Data::hasPackage($id,'pack1')) checked @endif>
                                                    <i class="fa fa-reddit"></i> Reddit
                                                </label>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('css')
    <script src="{{url('/opt/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/opt/sweetalert.css')}}">
@endsection
@section('js')
    <script>
        var fb = "no", tw = "no", tu = "no", wp = "no", ln = "no", ins = "no", fbBot = "no", slackBot = "no", contacts = "no", pinterest = "no", reddit = "no";
        if ($('#fb').is(':checked')) {
            fb = 'yes';
        }
        if ($('#tw').is(':checked')) {
            tw = 'yes';
        }
        if ($('#tu').is(':checked')) {
            tu = 'yes';
        }
        if ($('#wp').is(':checked')) {
            wp = 'yes';
        }
        if ($('#in').is(':checked')) {
            ins = 'yes';
        }
        if ($('#ln').is(':checked')) {
            ln = 'yes';
        }
        if ($('#fbBot').is(':checked')) {
            fbBot = 'yes';
        }
        if ($('#slackBot').is(':checked')) {
            slackBot = 'yes';
        }
        if ($('#contacts').is(':checked')) {
            contacts = "yes";
        }
        if ($('#pinterest').is(':checked')) {
            pinterest = "yes";
        }

        if ($('#reddit').is(':checked')) {
            reddit = "yes";
        }

        //        changing stuff
        $('#fb').on('change', function () {
            if (this.checked) {
                fb = 'yes';
            } else {
                fb = 'no';
            }
        });

        $('#tw').on('change', function () {
            if (this.checked) {
                tw = 'yes';
            } else {
                tw = 'no';
            }
        });

        $('#tu').on('change', function () {
            if (this.checked) {
                tu = 'yes';
            } else {
                tu = 'no';
            }
        });

        $('#ln').on('change', function () {
            if (this.checked) {
                ln = 'yes';
            } else {
                ln = 'no';
            }
        });

        $('#in').on('change', function () {
            if (this.checked) {
                ins = 'yes';
            } else {
                ins = 'no';
            }
        });

        $('#wp').on('change', function () {
            if (this.checked) {
                wp = 'yes';
            } else {
                wp = 'no';
            }
        });

        $('#fbBot').on('change', function () {
            if (this.checked) {
                fbBot = 'yes';
            } else {
                fbBot = 'no';
            }
        });

        $('#slackBot').on('change', function () {
            if (this.checked) {
                slackBot = 'yes';
            } else {
                slackBot = 'no';
            }
        });

        $('#contacts').on('change', function () {
            if (this.checked) {
                contacts = "yes";
            } else {
                contacts = "no";
            }
        });

        $('#pinterest').on('change', function () {
            if (this.checked) {
                pinterest = "yes";
            } else {
                pinterest = "no";
            }
        });

        $('#reddit').on('change', function () {
            if (this.checked) {
                reddit = "yes";
            } else {
                reddit = "no";
            }
        });


        $('#save').click(function () {

            $.ajax({
                type: 'POST',
                url: '{{url('/user/update')}}',
                data: {
                    'id': '{{$id}}',
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'password': $('#pass').val(),
                    'fb': fb,
                    'tw': tw,
                    'tu': tu,
                    'wp': wp,
                    'in': ins,
                    'ln': ln,
                    'pinterest': pinterest,
                    'fbBot': fbBot,
                    'slackBot': slackBot,
                    'contacts': contacts,
                    'reddit': reddit

                },
                success: function (data) {
                    if (data == 'success') {
                        swal('Success', 'User information updated', 'success');
                        location.reload();
                    }
                    else {
                        swal('Error', data, 'error');
                    }
                },
                error: function (data) {
                    swal('Error', data, 'error');
                }
            });
        });
        $('.btn-enable').click(function () {
            var pluginName = $(this).attr('data-id');
            var userId = "{{$id}}";
            $.ajax({
                type: 'POST',
                url: '{{url('/plugin/active/for/user')}}',
                data: {
                    'pluginName': pluginName,
                    'userId': userId,
                    'action': 'enable'
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Done !", "success");
                        location.reload();
                    } else {
                        swal("Error !", data, "error");
                    }
                },
                error: function (data) {
                    swal("Error !", "Something went wrong, Please check console message", "error");
                    console.log(data.responseText);
                }
            });
        });

        $('.btn-disable').click(function () {
            var pluginName = $(this).attr('data-id');
            var userId = "{{$id}}";
            $.ajax({
                type: 'POST',
                url: '{{url('/plugin/active/for/user')}}',
                data: {
                    'pluginName': pluginName,
                    'userId': userId,
                    'action': 'disable'
                },
                success: function (data) {
                    if (data == "success") {
                        swal("Success", "Done !", "success");
                        location.reload();
                    } else {
                        swal("Error !", data, "error");
                    }
                },
                error: function (data) {
                    swal("Error !", "Something went wrong, Please check console message", "error");
                    console.log(data.responseText);
                }
            });
        });
    </script>
@endsection