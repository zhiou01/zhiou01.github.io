@extends('layouts.app')
@section('title','Web To Social')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">

                <div class="box no-border">
                    <div class="box-body">
                        <div class="col-md-8"><input id="url" type="text" class="form-control" placeholder="Enter Url">
                        </div>
                        <div class="col-md-2">
                            <select id="type" class="form-control">
                                <option value="image">image</option>
                                <option value="paragraph">paragraph</option>
                                <option value="other">other</option>
                            </select>
                            <div style="padding:5px;display: none" class="bg-gray-light"  id="elementSection">
                                <br>
                                <p>Enter Element name or class name</p>
                                <input type="text" id="element">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button id="go" class="btn btn-block btn-success"><i class="fa fa-globe"></i> Go</button>
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
        $('#type').on('change',function () {
           if($(this).val() == 'other'){
               $('#elementSection').show();
           }else{
               $('#elementSection').hide();
           }
        });
        $('#go').click(function () {
            $('#result').html('Please wait ...');
            $.ajax({
                url: '{{url('/web/load')}}',
                type: 'POST',

                data: {
                    'link': $('#url').val(),
                    'type': $('#type').val(),
                    'element':$('#element').val()
                },
                success: function (data) {
                    $('#result').html(data);
                }, error: function (data) {
                    alert("Something went wrong .Please check console message");
                    console.log(data.responseText);
                    $('#result').html('');
                }
            })
        })
    </script>

@endsection
