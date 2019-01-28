@extends('layouts.app')
@section('title','Admin Dashboard')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content-header">
                <h1><i class="fa fa-home"></i> Admin Dashboard</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{\App\User::all()->count()}}</h3>

                                <p>All Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{\App\Allpost::all()->count()}}</h3>

                                <p>Posts by Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-files-o"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{\App\Notify::all()->count()}}</h3>

                                <p>Total Notifications</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bell-o"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{\App\chatbot::all()->count()}}</h3>

                                <p>Total Bot questions</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-light-blue">
                            <div class="inner">
                                <h3>{{\App\FacebookPages::all()->count()}}</h3>

                                <p>Total Facebook Page</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook-official"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-active">
                            <div class="inner">
                                <h3>{{\App\facebookGroups::all()->count()}}</h3>

                                <p>Total Facebook Group</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook-square"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-active">
                            <div class="inner">
                                <h3>{{\App\Fb::all()->count()}}</h3>

                                <p>Total Facebook Posts</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook-f"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-gradient">
                            <div class="inner">
                                <h3>{{\App\Fbgr::all()->count()}}</h3>

                                <p>Total Facebook Group Post</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3>{{\App\WpSite::all()->count()}}</h3>

                                <p>Wordpress Sites</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-wordpress"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{\App\Tw::all()->count()}}</h3>

                                <p>Total Twitter Post</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-twitter"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h3>{{\App\Tu::all()->count()}}</h3>

                                <p>Total Tumblr Post</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tumblr"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua-gradient">
                            <div class="inner">
                                <h3>{{\App\Fbgr::all()->count()}}</h3>

                                <p>Total Facebook Group Post</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-facebook"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </section>

        </div>

        @include('components.footer')
    </div>
@endsection
