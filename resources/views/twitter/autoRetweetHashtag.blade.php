@extends('layouts.app')
@section('title','Auto Retweet')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    {{-- block 1 start--}}
                    <div class="col-md-12">
                        <div class="col-md-6">

                            <div class="col-md-12">
                                <input id="hashtag" placeholder="Type your #hashtag word without #" type="text"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button id="retweet" class="btn btn-success btn-block"><i class="fa fa-retweet"></i> Retweet Now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row content">
                    <div class="col-md-12">
                        <div id="msg"></div>
                    </div>
                </div>


                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection
@section('js')
    <script>
        $('#retweet').click(function () {
            $('#msg').html('Please wait ....');
            $.ajax({
                type: 'POST',
                url: '{{url('/twitter/retweet/hashtag')}}',
                data: {

                    'hashtag': $('#hashtag').val()
                },
                success: function (data) {
//                    if (data.status == "success") {
//                        $('#msg').html(data.content);
//                    } else {
//                        $('#msg').html(data.content);
//                    }

                    $('#msg').html(data);
                },
                error: function (data) {
                    $('#msg').html('<h4 style="color:red">Something went wrong</h4>');
                }
            })
        })
    </script>

@endsection
