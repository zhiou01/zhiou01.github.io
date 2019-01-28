<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img @if(Auth::user()->img == "") src="{{ url('/images/admin-lte/avatar.png') }}"
                     @else src="{{url('/uploads')}}/{{Auth::user()->img}}" @endif class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- search form -->
        <div class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {{--<li class="header">MAIN NAVIGATION</li>--}}
            {{--admin menu--}}
            @if(Auth::user()->type == 'admin')
                <li style="border-left: 3px solid" class="header">Admin Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i>
                                <span>{{trans('sidebar.Admin Dashboard')}}</span></a></li>
                        <li><a href="{{ url('/user/add') }}"><i class="fa fa-plus-circle"></i>
                                <span>{{trans('sidebar.Add User')}}</span></a>
                        </li>
                        <li><a href="{{ url('/user/list') }}"><i class="fa fa-users"></i>
                                <span>{{trans('sidebar.Users')}}</span></a></li>
                        <li><a href="{{ url('/admin/options') }}"><i class="fa fa-key"></i>
                                <span>{{trans('sidebar.Admin Options')}}</span></a></li>

                        {!! \App\Http\Controllers\Plugins::menu("admin") !!}



            @endif
            <li style="border-left:3px solid" class="header">Main Menu <i class="fa fa-circle text-primary pull-right"></i></li>
            <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>{{trans('sidebar.Dashboard')}}</span>
                </a></li>
            <li><a href="{{ url('/write') }}"><i class="fa fa-edit"></i> <span>{{trans('sidebar.Write')}}</span></a>
            </li>
            <li><a href="{{ url('/allpost') }}"><i class="fa fa-copy"></i>
                    <span>{{trans('sidebar.All posts')}}</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clock-o"></i>
                    <span>{{trans('sidebar.Schedule')}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" style="display: none">

                    <li><a href="{{ url('/schedule/day') }}"><i class="fa fa-list-ul"></i>
                            <span>{{trans('sidebar.Posts')}}</span></a></li>


                </ul>
            </li>
            {{--contacts menu--}}
            @if(\App\Http\Controllers\Data::myPackage('contacts'))
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-list-ul"></i>
                        <span>{{trans('sidebar.Contacts')}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="display: none">

                        <li><a href="{{ url('/contact/create') }}"><i class="fa fa-user-plus"></i>
                                <span>{{trans('sidebar.New Contact')}}</span></a></li>

                        <li><a href="{{ url('/contact') }}"><i class="fa fa-list-alt"></i>
                                <span>{{trans('sidebar.Contact List')}}</span></a>
                        </li>

                    </ul>
                </li>
            @endif
            {{-- chat bot menu--}}

                    @if(\App\Http\Controllers\Data::myPackage('fbBot'))
                <li style="border-left:3px solid" class="header">Bot Menu <i class="fa fa-circle text-primary pull-right"></i></li>
                        <li><a href="{{ url('/fb/bot') }}"><i class="fa fa-facebook"></i>
                                <span>{{trans('sidebar.FB')}}</span></a></li>
                    @endif
                    @if(\App\Http\Controllers\Data::myPackage('slackBot'))
                        <li><a href="{{ url('/slack/bot') }}"><i class="fa fa-slack"></i>
                                <span>{{trans('sidebar.Slack')}}</span></a></li>
                    @endif


            {{-- facebook menu --}}
            @if(\App\Http\Controllers\Data::myPackage('fb'))
                <li style="border-left: 3px solid" class="header"><i class="fa fa-facebook-square"></i> Facebook Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/facebook') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Pages')}} </a></li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/fbgroups') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Groups')}} </a></li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/conversations') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Conversations')}} </a></li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/fbreport') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Report')}} </a></li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/fbmassgrouppost') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Mass Group Post')}} </a>
                        </li>
                        <li style="border-right:3px solid #4a67ad" style="border-left:3px solid #4a67ad"><a href="{{ url('/facebook/masscomment') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Mass Comment')}} </a>
                        </li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('/masssend') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Mass Send')}} </a></li>
                        <li style="border-right:3px solid #4a67ad"><a href="{{ url('scraper') }}"><i
                                        class="fa fa-facebook-square"></i>{{trans('sidebar.Facebook Scraper')}} </a></li>
                        {!! \App\Http\Controllers\Plugins::menu("facebook") !!}




            @endif
            {{--twitter menu--}}
            @if(\App\Http\Controllers\Data::myPackage('tw'))

                <li style="border-left: 3px solid" class="header"><i class="fa fa-twitter"></i> Twitter Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/twitter') }}"><i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.My account')}}</span></a>
                        </li>
                        <li><a href="{{ url('/twitter/message/send') }}"><i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.Send Direct Message')}}</span></a>
                        </li>

                        <li><a href="{{ url('/twitter/masssend') }}"><i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.Mass Message Send')}}</span></a></li>
                        <li><a href="{{ url('/twitter/mega/masssend') }}"><i class="fa fa-twitter"></i>
                                <span>Mega Mass Send</span></a></li>

                        <li><a href="{{ url('/twitter/autoretweet') }}"><i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.Mass Retweet')}}</span></a></li>
                        <li><a href="{{ url('/twitter/autoreply') }}"><i class="fa fa-twitter"></i>
                                <span>{{trans('sidebar.Mass Reply')}}</span></a></li>
                        <li><a href="{{ url('/tw/scraper') }}"><i
                                        class="fa fa-twitter"></i>{{trans('sidebar.Twitter Scraper')}} </a></li>
                        {!! \App\Http\Controllers\Plugins::menu("twitter") !!}

            @endif

            {{--instagram menu--}}
            @if(\App\Http\Controllers\Data::myPackage('in'))
                <li style="border-left: 3px solid" class="header"><i class="fa fa-instagram"></i> Instagram Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/instagram/me') }}"><i class="fa fa-instagram"></i>
                                <span>{{trans('sidebar.My account')}}</span></a>
                        <li><a href="{{ url('/instagram/home') }}"><i class="fa fa-instagram"></i>
                                <span>{{trans('sidebar.Home')}}</span></a>
                        <li><a href="{{ url('/instagram/popular') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Popular Feed')}} </span></a>
                        <li><a href="{{ url('/instagram/followers') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Followers')}} </span></a>
                        <li><a href="{{ url('/instagram/following') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Following')}} </span></a>
                        <li><a href="{{ url('/instagram/following/activity') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Following Activity')}} </span></a>
                        <li><a href="{{ url('/instagram/auto/follow') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Auto follow')}} </span></a>
                        <li><a href="{{ url('/instagram/auto/unfollow') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Auto unfollow')}} </span></a>
                        <li><a href="{{ url('/instagram/auto/comments') }}"><i
                                        class="fa fa-instagram"></i><span>{{trans('sidebar.Auto comment')}} </span></a>
                        {{--                        <li><a href="{{ url('/instagram/auto/message') }}"><i class="fa fa-envelope"></i><span> Auto Message</span></a>--}}
                        <li><a href="{{ url('/instagram/scraper') }}"><i class="fa fa-instagram"></i>
                                <span>{{trans('sidebar.Scraper')}}</span></a>
                        </li>
                        {!! \App\Http\Controllers\Plugins::menu("instagram") !!}


            @endif

             {{--Pinterest menu --}}
            @if(\App\Http\Controllers\Data::myPackage('pinterest'))

                <li style="border-left: 3px solid" class="header"><i class="fa fa-pinterest"></i> Pinterest Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/pinterest/pins') }}"><i class="fa fa-pinterest"></i>
                        <span>My Pins</span></a>
                        </li>

                        <li><a href="{{ url('/pinterest/home') }}"><i class="fa fa-pinterest"></i>
                        <span>Home</span></a>
                        </li>



                        <li><a href="{{ url('/pinterest/inbox') }}"><i class="fa fa-pinterest"></i>
                        <span>Inbox</span></a>
                        </li>

                        <li><a href="{{ url('/pinterest/notifications') }}"><i class="fa fa-pinterest"></i>
                        <span>Notifications</span></a>
                        </li>

                        <li><a href="{{ url('/pinterest/scraper') }}"><i class="fa fa-pinterest"></i>
                                <span>{{trans('sidebar.Scraper')}}</span></a>
                        </li>

                        {!! \App\Http\Controllers\Plugins::menu("pinterest") !!}

            @endif
            {{--linkedin menu--}}
            @if(\App\Http\Controllers\Data::myPackage('ln'))

                <li style="border-left: 3px solid" class="header"><i class="fa fa-linkedin"></i> Linkedin Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/linkedin/updates') }}"><i class="fa fa-linkedin"></i>
                                <span>{{trans('sidebar.All updates')}}</span></a>
                        </li>
                        <li><a href="{{ url('/linkedin/mass_comment') }}"><i class="fa fa-linkedin"></i>
                                <span>{{trans('sidebar.Mass Comment')}}</span></a></li>
                        {!! \App\Http\Controllers\Plugins::menu("linkedin") !!}

            @endif
            {{--tumblr menu--}}
            @if(\App\Http\Controllers\Data::myPackage('tu'))
                <li style="border-left: 3px solid" class="header"><i class="fa fa-tumblr"></i> Tumblr Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/tumblr') }}"><i class="fa fa-tumblr"></i>
                                <span>{{trans('sidebar.Tumblr')}}</span></a></li>
                        {!! \App\Http\Controllers\Plugins::menu("tumblr") !!}

            @endif
            {{--wordpress menu--}}
            @if(\App\Http\Controllers\Data::myPackage('wp'))

                <li style="border-left: 3px solid" class="header"><i class="fa fa-wordpress"></i> Wordpress Menu <i class="fa fa-circle text-primary pull-right"></i></li>

                        <li><a href="{{ url('/wordpress') }}"><i class="fa fa-wordpress"></i>
                                <span>{{trans('sidebar.Wordpress')}}</span></a>
                        </li>
                        {!! \App\Http\Controllers\Plugins::menu("wordpress") !!}

            @endif
            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-calendar-check-o"></i>--}}
            {{--<span>Schedule</span>--}}
            {{--<small class="badge pull-right bg-aqua">Special <i class="fa fa-angle-left pull-right"></i></small>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/schedules') }}"><i class="fa fa-list"></i> Schedules List</a></li>--}}
            {{--<li><a href="{{ url('/scheduleslog') }}"><i class="fa fa-sticky-note"></i> Schedules Log</a></li>--}}

            {{--</ul>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>Reports</span><i class="fa fa-angle-left pull-right"></i>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/fbreport') }}"><i class="fa fa-files-o"></i> <span>Facebook reports</span></a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}


            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-youtube"></i>--}}
            {{--<span>YouTube</span><i class="fa fa-angle-left pull-right"></i>--}}

            {{--</a>--}}
            {{--<ul class="treeview-menu" style="display: none;">--}}
            {{--<li><a href="{{ url('/youtube/download') }}"><i class="fa fa-download"></i> <span>Download Video</span></a>--}}
            {{--</li>--}}

            {{--</ul>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span>{{trans('sidebar.Notifications')}}</span><i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ url('/notify') }}"><i class="fa fa-bell-o"></i>
                            <span>{{trans('sidebar.All Notifications')}}</span></a>
                    </li>

                    {!! \App\Http\Controllers\Plugins::menu("notifications") !!}

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>{{trans('sidebar.Settings')}}</span><i class="fa fa-angle-left pull-right"></i>

                </a>
                <ul class="treeview-menu" style="display: none;">

                    <li><a href="{{ url('/settings') }}"><i class="fa fa-gear"></i>
                            <span>{{trans('sidebar.Settings')}}</span></a></li>
                    <li><a href="{{ url('/settings/notifications') }}"><i class="fa fa-bell"></i>
                            <span>{{trans('sidebar.Notification')}}</span></a></li>
                    {{--<li><a href="{{ url('/settings/config') }}"><i class="fa fa-gears"></i>--}}
                    {{--<span>Configurations</span></a>--}}
                    {{--</li>--}}

                    <li><a href="{{ url('/profile') }}"><i class="fa fa-user"></i>
                            <span>{{trans('sidebar.Profile')}}</span></a></li>


                </ul>
            </li>

            {!! \App\Http\Controllers\Plugins::menu("all") !!}

            {{--@if(Auth::user()->type == 'admin')--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#">--}}
                        {{--<i class="fa fa-puzzle-piece"></i>--}}
                        {{--<span>{{trans('sidebar.Plugins')}}</span><i class="fa fa-angle-left pull-right"></i>--}}

                    {{--</a>--}}
                    {{--<ul class="treeview-menu" style="display: none;">--}}
                        {{--<li><a href="{{ url('/plugin/add') }}"><i class="fa fa-user-plus"></i>--}}
                                {{--<span>{{trans('sidebar.Add Plugin')}}</span></a>--}}
                        {{--</li>--}}
                        {{--<li><a href="{{ url('/plugin/list') }}"><i--}}
                                        {{--class="fa fa-list-ul"></i><span>{{trans('sidebar.Plugin List')}}</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<li class="treeview">--}}
                    {{--<a href="#">--}}
                        {{--<i class="fa fa-shopping-bag"></i>--}}
                        {{--<span>{{trans('sidebar.Shop')}}</span><i class="fa fa-angle-left pull-right"></i>--}}

                    {{--</a>--}}
                    {{--<ul class="treeview-menu" style="display: none;">--}}
                        {{--<li><a href="{{ url('/shop') }}"><i class="fa fa-home"></i>--}}
                                {{--<span>{{trans('sidebar.Plugin Shop')}} </span></a>--}}
                        {{--</li>--}}

                    {{--</ul>--}}
                {{--</li>--}}



            {{--@endif--}}


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
