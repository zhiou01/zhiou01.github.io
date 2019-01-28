@extends('layouts.app')
@section('title','Facebook Pages')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="row">

                    <div class="col-md-12">
                        <!-- Custom Tabs (Pulled to the right) -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1-1" data-toggle="tab"><h5><i style="color: green"
                                                                                               class="fa fa-plus-circle"></i> Create
                                            New Campaign</h5></a></li>
                                <li><a href="#tab_2-2" data-toggle="tab"><h5><i style="color: orangered"
                                                                                class="fa fa-plus-circle"></i> Create Custom
                                            Campaign</h5></a></li>
                                {{--<li><a href="#tab_3-2" data-toggle="tab"><h5><i class="fa fa-facebook-square"--}}
                                                                                {{--style="color:#4A67AD"></i> All--}}
                                            {{--campaigns of <b>{{\App\FacebookPages::where('pageId',$pageId)->value('pageName')}}</b>--}}
                                        {{--</h5></a></li>--}}


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1-1">
                                    <div class="row">
                                        <div class="col-md-6">


                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><b><i class="fa fa-rocket"></i> Instant Campaign</b></h3>
                                                </div>

                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inCampaignName">Name</label>
                                                        <input type="text" class="form-control" id="inCampaignName"
                                                               placeholder="Enter campaign Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Content</label>
                                                        <textarea id="inCampContent" class="form-control" rows="3"
                                                                  placeholder="Enter Content ..."></textarea>
                                                        <h4 id="inMsg"></h4>
                                                    </div>


                                                </div>


                                                <div class="box-footer">
                                                    <button id="btnSubmitCampaign" class="btn btn-success btn-block"><i
                                                                class="fa fa-send"></i> Submit
                                                        Campaign
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="box box-warning">--}}
                                                {{--<div class="box-header with-border">--}}
                                                    {{--<h3 class="box-title"><b><i class="fa fa-calendar"></i> Schedule Campaign</b>--}}
                                                    {{--</h3>--}}
                                                {{--</div>--}}

                                                {{--<div class="box-body">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="sCampaignName">Name</label>--}}
                                                        {{--<input type="text" class="form-control" id="sCampaignName"--}}
                                                               {{--placeholder="Enter campaign Name">--}}

                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Content</label>--}}
                                                        {{--<textarea id="sCampContent" class="form-control" rows="3"--}}
                                                                  {{--placeholder="Enter Content ..."></textarea>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>Select time and date</label>--}}
                                                        {{--<input placeholder="Select ..." type="text" id="time">--}}
                                                    {{--</div>--}}
                                                    {{--<h4 id="sMsg"></h4>--}}


                                                {{--</div>--}}


                                                {{--<div class="box-footer">--}}
                                                    {{--<button id="btnSsubmitCampaign" class="btn btn-warning btn-block"><i--}}
                                                                {{--class="fa fa-send"></i> Submit--}}
                                                        {{--Campaign--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <button id="btnCcreateNew" class="btn btn-block btn-success"><i class="fa fa-plus"></i>
                                                Create New Custom
                                                Campaign
                                            </button>
                                            <br><br>
                                            <div style="display: none" id="sectionC1" class="row">
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           id="txtCcampaignName"
                                                           placeholder="Enter campaign Name">
                                                    <input type="hidden" id="cCampaignName">
                                                    <input type="hidden" id="cCampId">
                                                </div>
                                                <div class="col-md-4">
                                                    <button id="btnCcreate" class="btn btn-default btn-block">Create</button>
                                                </div>
                                            </div>
                                            <br>

                                            <div style="display:none" id="senderList">
                                                <table id="mytable1" class="table table-striped table-bordered" cellspacing="0"
                                                       width="100%">
                                                    <thead>
                                                    <tr>


                                                        <th>Name</th>
                                                        <th>Action</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach(\App\CampSenders::where('pageId',$pageId)->get() as $a)
                                                        <tr>
                                                            <td>{{$a->name}} </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a target="_blank" class="btn btn-xs btn-primary"
                                                                       href="https://facebook.com/{{$a->senderId}}"><i
                                                                                class="fa fa-user"></i> Profile <i
                                                                                class="fa fa-external-link"></i> </a>
                                                                    <button data-id="{{$a->id}}"
                                                                            class="btn btnAdd btn-xs btn-success">Add
                                                                        <i
                                                                                class="fa fa-arrow-right"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="col-md-4">

                                            <div class="box-body">
                                                <h4 id="lblCampName"></h4>
                                                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                                                <ul id="ssList" class="todo-list ui-sortable">


                                                </ul>
                                                <br>
                                                <div style="display: none" id="sCdiv">
                                                    <button id="btnDone" class="btn btn-success">Submit now</button>
                                                    {{--<button id="btnScSubmit" class="btn btn-warning">Schedule</button>--}}
                                                </div>
                                                <br>
                                                <div style="display: none;" id="cTxtDiv">


                                                    <div class="form-group">
                                                        <label>Content</label>
                                                        <textarea id="iCcampContent" class="form-control" rows="3"
                                                                  placeholder="Enter Content ..."></textarea>
                                                    </div>
                                                    <div id="btnIcCamp" class="btn btn-block btn-primary">Submit now</div>

                                                    <h4 id="dMsg"></h4>

                                                </div>
                                                <br>
                                                <div style="display: none" id="aaa">
                                                    <div class="form-group">
                                                        <label>Content</label>
                                                        <textarea id="iCsCampContent" class="form-control" rows="3"
                                                                  placeholder="Enter Content ..."></textarea>
                                                    </div>


                                                    <input type="text" value="Select date and time ..." id="txtScCampaign"><br>

                                                    <h4 id="eMsg"></h4>
                                                    <button class="btn btn-block btn-default">Submit for Schedule</button>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3-2">
                                    {{-- Logs will be here--}}
                                    <table id="mytable2" class="table table-striped table-bordered" cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>


                                            <th>Campaign Name</th>
                                            <th>Date and Time</th>
                                            <th>Action</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach(\App\campaignLog::where('pageId',$pageId)->get() as $a)
                                            <tr>
                                                <td> {{$a->campName}} </td>
                                                <td>{{$a->created_at}} (
                                                    <b>{{\Carbon\Carbon::parse($a->created_at)->diffForHumans()}} </b>)
                                                </td>
                                                <td>
                                                    <div class="btn-group">

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">All Message Senders list</div>

                    <div class="panel-body">

                        <table id="mytable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>


                                <th>Name Name</th>
                                <th>Last Conversation Message</th>
                                <th>Can Reply</th>
                                <th>Total Message</th>
                                <th>Unread Message</th>
                                <th>Time</th>
                                <th>Action</th>


                            </tr>
                            </thead>
                            <tbody>

                            @foreach($datas as $data)

                                @foreach($data as $d)
                                    @if (isset($d['senders']))

                                        <tr>

                                            <td>{{$d['senders']['data'][0]['name']}} </td>
                                            <td>@if(isset($d['snippet'])) <kbd>{{$d['snippet']}}</kbd> @endif</td>
                                            <td>@if($d['can_reply']) <b style="color:green">Yes</b> @else <b
                                                        style="color: red">No</b> @endif</td>
                                            <td><span class="label bg-green">{{$d['message_count']}}</span></td>
                                            <td><span class="label bg-red">{{$d['unread_count']}}</span></td>
                                            <td style="color:blue">{{\Carbon\Carbon::parse($d['updated_time'])->diffForHumans()}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a target="_blank" class="btn btn-success btn-xs"
                                                       href="https://facebook.com{{$d['link']}}"><i
                                                                class="fa fa-external-link"></i></a>
                                                    <a data-id="{{$d['id']}}" class="btn individualMsg btn-primary btn-xs"><i
                                                                class="fa fa-comment"></i>
                                                    </a>
                                                    <a target="_blank"
                                                       href="https://facebook.com/{{$d['senders']['data'][0]['id']}}"
                                                       class="btn btn-warning btn-xs"><i class="fa fa-user"></i> </a>
                                                </div>
                                            </td>

                                        </tr>

                                    @endif

                                @endforeach
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>






            </section>

        </div>
    </div>
@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#time", {
            minDate: new Date(), // "today" / "2016-12-20" / 1477673788975

            enableTime: true,

            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y h:i K",

            time_24hr: true

        });

        flatpickr("#txtScCampaign", {
            minDate: new Date(), // "today" / "2016-12-20" / 1477673788975

            enableTime: true,

            // create an extra input solely for display purposes
            altInput: true,
            altFormat: "F j, Y h:i K",

            time_24hr: true

        });

        $('#btnCreate').click(function () {
            $('#campaignBox').toggle(200);

        });

        $('#btnSchedule').click(function () {
            $('#picker').toggle(200);
        });

        $('#btnCcreateNew').click(function () {
            $('#sectionC1').show(200);
        });
        $('#btnCcreate').click(function () {
            if ($('#txtCcampaignName').val() == "") {
                alert("Please enter Campaign Name");
            } else {
                if ($('#cCampaignName').val() != $('#txtCcampaignName').val()) {
                    $('ssList').html('');
                    var randNumber = Math.floor((Math.random() * 9999) + 1000);
                    $('#cCampaignName').val($('#txtCcampaignName').val());
                    $('#cCampId').val(randNumber);
                    $('#lblCampName').html($('#txtCcampaignName').val());
                    $('#senderList').show(200);

                    $.ajax({
                        type: 'POST',
                        url: '{{url('/campaign/add')}}',
                        data: {
                            'campId': campId,
                            'name': $('#cCampaignName').val()
                        },
                        success: function (data) {

                        },
                        error: function (data) {
                            alert("Something went wrong");
                            console.log(data.responseText);
                        }
                    });
                }

            }
        });

        function updateCcampaignList(campId) {
            $.ajax({
                type: 'POST',
                url: '{{url('/campaign/list/update')}}',
                data: {
                    'campId': campId
                },
                success: function (data) {
                    $('#ssList').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        }
        $('.btnAdd').click(function () {
            var id = $(this).attr('data-id');
            var campId = $('#cCampId').val();
            if (campId == "") {

                console.log("CampId required");
                return alert("Something went wrong");
            }
            $.ajax({
                type: 'POST',
                url: '{{url('/campaign/add/to/custom/campaign')}}',
                data: {
                    'id': id,
                    'campId': campId
                },
                success: function (data) {
                    if (data == "success") {
                        updateCcampaignList(campId);
                        $('#sCdiv').show();

                    } else {
                        alert(data);
                    }

                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });


        });

        $('#btnScSubmit').click(function () {
            $('#aaa').show(200);
            $('#cTxtDiv').hide(200);

        });

        $('#btnSubmitCampaign').click(function () {
            $('#inMsg').html("Please wait..");
            var campName = $('#inCampaignName').val();
            var campId = Math.floor((Math.random() * 9999) + 1000);
            var content = $('#inCampContent').val();
            var pageId = "{{$pageId}}";
            $.ajax({
                type: 'POST',
                url: '{{url('/campaign/submit/instant')}}',
                data: {
                    'campName': campName,
                    'message': content,
                    'pageId': pageId,
                    'campId': campId
                },
                success: function (data) {
                    $('#inMsg').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });

        {{--$('#btnSsubmitCampaign').click(function () {--}}
            {{--$('#sMsg').html("Please wait...");--}}
            {{--var camName = $('#sCampaignName').val();--}}
            {{--var content = $('#sCampContent').val();--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: '{{url('/campaign/submit/schedule')}}',--}}
                {{--data: {--}}
                    {{--'campName': camName,--}}
                    {{--'content': content,--}}
                    {{--'time': $("#time").val()--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('#sMsg').html(data);--}}
                {{--}, error: function (data) {--}}
                    {{--alert("Something went wrong");--}}
                    {{--console.log(data.responseText);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        $('#btnDone').click(function () {
            $('#cTxtDiv').show(200);
            $('#aaa').hide(200);
        })

        $('#btnIcCamp').click(function () {
            $('#dMsg').html("Please wait..");
            var campName = $('#cCampaignName').val();
            var campId = $('#cCampId').val();
            var content = $('#iCcampContent').val();
            var pageId = "{{$pageId}}";
            $.ajax({
                type: 'POST',
                url: '{{url('/campaign/submit/custom/instant')}}',
                data: {
                    'campName': campName,
                    'message': content,
                    'pageId': pageId,
                    'campId': campId
                },
                success: function (data) {
                    $('#dMsg').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        });

        $('.individualMsg').click(function () {
            var id = $(this).attr('data-id');
            swal({
                title: "Messaging!",
                text: "Enter your message here",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Write something",
                showLoaderOnConfirm: true,
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                $.ajax({
                    type: 'POST',
                    url: '{{url('/campaign/send/message/single')}}',
                    data: {
                        'conId': id,
                        'pageId': "{{$pageId}}",
                        'message': inputValue
                    },
                    success: function (data) {
                        if (data == "success") {
                            swal("Success", "Successfully sent message", "success");
                        } else {
                            swal("Error", data, "error");
                        }
                    },
                    error: function (data) {
                        alert("Something went wrong");
                        console.log(data.responseText);
                    }
                });
            });
        });

        $('#btnSsubmitCampaign').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/campaign/schedule/all')}}',
                data: {
                    'campName':$('#sCampaignName').val(),
                    'campId': Math.floor((Math.random() * 9999) + 1000),
                    'data': $('#sCampContent').val(),
                    'time':$('#time').val(),
                    'pageId':'{{$pageId}}'
                },
                success:function (data) {
                    if(data == "success"){
                        alert("Campaign scheduled successfully");
                    }else{
                        alert(data);
                    }
                },error:function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        })
    </script>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
