@extends('layouts.app')
@section('title','My Pins')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-red-gradient">
                                    <h3 class="widget-user-username">{{$pins['1']['pinner']['full_name']}}</h3>
                                    <h5 class="widget-user-desc">{{$pins['1']['pinner']['username']}}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" src="{{$pins['1']['pinner']['image_large_url']}}"
                                         alt="User Avatar">
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-6 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$pins['1']['pinner']['board_count']}}</h5>
                                                <span class="description-text">BOARDS</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{$pins['1']['pinner']['follower_count']}}</h5>
                                                <span class="description-text">FOLLOWERS</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->

                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <!-- The time line -->
                                <ul class="timeline">
                                    <!-- timeline time label -->
                                    <li class="time-label">
                  <span class="bg-red">
                  My Pins
                  </span>
                                    </li>
                                    @foreach($pins as $pin)
                                        <li>
                                            <i class="fa fa-pinterest bg-red"></i>

                                            <div class="timeline-item">
                                            <span class="time"><i
                                                        class="fa fa-clock-o"></i> {{$pin['created_at']}}</span>

                                                <h3 class="timeline-header"><a href="#">{{$pin['board']['name']}}</a>
                                                </h3>

                                                <div class="timeline-body">
                                                    @foreach($pin['board']['images']['170x'] as $no => $image)
                                                        <img src="{{$image['url']}}" alt="..." class="margin">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                    <li>

                                        <i class="fa fa-circle-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
