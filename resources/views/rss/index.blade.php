@extends('layouts.app')
@section('title','Rss')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">

                <div class="box no-border">
                    <div class="box-body">
                        <div class="col-md-8"><input id="rssUrl" type="text" class="form-control" placeholder="Enter RSS Url"></div>
                        <div class="col-md-4">
                            <button id="go" class="btn btn-block btn-success"><i class="fa fa-rss"></i> Go</button>
                        </div>
                    </div>
                </div>

                <div id="result">

                </div>

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
<script>
    $('#go').click(function () {
        $('#result').html('Please wait ...');
        $.ajax({
            url:'{{url('/rss/load')}}',
            type:'POST',
            data:{
                'rssUrl':$('#rssUrl').val()
            },
            success:function (data) {
                $('#result').html(data);
            },error:function (data) {
                alert("Something went wrong .Please check console message");
                console.log(data.responseText);
                $('#result').html('');
            }
        })
    })
</script>

@endsection
