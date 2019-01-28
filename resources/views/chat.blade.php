@extends('layouts.app')
@section('title','Facebook')
@section('content')
    <div class="wrapper" xmlns="http://www.w3.org/1999/html">
        @include('components.navigation')
        @include('components.sidebar')
        <div id="chat"></div>
        <div class="content-wrapper">
            <section class="content">
                <div class="col-md-6">
                    <!-- DIRECT CHAT -->
                    <div class="box box-success direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Direct Chat</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="{{$response['message_count']}} Messages"
                                      class="badge bg-red-gradient">{{$response['message_count']}}</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>

                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div id="chatBox" class="direct-chat-messages">
                                <!-- Message. Default to the left -->
                                @foreach(array_reverse($response['messages']['data']) as $data)
                                    <div class="direct-chat-msg @if($data['from']['id'] == $me)right @endif">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-@if($data['from']['id'] == $me)right @else left @endif">{{$data['from']['name']}}</span>
                                            <span class="direct-chat-timestamp pull-@if($data['from']['id'] == $me)left @else right @endif">{{\App\Http\Controllers\Prappo::date($data['created_time'])}}</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        @foreach($response['participants']['data'] as $par)



                                        @endforeach
                                        {{--<img class="direct-chat-img" src="{{$img}}"--}}
                                        {{--alt="message user image"><!-- /.direct-chat-img -->--}}
                                        <div class="direct-chat-text">
                                            {{$data['message']}}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @endforeach

                            </div>
                            <!--/.direct-chat-messages-->

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            <div class="input-group">
                                <input type="text" id="message" name="message" placeholder="Type Message ..."
                                       class="form-control">
                                <span class="input-group-btn">
                            <button type="button" id="send" class="btn btn-success btn-flat">Send</button>
                          </span>
                            </div>

                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>

            </section>
        </div>

    </div>

@endsection

@section('js')
    <script>
        var chatbox = $('#chatBox');
        chatbox.scrollTop(chatbox[0].scrollHeight);

        if (document.getElementById('chat')) {
            var chatbox = $('#chatBox');
            $('#send').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/chat')}}',
                    data: {
                        'pageId': '{{$me}}',
                        'conId': '{{$response['id']}}',
                        'message': $('#message').val()
                    },
                    success: function (data) {
                        $('#msg').html(data);
                    }
                });
                $('#message').val('');
                auto_load();
                chatbox.scrollTop(chatbox[0].scrollHeight);
            });

            $('#message').bind("enterKey", function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/chat')}}',
                    data: {
                        'pageId': '{{$me}}',
                        'conId': '{{$response['id']}}',
                        'message': $('#message').val()
                    },
                    success: function (data) {
                        $('#msg').html(data);
                    }
                });
                $('#message').val('');
                auto_load();
                chatbox.scrollTop(chatbox[0].scrollHeight);
            });
            $('#message').keyup(function (e) {
                if (e.keyCode == 13) {
                    $(this).trigger("enterKey");
                }
            });
            function auto_load() {

                $.ajax({
                    type: "GET",
                    url: '{{url('/ajaxchat/')}}/{{$me}}/{{$response['id']}}',
                    success: function (data) {
                        $('#chatBox').html(data);

                    }

                });

            }

            setInterval(auto_load, 2000);

        }

    </script>
@endsection