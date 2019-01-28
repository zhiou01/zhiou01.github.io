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

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            {{--admin menu--}}
            @if(Auth::user()->type == 'admin')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>{{trans('sidebar.Admin Panel')}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="display: none">
                        <li><a href="{{ url('/admin') }}"><i class="fa fa-dot-circle-o"></i>
                                <span>Dashboard</span></a></li>
                        <li><a href="{{ url('/user/add') }}"><i class="fa fa-dot-circle-o"></i>
                                <span>{{trans('sidebar.Add User')}}</span></a>
                        </li>
                        <li><a href="{{ url('/user/list') }}"><i class="fa fa-dot-circle-o"></i>
                                <span>{{trans('sidebar.Users')}}</span></a></li>
                        <li><a href="{{ url('/admin/options') }}"><i class="fa fa-dot-circle-o"></i>
                                <span>Options</span></a></li>

                        <li><a href="{{ url('/software/update') }}"><i class="fa fa-dot-circle-o"></i>
                                <span>Software Update</span></a></li>

                        {!! \App\Http\Controllers\Plugins::menu("admin") !!}

                    </ul>
                </li>

                @endif
                {{--<li><a href="{{ url('/home') }}"><i class="fa fa-th"></i> <span>{{trans('sidebar.Dashboard')}}</span>--}}
                </a></li>
                <li><a href="{{ url('/write') }}"><i class="fa fa-edit"></i> <span>{{trans('sidebar.Write')}}</span></a>
                <li><a href="{{ url('/schedule/filter/all') }}"><i class="fa fa-calendar"></i> <span>Schedule Posts</span></a>
                </li>
                {{--<li><a href="{{ url('/allpost') }}"><i class="fa fa-copy"></i>--}}
                {{--<span>{{trans('sidebar.All posts')}}</span></a></li>--}}

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

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-comment"></i>
                        <span>{{trans('sidebar.Chat Bot')}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="display: none">
                        @if(\App\Http\Controllers\Data::myPackage('fbBot'))
                            <li><a href="{{ url('/fb/bot') }}"><i class="fa fa-facebook"></i>
                                    <span>{{trans('sidebar.FB')}}</span></a></li>
                        @endif
                        @if(\App\Http\Controllers\Data::myPackage('slackBot'))
                            <li><a href="{{ url('/slack/bot') }}"><i class="fa fa-slack"></i>
                                    <span>{{trans('sidebar.Slack')}}</span></a></li>
                        @endif
                    </ul>
                </li>







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

                {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                {{--<i class="fa fa-bell"></i>--}}
                {{--<span>{{trans('sidebar.Notifications')}}</span><i class="fa fa-angle-left pull-right"></i>--}}

                {{--</a>--}}
                {{--<ul class="treeview-menu" style="display: none;">--}}
                {{--<li><a href="{{ url('/notify') }}"><i class="fa fa-bell-o"></i>--}}
                {{--<span>{{trans('sidebar.All Notifications')}}</span></a>--}}
                {{--</li>--}}

                {{--{!! \App\Http\Controllers\Plugins::menu("notifications") !!}--}}

                {{--</ul>--}}
                {{--</li>--}}

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gear"></i>
                        <span>{{trans('sidebar.Settings')}}</span><i class="fa fa-angle-left pull-right"></i>

                    </a>
                    <ul class="treeview-menu" style="display: none;">

                        <li><a href="{{ url('/settings') }}"><i class="fa fa-gear"></i>
                                <span>{{trans('sidebar.Settings')}}</span></a></li>


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




                <li class="header"></li>
                <li data-hint="test"><a href="#" onclick="introJs().start();"><i class="fa fa-circle-o text-yellow"></i>
                        <span>How to</span></a></li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i> Options</a>
                </li>
                <li class="header"></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

