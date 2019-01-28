@extends('layouts.app')
@section('title','Pinterest Home')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">

                <div class="row">
                    <div class="col-md12">
                        <div class="col-md-6">
                        @foreach($pins as $pin)

                            <!-- Box Comment -->
                                <div class="box box-widget">
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{$pin['pinner']['image_small_url']}}"
                                                 alt="User Image">
                                            <span class="username"><a href="#">{{$pin['pinner']['username']}}</a></span>
                                            <span class="description">Shared publicly - 7:30 PM Today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="box-tools">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                        class="fa fa-times"></i></button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <img width="170" height="302" class="img-responsive pad"
                                             src="{{$pin['images']['170x']['url']}}" alt="Photo">

                                        <p>{!! $pin['description'] !!}</p>

                                    </div>


                                    <!-- /.box -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
