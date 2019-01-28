@extends('layouts.app')
@section('title','Facebook Pages and Group Monitor')
@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Your Facebook Group To monitor</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="groupId" class="col-sm-2 control-label">Groups</label>

                                        <div class="col-sm-10">
                                            <select id="groupId" class="form-control">
                                                @foreach($groups as $group)
                                                    <option id="{{$group->pageId}}"
                                                            value="{{$group->pageName}}">{{$group->pageName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="groupKeyWords" class="col-sm-2 control-label">KeyWords</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="groupKeyWords" class="form-control"
                                                   placeholder="Your Keywords">
                                            <p>Use ","(comma) to separate keywords. Example : buy,sell</p>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button id="btnAddGroup" class="btn btn-primary btn-block">Add Group</button>

                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Facebook Page To monitor</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div class="form-horizontal">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="groupId" class="col-sm-2 control-label">Page</label>

                                        <div class="col-sm-10">

                                            <input type="text" id="pageLink" placeholder="Input page link here"
                                                   class="form-control">


                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="pageKeyWords" class="col-sm-2 control-label">KeyWords</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="pageKeyWords" class="form-control"
                                                   placeholder="Your Keywords">
                                            <p>Use ","(comma) to separate keywords. Example : buy,sell</p>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button id="btnAddPage" class="btn btn-primary btn-block">Add Page</button>

                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>

    </div>
@endsection

@section('js')
    <script>
        $('#btnAddGroup').click(function () {
            var pageId = $('#groupId').find('option:selected').attr('id');
            var pageName = $('#groupId').val();


            $.ajax({
                url: '{{url('/monitor/add')}}',
                type: 'POST',
                data: {
                    'pageId': pageId,
                    'pageName':pageName,
                    'keyWords': $('#groupKeyWords').val(),
                    'type':'group'

                },
                success: function (data) {
                    if (data == "success") {
                        alert("Done !");
                        location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function (data) {
                    alert("Something went wrong..");
                    console.log(data.responseText);
                }
            });
        });


        $('#btnAddPage').click(function () {

            $.ajax({
                type:'POST',
                url:'{{url('/capture/get/info')}}',
                data:{
                    'pageLink':$('#pageLink').val()
                },
                success:function (data) {
                    if(data.pageId == undefined){
                        return alert("Page could not found");
                    }

                    $.ajax({
                        url: '{{url('/monitor/add')}}',
                        type: 'POST',
                        data: {
                            'pageId': data.pageId,
                            'pageName':data.pageName,
                            'keyWords': $('#pageKeyWords').val(),
                            'type':'page'

                        },
                        success: function (data) {
                            if (data == "success") {
                                alert("Done !");
                                location.reload();
                            } else {
                                alert(data);
                            }
                        },
                        error: function (data) {
                            alert("Something went wrong..");
                            console.log(data.responseText);
                        }
                    });


                },
                error:function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });
    </script>

@endsection