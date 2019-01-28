@extends('layouts.app')
@section('title','Reddit Search')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div id="settingspage"></div>

        <div class="content-wrapper">
            <section class="content">

                {{-- block 1 start--}}
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-8"><input id="keyword" placeholder="Type Keyword to search ..." type="text"
                                                     class="form-control"></div>
                        <div class="col-md-4">
                            <button id="search" class="btn btn-success btn-block">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </div>

                    <div id="result" class="box box-body">
                    <p>No results</p>
                    </div>


                {{-- block 1 end--}}

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')
    <script>
        $('#search').click(function () {
            $.ajax({
                url: '{{url('/reddit/search')}}',
                type: 'POST',
                data: {
                    'keyword': $('#keyword').val()
                },
                success: function (data) {
                    $('#result').html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        })
    </script>
@endsection
