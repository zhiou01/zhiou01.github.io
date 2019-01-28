@extends('layouts.app')
@section('title','Software Update')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box no-border">
                            <div class="box-header">
                                <b>Software Update</b>
                            </div>
                            <div class="box-body">
                                <div id="update_notification" style="display:none;" class="alert alert-info">
                                    <button type="button" style="margin-left: 20px" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{\App\Http\Controllers\AdminController::softwareUpdateLog(file_get_contents(base_path().'/version.txt'))}}


                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <ul class="timeline">
                            <!-- timeline time label -->
                            <li class="time-label">
                  <span class="bg-green">
                    Updates
                  </span>
                            </li>
                            @foreach(\App\SoftwareUpdateLog::all() as $log)
                                <li>
                                    <i class="fa fa-refresh bg-blue"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i
                                                    class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($log->created_at)->diffForHumans()}}</span>

                                        <h3 class="timeline-header"><a href="#">{{$log->version}}</a></h3>
                                        <div class="timeline-body">
                                            <p>{{$log->created_at}}</p>
                                        </div>


                                    </div>
                                </li>

                            @endforeach

                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
