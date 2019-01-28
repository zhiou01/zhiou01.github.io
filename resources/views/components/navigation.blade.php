<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="" class="navbar-brand"><b>Social</b>Lit</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">


                    @if(\App\Http\Controllers\Data::myPackage('fb'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-facebook"></i>
                                <span>{{trans('sidebar.Facebook')}}</span><span class="caret"></span>

                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/facebook') }}">{{trans('sidebar.Facebook Pages')}} </a></li>
                                {{--                                <li><a href="{{ url('/fbgroups') }}">{{trans('sidebar.Facebook Groups')}} </a></li>--}}
                                <li><a href="{{ url('/conversations') }}">{{trans('sidebar.Conversations')}} </a></li>
                                <li><a href="{{ url('/campaign') }}">Campaign </a></li>
                                <li><a href="{{ url('/capture') }}">Capture </a></li>
                                <li><a href="{{ url('/fb/bot') }}">Messenger Bot </a></li>
                                {{--<li><a href="{{ url('/fbreport') }}">{{trans('sidebar.Facebook Report')}} </a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="{{ url('/fbmassgrouppost') }}">{{trans('sidebar.Facebook Mass Group Post')}}--}}
                                {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="{{ url('/facebook/masscomment') }}">{{trans('sidebar.Facebook Mass Comment')}}--}}
                                {{--</a>--}}
                                {{--</li>--}}
                                <li><a href="{{ url('/masssend') }}">{{trans('sidebar.Facebook Mass Send')}} </a></li>
                                <li><a href="{{ url('extend') }}">{{trans('sidebar.Extend')}} </a></li>
                                <li><a href="{{ url('scraper') }}">{{trans('sidebar.Facebook Scraper')}} </a></li>
                                <li><a href="{{ url('/rss') }}">RSS to Facebook </a></li>
                                <li><a href="{{ url('/web') }}">Web to Facebook </a></li>

                                {!! \App\Http\Controllers\Plugins::menu("facebook") !!}

                            </ul>
                        </li>


                    @endif


                    {{--twitter menu--}}
                    @if(\App\Http\Controllers\Data::myPackage('tw'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.Twitter')}}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/twitter') }}">
                                        <span>{{trans('sidebar.My account')}}</span></a>
                                </li>
                                <li><a href="{{ url('/twitter/message/send') }}">
                                        <span>{{trans('sidebar.Send Direct Message')}}</span></a>
                                </li>

                                <li><a href="{{ url('/twitter/masssend') }}">
                                        <span>{{trans('sidebar.Mass Message Send')}}</span></a></li>
                                {{--<li><a href="{{ url('/twitter/mega/masssend') }}">--}}
                                {{--<span>Mega Mass Send</span></a></li>--}}

                                <li><a href="{{ url('/twitter/autoretweet') }}">
                                        <span>{{trans('sidebar.Mass Retweet')}}</span></a></li>

                                <li><a href="{{ url('/twitter/autoretweet/hashtag') }}">
                                        <span>{{trans('sidebar.Auto Retweet Hashtag')}}</span></a></li>

                                <li><a href="{{ url('/twitter/autoreply') }}">
                                        <span>{{trans('sidebar.Mass Reply')}}</span></a></li>
                                <li><a href="{{ url('/tw/scraper') }}">{{trans('sidebar.Twitter Scraper')}} </a></li>
                                <li><a href="{{ url('/rss') }}">RSS To Twitter </a></li>
                                <li><a href="{{ url('/web') }}">Web To Twitter </a></li>
                                {!! \App\Http\Controllers\Plugins::menu("twitter") !!}
                            </ul>

                        </li>
                    @endif

                    {{--instagram menu--}}
                    @if(\App\Http\Controllers\Data::myPackage('in'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-instagram"></i>
                                <span>{{trans('sidebar.Instagram')}}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/instagram/me') }}">
                                        <span>{{trans('sidebar.My account')}}</span></a>
                                <li><a href="{{ url('/instagram/home') }}">
                                        <span>{{trans('sidebar.Home')}}</span></a>
                                <li><a href="{{ url('/instagram/popular') }}"></i>
                                        <span>{{trans('sidebar.Popular Feed')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/followers') }}"><span>{{trans('sidebar.Followers')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/following') }}"><span>{{trans('sidebar.Following')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/following/activity') }}"><span>{{trans('sidebar.Following Activity')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/auto/follow') }}"><span>{{trans('sidebar.Auto follow')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/auto/unfollow') }}"><span>{{trans('sidebar.Auto unfollow')}} </span></a>
                                <li>
                                    <a href="{{ url('/instagram/auto/comments') }}"><span>{{trans('sidebar.Auto comment')}} </span></a>
                                {{--                        <li><a href="{{ url('/instagram/auto/message') }}"><i class="fa fa-envelope"></i><span> Auto Message</span></a>--}}
                                <li><a href="{{ url('/instagram/scraper') }}">
                                        <span>{{trans('sidebar.Scraper')}}</span></a>
                                </li>

                                </li>
                                {!! \App\Http\Controllers\Plugins::menu("instagram") !!}

                            </ul>

                        </li>
                    @endif



                    {{--Pinterest menu--}}
                    @if(\App\Http\Controllers\Data::myPackage('pinterest'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-pinterest"></i>
                                <span>{{trans('sidebar.Pinterest')}}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">


                                <li><a href="{{ url('/pinterest/pins') }}">
                                        <span>My Pins</span></a>
                                </li>

                                <li><a href="{{ url('/pinterest/home') }}">
                                        <span>Home</span></a>
                                </li>


                                {{--<li><a href="{{ url('/pinterest/inbox') }}">--}}
                                {{--<span>Inbox</span></a>--}}
                                {{--</li>--}}

                                {{--<li><a href="{{ url('/pinterest/notifications') }}">--}}
                                {{--<span>Notifications</span></a>--}}
                                {{--</li>--}}

                                <li><a href="{{ url('/pinterest/scraper') }}">
                                        <span>{{trans('sidebar.Scraper')}}</span></a>
                                </li>

                                <li><a href="{{ url('/pinterest/auto/comment') }}">
                                        <span>Auto Comment & Repin</span></a>
                                </li>

                                <li><a href="{{ url('/pinterest/auto/repin') }}">
                                        <span>Auto Repin</span></a>
                                </li>

                                {!! \App\Http\Controllers\Plugins::menu("pinterest") !!}
                            </ul>

                        </li>
                    @endif
                    {{--linkedin menu--}}

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-globe"></i>
                            <span>Web To Social</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/rss') }}">
                                    <span>RSS to Social Media</span></a>
                            </li>

                            <li><a href="{{ url('/web') }}">
                                    <span>Web To Social</span></a>
                            </li>

                        </ul>

                    </li>


                    @if(\App\Http\Controllers\Data::myPackage('ln'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-linkedin"></i>
                                <span>{{trans('sidebar.Linkedin')}}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/linkedin/updates') }}">
                                        <span>{{trans('sidebar.All updates')}}</span></a>
                                </li>
                                <li><a href="{{ url('/linkedin/mass_comment') }}">
                                        <span>{{trans('sidebar.Mass Comment')}}</span></a></li>
                                {!! \App\Http\Controllers\Plugins::menu("linkedin") !!}
                            </ul>

                        </li>
                    @endif

                    {{--tumblr menu--}}
                    @if(\App\Http\Controllers\Data::myPackage('tu'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-tumblr-square"></i>
                                <span>{{trans('sidebar.Tumblr')}}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/tumblr') }}">
                                        <span>{{trans('sidebar.Tumblr')}}</span></a></li>
                                {!! \App\Http\Controllers\Plugins::menu("tumblr") !!}
                            </ul>
                        </li>
                    @endif
                    {{--wordpress menu--}}
                    @if(\App\Http\Controllers\Data::myPackage('wp'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wordpress"></i>
                                <span>{{trans('sidebar.Wordpress')}} </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/wordpress') }}">
                                        <span>{{trans('sidebar.Wordpress')}}</span></a>
                                </li>
                                {!! \App\Http\Controllers\Plugins::menu("wordpress") !!}
                            </ul>
                        </li>
                    @endif

                    @if(\App\Http\Controllers\Data::myPackage('pack1'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-reddit"></i>
                                <span>Reddit </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/reddit') }}">
                                        <span>Search</span></a>
                                </li>
                                {!! \App\Http\Controllers\Plugins::menu("pack1") !!}
                            </ul>
                        </li>
                    @endif

                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>


                </ul>

            </div>
            <!-- /.navbar-collapse -->

            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>