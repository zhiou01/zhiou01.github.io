@extends('layouts.app')
@section('title','Schedule days')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="box no-border">
                        <form action="{{url('/schedule/filter')}}" method="post">


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>From</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control pull-left"
                                                   @if(isset($_POST['from'])) value="{{$_POST['from']}}"
                                                   @endif type="date" name="from">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To</label>

                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control pull-right"
                                                   @if(isset($_POST['to'])) value="{{$_POST['to']}}" @endif type="date"
                                                   name="to">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:5px">
                                    <div class="form-group">
                                        <label></label>

                                        <div class="input-group date">

                                            <button type="submit" class="btn btn-block btn-success"><i
                                                        class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                        <!-- /.input group -->
                                    </div>


                                </div>

                                <div class="col-md-4" style="margin-top:25px">
                                    <div class="btn-group">
                                        <a href="{{url('/schedule/filter/week')}}" class="btn btn-default"><i class="fa fa-calendar"></i> This week</a>
                                        <a href="{{url('/schedule/filter/month')}}" class="btn btn-default"><i class="fa fa-calendar"></i> This month</a>
                                        <a href="{{url('/schedule/filter/all')}}" class="btn btn-default"><i class="fa fa-calendar"></i> All</a>
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>

                </div>
                <div class="row daysbox">
                    <div class="dayBox">
                        <div class="dayHead">
                            Monday
                        </div>

                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Monday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Tuesday
                        </div>
                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Tuesday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Wednesday
                        </div>

                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Wednesday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Thursday
                        </div>

                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Thursday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Friday
                        </div>
                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Friday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBox">
                        <div class="dayHead">
                            Saturday
                        </div>
                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Saturday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="dayBoxLast">
                        <div class="dayHead">
                            Sunday

                        </div>
                        @foreach($data as $da)
                            @if(\Carbon\Carbon::parse($da->time)->format('l') == "Sunday")
                                <div class="row">
                                    <div class="box">
                                        <div class="box-header">
                                                <span class="sTime"><i
                                                            class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($da->time)->toTimeString()}}</span>
                                        </div>
                                        <div class="box-body">

                                            @if($da->image != "")
                                                <img width="100%" src="{{url('/uploads')}}/{{$da->image}}">
                                            @else
                                                <br>
                                            @endif
                                            <h4>
                                                @if($da->fb == "yes")
                                                    <i class="fa fa-facebook-official"></i>
                                                @endif
                                                @if($da->fbg == "yes")
                                                    <i class="fa fa-users"></i>
                                                @endif
                                                @if($da->tw == "yes")
                                                    <i class="fa fa-twitter"></i>
                                                @endif
                                                @if($da->tu == "yes")
                                                    <i class="fa fa-tumblr"></i>
                                                @endif
                                                @if($da->wp == "yes")
                                                    <i class="fa fa-wordpress"></i>
                                                @endif
                                                @if($da->instagram == "yes")
                                                    <i class="fa fa-instagram"></i>

                                                @endif
                                                @if($da->pinterest == "yes")
                                                    <i class="fa fa-pinterest"></i>
                                                @endif

                                                {{$da->title}}</h4>
                                            <p>
                                                {{$da->content}}
                                            </p>
                                            @if($da->published == "yes")
                                                <button type="button" class="btn btn-block btn-xs bg-olive">
                                                    Published
                                                </button>
                                            @else
                                                <button data-id="{{$da->id}}" type="button"
                                                        class="btn btn-block btn-warning btn-xs scheduled">
                                                    <i class="fa fa-edit"></i> Edit Time / Delete
                                                </button>
                                                <div id="{{$da->id}}" style="display:none;" align="center">
                                                    <hr>
                                                    <input type="datetime-local"
                                                           value="{{\Carbon\Carbon::parse($da->time)->format("Y-m-d\TH:i:s")}}"
                                                           class="time_{{$da->id}} form-control" id="time">
                                                    <hr>
                                                    <div class="btn-group">
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn btnSave  btn-success btn-xs"><i
                                                                    class="fa fa-save"></i>
                                                        </button>
                                                        <button class="sDel btn-xs btn bg-red-gradient"
                                                                data-id="{{$da->id}}"><i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-id="{{$da->id}}" type="button"
                                                                class="btn  btn-danger btn-xs"><i
                                                                    class="fa fa-times"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


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
            margin: 0px !important;
            padding: 0px !important;
        }

        .dayBox {
            position: relative;
            width: 100%;

            padding: 5px;
            min-height: 500px;
            border-right: 2px dashed darkgray;
        }

        .dayBoxLast {
            position: relative;
            width: 100%;

            padding: 5px;

            min-height: 500px;

        }

        .daysbox {
            display: flex;
            margin: 5px;
            justify-content: space-between;
            background-color: gainsboro;
            border-radius: 3px;

        }

        .dayHead {
            /*position: absolute;*/
            /*top:0px;*/
            border-bottom: 2px dashed darkgray;
            text-align: center;
            font-weight: bolder;
        }

        .sContainer {
            position: relative;
            background-color: white;
            padding: 5px;
            margin: 5px;
            border-radius: 5px;
            box-shadow: 0px 14px 18px 0px rgba(75, 77, 81, 0.14);
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .sContainer img {
            width: 100%;
        }

        .sTime {
            background-image: -moz-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -webkit-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -ms-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            box-shadow: 0px 14px 18px 0px rgba(234, 54, 104, 0.14);
            border-radius: 5px;
            padding: 2px 5px;
            font-weight: bolder;
            color: white;
            position: absolute;
            z-index: 14;

        }

        .Rounded_Rectangle_3 {
            background-image: -moz-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -webkit-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            background-image: -ms-linear-gradient(0deg, rgb(234, 54, 104) 0%, rgb(233, 96, 79) 100%);
            box-shadow: 0px 14px 18px 0px rgba(234, 54, 104, 0.14);
            position: absolute;
            left: 612px;
            top: 215px;
            width: 166px;
            height: 51px;
            z-index: 10;
        }

        .colorFb {
            border-bottom: 3px solid #4267B2;
        }

        .colorTw {
            border-bottom: 3px solid #1DA1F2;
        }

    </style>
@endsection

@section('js')
    <script>
        var s = $("#time").val();
        var startDate = new Date(s.replace(/-/g,'/').replace('T',' '));


        flatpickr(".tt", {
            minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
            maxDate: "2017-12-20",
            enableTime: true,
            wrap: true,
            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y h:i K",
            time_24hr: false
        });
        $('.scheduled').click(function () {
            var id = $(this).attr('data-id');
            $('#' + id).toggle(200);
        });

        $('.btn-danger').click(function () {
            var id = $(this).attr('data-id');
            $('#' + id).toggle(200);
        });

        $('.btnSave').click(function () {
            var id = $(this).attr('data-id');
            var sTime = $('.time_'+id).val();
//            return alert("ID" + id + " and time " +sTime);
            $.ajax({
                url: '{{url('/schedule/time/update')}}',
                type: 'POST',
                data: {
                    'id': id,
                    'time': sTime
                },
                success: function (data) {
                    if (data == 'success') {
                        swal("Success", 'Time updated', 'success');
                    } else {
                        swal('Error!', data, 'error');
                    }
                },
                error: function (data) {
                    swal("Error", "Something went wrong check the console message", 'error');
                    console.log(data.responseText);

                }
            });
        })

    </script>
@endsection