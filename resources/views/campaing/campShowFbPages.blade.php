@extends('layouts.app')
@section('title','Facebook Pages')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="panel panel-success">
                    <div class="panel-heading">Select a page
                    </div>
                    <div class="panel-body">
                        <div class="list-group">

                            @foreach($datas as $page)
                                <li class="list-group-item"><a target="_blank"
                                                               href="{{url('/campaign/page')}}/{{$page->pageId}}"><i class="fa fa-facebook-square"></i> {{$page->pageName}}</a>

                                </li>
                            @endforeach


                        </div>

                    </div>
                </div>

            </section>

        </div>
    </div>
@endsection
