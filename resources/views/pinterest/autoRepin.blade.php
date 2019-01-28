@extends('layouts.app')
@section('title','Auto Repin')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p><b>Search For</b></p>
                            <input placeholder="Food,Cat..." type="text" class="form-control" id="search"><br>
                            <p><b>Select Board</b></p>
                            <select id="board" class="form-control">
                                @foreach($boards as $board)
                                    <option value="{{$board['id']}}">{{$board['name']}}</option>
                                @endforeach
                            </select>
                            <br>
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-default"
                            >Create New Board
                            </button>

                            <br>
                            <br>
                            <button id="comment" class="btn btn-block btn-success"><i class="fa fa-map-pin"></i> Run
                                Auto Repin
                            </button>
                            <br>
                            <p id="msg"></p>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Default Modal</h4>
                            </div>
                            <div class="modal-body">
                                <label>Board Name</label>
                                <input type="text" class="form-control" id="board_name">
                                <label>Description</label>
                                <input type="text" class="form-control" id="board_description">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close
                                </button>
                                <button id="create_board" type="button" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> Create Board
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')

    <script>
        $("#comment").click(function () {
            $('#msg').html("Please wait .It will take time ....");
            $.ajax({
                url: '{{url('pinterest/auto/repin')}}',
                type: 'POST',
                data: {
                    'boardId': $('#board').val(),
                    'search': $('#search').val()
                },
                success: function (data) {
                    $('#msg').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });

        $('#create_board').click(function () {
            var boardName = $("#board_name").val();
            var boardDescription = $('#board_description').val();
            $.ajax({
                type: 'POST',
                url: '{{url('/pinterest/create/board')}}',
                data: {
                    'boardName': boardName,
                    'boardDescription': boardDescription
                },
                success: function (data) {
                    if (data == "success") {
                        alert("Created !");
                        location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            });
        })
    </script>

@endsection
