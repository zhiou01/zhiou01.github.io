@extends('layouts.app')
@section('title','Website Integration')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')
        <div class="content-wrapper">
            <section class="content">

                <h1 align="center">Integrate Facebook Messenger on Your Website</h1>
    @foreach($datas as $data)
        <div class="row">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray-light">
                        <div class="widget-user-image">
                            <img class="img-circle" src="https://graph.facebook.com/v2.11/{{$data->pageId}}/picture"
                                 alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{$data->pageName}}</h3>


                        <h5 class="widget-user-desc">
                            <kbd>HTML Code</kbd><br><br>
                            <pre>
                            &lt;div class="fb-customerchat"
                                 page_id="{{$data->pageId}}"

                                 minimized="true">
                            &lt;/div&gt;
                           </pre>
                        </h5>

                        <h5 class="widget-user-desc">
                            <kbd>JavaScript Code</kbd><br><br>
                            <pre>
                                &lt;script&gt;
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
                                &lt;/script&gt;
                                    </pre>


                        </h5>
                        <hr>

                        <h5 class="widget-user-desc">
                            <a target="_blank" href="{{url('/extend').'/'.$data->pageId}}"
                               class="btn btn-block btn-success">Preview</a>
                        </h5>
                    </div>

                </div>
            </div>

        </div>
    @endforeach
            </section>
        </div>
@endsection
