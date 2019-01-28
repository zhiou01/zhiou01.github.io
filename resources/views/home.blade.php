@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1>{{trans('dashboard.Dashboard')}}</h1>
            </section>

            <section data-step="1" data-intro="You will see summary of your sites and posts" class="content">
                <div class="row">
                    {{--Facebook --}}
                    @if(\App\Http\Controllers\Data::myPackage('fb'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-facebook"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{trans('dashboard.page likes')}}</span>
                                    <span id="dFbLikes" class="info-box-number">{{trans('dashboard.Loading')}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif

                    {{-- Tumblr --}}
                    @if(\App\Http\Controllers\Data::myPackage('tu'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-purple"><i class="fa fa-tumblr"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{trans('dashboard.followers')}}</span>
                                    <span id="dTuFollowers"
                                          class="info-box-number">{{trans('dashboard.Loading')}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                    {{-- Twitter --}}

                    @if(\App\Http\Controllers\Data::myPackage('tw'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-light-blue"><i class="fa fa-twitter"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{trans('dashboard.followers')}}</span>
                                    <span id="dTwFollowers"
                                          class="info-box-number">{{trans('dashboard.Loading')}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                    {{-- Linked --}}
                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-light-blue-active"><i class="fa fa-linkedin"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{trans('dashboard.company followers')}}</span>
                                    <span id="companyFollowers"
                                          class="info-box-number">{{trans('dashboard.followers')}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    @endif
                </div>

                {{-- show how many page or groups exists--}}

                <div class="row">


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-fuchsia">
                            <div class="inner">
                                <h3>{{$logs}}</h3>

                                <p>{{trans('dashboard.Total Logs')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bell"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>{{$tuBlogs}}</h3>

                                <p>{{trans('dashboard.Tumblr')}} {{trans('dashboard.Blogs')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tumblr"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{$fbPages}}</h3>

                                <p>{{trans('dashboard.Facebook')}}{{trans('dashboard.Pages')}} </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3>{{$fbGroups}}</h3>

                                <p>{{trans('dashboard.Facebook')}} {{trans('dashboard.Groups')}} </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    {{-- Linkedin--}}
                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-light-blue-active">
                                <div class="inner">
                                    <h3 id="liPostedJobs">0</h3>

                                    <p>{{trans('dashboard.Posted Jobs')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-maroon">
                                <div class="inner">
                                    <h3 id="liCompanyUpdates">0</h3>

                                    <p>{{trans('dashboard.Company Updates')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-linkedin"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->
                    @endif
                    {{--instagram followers--}}
                    @if(\App\Http\Controllers\Data::myPackage('in'))

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray-active">
                                <div class="inner">
                                    <h3 id="inFollowers">{{trans('dashboard.Loading')}}</h3>

                                    <p>Instagram Followers</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-instagram"></i>
                                </div>

                            </div>
                        </div>
                        <!-- ./col -->
                        {{-- instagram following --}}
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray-light">
                                <div class="inner">
                                    <h3 id="inFollosing">{{trans('dashboard.Loading')}}</h3>

                                    <p>{{trans('dashboard.Instagram')}} {{trans('dashboard.Fllowing')}} </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-instagram"></i>
                                </div>

                            </div>
                        </div>
                @endif
                <!-- ./col -->

                </div>

                {{-- show how many posts you have--}}

            </section>
        </div>

        @include('components.footer')
    </div>
@endsection
@section('js')

@endsection