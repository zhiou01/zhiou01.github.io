<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <strong>Version</strong> {{file_get_contents(base_path().'/version.txt')}}
    </div>
    <strong>Developed by </strong><a href="https://codecanyon.net/user/srigal" target="_blank">Srigal</a>
</footer>


<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i
                        class="fa fa-wrench"></i></a></li>
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
            <div><h4 class="control-sidebar-heading">Options</h4>
                <div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox"
                                                                                         data-layout="fixed"
                                                                                         class="pull-right">
                        Hint </label>
                    <p>It will help you to understand how the features work or some information you need to know</p>
                </div>


                <h4 class="control-sidebar-heading">Skins</h4>

                <ul class="list-unstyled clearfix">
                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/purple.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-purple"
                                           value="skin-purple"
                                           @if(Auth::user()->theme == "skin-purple") checked @endif >
                                    Purple
                                </label>
                            </div>
                        </div>
                    </li>

                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/purple-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-purple-light"
                                           value="skin-purple-light"
                                           @if(Auth::user()->theme == "skin-purple-light") checked @endif >
                                    Purple Light
                                </label>
                            </div>
                        </div>
                    </li>


                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/blue.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-blue" value="skin-blue"
                                           @if(Auth::user()->theme == "skin-blue") checked @endif >
                                    Blue
                                </label>
                            </div>
                        </div>
                    </li>
                    
                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/blue-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-blue-light"
                                           value="skin-blue-light"
                                           @if(Auth::user()->theme == "skin-blue-light") checked @endif >
                                    Blue Light
                                </label>
                            </div>
                        </div>
                    </li>

                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/green.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-green" value="skin-green"
                                           @if(Auth::user()->theme == "skin-green") checked @endif >
                                    Green
                                </label>
                            </div>
                        </div>
                    </li>

                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/green-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-green-light"
                                           value="skin-green-light"
                                           @if(Auth::user()->theme == "skin-green-light") checked @endif >
                                    Green Light
                                </label>
                            </div>
                        </div>
                    </li>

                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/yellow.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-yellow"
                                           value="skin-yellow"
                                           @if(Auth::user()->theme == "skin-yellow") checked @endif >
                                    Yellow
                                </label>
                            </div>
                        </div>
                    </li>
                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/yellow-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-yellow-light"
                                           value="skin-yellow-light"
                                           @if(Auth::user()->theme == "skin-yellow-light") checked @endif >
                                    Yellow Light
                                </label>
                            </div>
                        </div>
                    </li>

                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/red.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-red" value="skin-red"
                                           @if(Auth::user()->theme == "skin-red") checked @endif >
                                    Red
                                </label>
                            </div>
                        </div>
                    </li>


                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/red-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-red-light"
                                           value="skin-red-light"
                                           @if(Auth::user()->theme == "skin-red-light") checked @endif >
                                    Red Light
                                </label>
                            </div>
                        </div>
                    </li>


                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/black.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-black" value="skin-black"
                                           @if(Auth::user()->theme == "skin-black") checked @endif >
                                    Black
                                </label>
                            </div>
                        </div>
                    </li>


                    <li style=" width: 10%; ">
                        <div class="col-md-1">
                            <div class="radio">
                                <img src="{{url('/images/optimus/themes/black-light.png')}}">
                                <label>
                                    <input type="radio" name="optionsRadios" id="skin-black-light"
                                           value="skin-black-light"
                                           @if(Auth::user()->theme == "skin-black-light") checked @endif >
                                    Black Light
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-pane" id="control-sidebar-home-tab">


        </div>


    </div>
</aside>