@extends('layouts.app')
@section('title','Capture')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <div align="center" class="row">

                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Capture All
                                        Feed</a></li>
                                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Capture Custom
                                        Feed</a></li>

                                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Captured Feed</a></li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input id="pageLink" placeholder="Page Link or ID"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <button id="captureAll" class="btn btn-block btn-primary"><i
                                                        class="fa fa-database"></i>
                                                <b>Capture</b></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <input id="pageLinkCustom" placeholder="Page Link or ID"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" placeholder="Select date"
                                                   id="time">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" value="10" class="form-control" placeholder="Feed Limit"
                                                   id="limit">
                                        </div>
                                        <div class="col-md-2">
                                            <button id="captureCustom" class="btn btn-block btn-primary"><i
                                                        class="fa fa-database"></i>
                                                <b>Capture</b></button>
                                        </div>


                                    </div>
                                </div>

                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="tab_3">


                                        <table id="mytable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Page Name</th>
                                                <th>Content</th>
                                                <th>Date</th>
                                                <th>Share</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach(\App\Capture::where('userId',Auth::user()->id)->get() as $d)
                                                <tr>
                                                    <td>{{$d->pageName}}</td>
                                                    <td>{{$d->content}}</td>
                                                    <td>{{\Carbon\Carbon::parse($d->date)->format('Y-m-d')}}</td>
                                                    <td>
                                                        <div class="pull-left">



                                                            <a target="_top"
                                                               onclick="window.open('https://plus.google.com/share?url={{$d->link}}', 'newwindow', 'width=500, height=300'); return false;"
                                                               href="https://plus.google.com/share?url={{$d->link}}"
                                                               class='btn-box-tool'><i
                                                                        class='fa fa-google-plus'></i></a>
                                                            <a target="_top"
                                                               onclick="window.open('https://www.linkedin.com/cws/share?url={{$d->link}}', 'newwindow', 'width=500, height=300'); return false;"
                                                               href="https://www.linkedin.com/cws/share?url={{$d->link}}"
                                                               class='btn-box-tool'><i
                                                                        class='fa fa-linkedin'></i></a>
                                                            <a target="_top"
                                                               onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{$d->link}}', 'newwindow', 'width=500, height=300'); return false;"
                                                               href="https://www.facebook.com/sharer/sharer.php?u={{$d->link}}"
                                                               class='btn-box-tool'><i
                                                                        class='fa fa-facebook'></i></a>
                                                            <a target="_top"
                                                               onclick="window.open('http://www.reddit.com/submit?url={{$d->link}}', 'newwindow', 'width=500, height=300'); return false;"
                                                               href="http://www.reddit.com/submit?url={{$d->link}}"
                                                               class='btn-box-tool'><i
                                                                        class='fa fa-reddit'></i></a>

                                                        </div>

                                                    </td>
                                                    <td><button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </button> </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>Page Name</th>
                                                <th>Content</th>
                                                <th>Date</th>
                                                <th>Share</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>


                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <p id="progressMsg"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress progress-sm active">
                            <div id="progressbar" class="progress-bar progress-bar-success progress-bar-striped"
                                 role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span class="sr-only">20% Complete</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="showFeeds">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script>
        flatpickr("#time", {


            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y",

        });
        $('#captureAll').click(function () {
            if ($('#pageLink').val() == "") {
                return alert("Please type Page URL or ID");
            }
            $('#progressMsg').html('');
            $('#showFeeds').html('');
            $('#progressbar').css('width', '0%');
            $('#progressMsg').html('Please wait .....');
            $('#progressbar').css('width', '25%');

            $.ajax({
                type: 'POST',
                url: '{{url('/capture/get/info')}}',
                data: {
                    'pageLink': $('#pageLink').val()
                },
                success: function (data) {
                    if (data.pageId == undefined) {
                        $('#progressbar').css('width', '0%');
                        return $('#progressMsg').html("Sorry ! Couldn't find the page");
                    }
                    $('#progressMsg').html('Found Page, Now trying to capture feeds');
                    $('#progressbar').css('width', '50%');
//                    get feed
                    $.ajax({
                        type: 'POST',
                        url: '{{url('/capture/get/feed')}}',
                        data: {
                            'pageId': data.pageId,
                            'pageName':data.pageName
                        },
                        success: function (feed) {
                            $('#showFeeds').html(feed);
                            $('#progressbar').css('width', '100%');
                            $('#progressMsg').html('Done !');

                        },
                        error: function (data) {

                            $('#progressbar').css('width', '0%');
                            $('#progressMsg').html('Error');
                            console.log(data.responseText);
                        }
                    });
                    console.log(data);
                    console.log("The page id is:" + data.pageName);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });


        $('#captureCustom').click(function () {
            if ($('#pageLinkCustom').val() == "") {
                return alert("Please type Page URL or ID");
            }
            $('#progressMsg').html('');
            $('#showFeeds').html('');
            $('#progressbar').css('width', '0%');
            $('#progressMsg').html('Please wait .....');
            $('#progressbar').css('width', '25%');

            $.ajax({
                type: 'POST',
                url: '{{url('/capture/get/info')}}',
                data: {
                    'pageLink': $('#pageLinkCustom').val()
                },
                success: function (data) {
                    if (data.pageId == undefined) {
                        $('#progressbar').css('width', '0%');
                        return $('#progressMsg').html("Sorry ! Couldn't find the page");
                    }
                    $('#progressMsg').html('Found Page, Now trying to capture feeds');
                    $('#progressbar').css('width', '50%');
//                    get feed
                    $.ajax({
                        type: 'POST',
                        url: '{{url('/capture/get/feed/custom')}}',
                        data: {
                            'pageId': data.pageId,
                            'pageName':data.pageName,
                            'date': $('#time').val(),
                            'limit': $('#limit').val()
                        },
                        success: function (feed) {
                            $('#showFeeds').html(feed);
                            $('#progressbar').css('width', '100%');
                            $('#progressMsg').html('Done !');

                        },
                        error: function (data) {

                            $('#progressbar').css('width', '0%');
                            $('#progressMsg').html('Error');
                            console.log(data.responseText);
                        }
                    });
                    console.log(data);
                    console.log("The page id is:" + data.pageName);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });

        $('#btnSearch').click(function () {
            alert($('#time').val());
        })
    </script>
@endsection