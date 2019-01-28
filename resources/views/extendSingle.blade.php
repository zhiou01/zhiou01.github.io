@extends('layouts.app')
@section('title','Website Integration')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div class="content-wrapper">
            <section class="content">

                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                        <h3 class="widget-user-username">{{\App\FacebookPages::where('pageId',$pageId)->value('pageName')}}</h3>

                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="https://graph.facebook.com/{{$pageId}}/picture" alt="User Avatar">
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 class="description-header">Chat widget
                                        for {{\App\FacebookPages::where('pageId',$pageId)->value('pageName')}}</h5>
                                    <span class="description-text">See the left bottom side of this page. The widget will show like this</span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                            <!-- /.row -->
                        </div>

                    </div>
                    <div class="fb-customerchat"
                         page_id="{{$pageId}}"

                         minimized="true">
                    </div>

                    <script>
                        window.fbAsyncInit = function () {
                            FB.init({
                                appId: '{{\App\Http\Controllers\Data::get('fbAppId')}}',
                                autoLogAppEvents: true,
                                xfbml: true,
                                version: 'v2.11'
                            });
                        };

                        (function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) {
                                return;
                            }
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "https://connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>
@endsection