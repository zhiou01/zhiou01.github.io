@extends('layouts.app')
@section('title','Wordpress Site')

@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')


        <div class="content-wrapper">
            <section class="content">

                @foreach($data as $d => $post)
                    @if($post['post_title'] != "")
                        <div class="row">
                            <div id="post_{{$post['ID']}}" class="col-md-12">
                                <!-- Box Comment -->
                                <div class="box box-widget">
                                    <div class="box-header with-border">
                                        <div class="user-block">
                                            <img class="img-circle" src="{{url('/images/optimus/social/wp.png')}}"
                                                 alt="User Image">
                                            <span class="username"><a
                                                        target="_blank"
                                                        href="{{$post['permalink']}}">{{$post['post_title']}}</a></span>
                                            <span class="description">{{$post['post_date']['date']}}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="box-tools">

                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                        class="fa fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-box-tool"><i
                                                        data-id="{{$post['ID']}}" class="fa fa-times"></i></button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="">
                                        <!-- post text -->

                                        {!! $post['post_content'] !!}


                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer box-comments" style="">

                                        @foreach(\App\Http\Controllers\WordpressController::getComment($post['ID'],$siteId) as $comment)
                                            <div class="box-comment">
                                                <!-- User image -->
                                                <img class="img-circle img-sm"
                                                     src="{{url('/images/admin-lte/avatar.png')}}"
                                                     alt="User Image">

                                                <div class="comment-text">
                      <span class="username">
                        {{$comment['comment_author']}}
                          <span class="text-muted pull-right">{{$comment['comment_date']}}</span>
                      </span><!-- /.username -->
                                                    {!! $comment['comment_content'] !!}
                                                </div>
                                                <!-- /.comment-text -->
                                            </div>

                                    @endforeach


                                    <!-- /.box-comment -->

                                        <!-- /.box-comment -->
                                    </div>
                                    <!-- /.box-footer -->

                                    <!-- /.box-footer -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                    @endif

                @endforeach

            </section>{{--End content--}}
        </div>{{--End content-wrapper--}}
        @include('components.footer')
    </div>{{--End wrapper--}}
@endsection

@section('js')

    <script>
        $('.fa-times').click(function () {
            var postId = $(this).attr('data-id');
            if (confirm("Are you sure to delete this post ?")) {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/wordpress/delete/post')}}',
                    data: {
                        'postId': postId,
                        'siteId': '{{$siteId}}'
                    },
                    success: function (data) {
                        if (data == "success") {
                            $('#post_' + postId).hide(300);

                        } else {
                            alert(data);
                        }
                    }, error: function (data) {
                        alert("Something went wrong");
                        console.log(data.responseText);
                    }
                });
            }


        })
    </script>
@endsection