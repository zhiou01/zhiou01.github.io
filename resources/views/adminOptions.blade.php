@extends('layouts.app')
@section('title','Admin Options | SocialLit')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="bor no-border">
                        <div class="box-body">
                            <div id="update_notification" style="display:none;" class="alert alert-info">
                                <button type="button" style="margin-left: 20px" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box no-border">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-clock-o"></i> Schedule settings ( Cron Job )</h3>
                        </div>

                        <div class="box-body">
                            <h4>Add this command to crontab ( Recommended )</h4>
                            <div class="well">
                                <code>
                                    * * * * * php {{base_path('artisan schedule:run >> /dev/null 2>&1')}}
                                </code>
                            </div>
                            <h4>If above command doesn't work for your server then add this</h4>

                            <div class="well">
                                <code>
                                    * * * * * curl {{url('/schedule/fire')}}
                                </code>
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
    <style>
        .row {
            margin: 5px;
        }
    </style>
@endsection
