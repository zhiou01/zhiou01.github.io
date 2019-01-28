@extends('layouts.app')
@section('title','Facebook')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Conversations of {{$data['name']}} </h3>
                    </div>
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Participants</th>
                                <th>Message Counts</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            @if(isset($data['conversations']))
                                @foreach($data['conversations']['data'] as $con)
                                    <tr>
                                        <td>@foreach($con['participants']['data'] as $par)
                                                <a target="_blank"
                                                   href="http://facebook.com/{{$par['id']}}">{{$par['name']}} </a> ,
                                            @endforeach </td>
                                        <td>{{$con['message_count']}}</td>
                                        <td><a class="btn btn-success" target="_blank"
                                               href="{{url('/conversations/')}}/{{$data['id']}}/{{$con['id']}}"><i class="fa fa-comments-o"></i> Start
                                                Conversation</a></td>


                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>Participants</th>
                                <th>Message Counts</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>


            </section>
        </div>
    </div>
@endsection