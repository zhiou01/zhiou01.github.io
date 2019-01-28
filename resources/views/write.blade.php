@extends('layouts.app')
@section('title','Write')



@section('content')
    <div class="wrapper">
        @include('components.navigation')
        @include('components.sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="box no-border">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="box-body">

                                    <div data-step="1"
                                         data-intro="Select your post type. Link Post only available for Facebook and Linkedin"
                                         class="form-group">
                                        <div class="box no-border">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="r" id="texttype"
                                                                       value="texttype"
                                                                       checked="checked">
                                                                Text
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="r" id="imagetype"
                                                                       value="imagetype">
                                                                Image
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div data-hint="Link post only for Facebook and Linkedin"
                                                         class="col-md-6">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="r" id="sharetype"
                                                                       value="sharetype">
                                                                Link Post
                                                            </label>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                    <div class="no-border">
                                        <div data-step="2"
                                             data-intro="Title for your post, Title is not important for text type post"
                                             class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input id="dataTitle" class="form-control"
                                                           placeholder="Title"
                                                           type="text">
                                                </div>

                                            </div>
                                        </div>
                                        <div
                                                class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input id="caption" class="form-control"
                                                           placeholder="Title for image"
                                                           type="text">
                                                </div>

                                            </div>
                                        </div>
                                        <div id="linkoption"
                                             class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input id="link" type="text" class="form-control"
                                                           placeholder="Link of content">
                                                </div>

                                            </div>
                                        </div>
                                        <div id="imgoption"
                                             class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form id="uploadimage" method="post" enctype="multipart/form-data">
                                                        <label>Select Your Image</label><br/>
                                                        <input class="" type="file" name="file"
                                                               id="file"/><br>
                                                        <input class="btn btn-xs btn-success" type="submit"
                                                               value="Upload"
                                                               id="imgUploadBtn"/>


                                                        <input value="" type="hidden" id="image">
                                                        <div id="imgMsg"></div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="desOption"
                                             class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input id="description" type="text" class="form-control"
                                                           placeholder="Description of link">
                                                </div>

                                            </div>
                                            <br>
                                        </div>


                                        <div class="form-group">
                                            <div data-step="7"
                                                 data-intro="You can translate From English to your Language"
                                                 class="row">
                                                <div class="col-md-8">
                                                    <select id="lang" class="form-control">
                                                        <option value="AF">Afrikanns</option>
                                                        <option value="SQ">Albanian</option>
                                                        <option value="AR">Arabic</option>
                                                        <option value="HY">Armenian</option>
                                                        <option value="EU">Basque</option>
                                                        <option value="BN">Bengali</option>
                                                        <option value="BG">Bulgarian</option>
                                                        <option value="CA">Catalan</option>
                                                        <option value="KM">Cambodian</option>
                                                        <option value="ZH">Chinese (Mandarin)</option>
                                                        <option value="HR">Croation</option>
                                                        <option value="CS">Czech</option>
                                                        <option value="DA">Danish</option>
                                                        <option value="NL">Dutch</option>
                                                        <option selected="selected" value="EN">English</option>
                                                        <option value="ET">Estonian</option>
                                                        <option value="FJ">Fiji</option>
                                                        <option value="FI">Finnish</option>
                                                        <option value="FR">French</option>
                                                        <option value="KA">Georgian</option>
                                                        <option value="DE">German</option>
                                                        <option value="EL">Greek</option>
                                                        <option value="GU">Gujarati</option>
                                                        <option value="HE">Hebrew</option>
                                                        <option value="HI">Hindi</option>
                                                        <option value="HU">Hungarian</option>
                                                        <option value="IS">Icelandic</option>
                                                        <option value="ID">Indonesian</option>
                                                        <option value="GA">Irish</option>
                                                        <option value="IT">Italian</option>
                                                        <option value="JA">Japanese</option>
                                                        <option value="JW">Javanese</option>
                                                        <option value="KO">Korean</option>
                                                        <option value="LA">Latin</option>
                                                        <option value="LV">Latvian</option>
                                                        <option value="LT">Lithuanian</option>
                                                        <option value="MK">Macedonian</option>
                                                        <option value="MS">Malay</option>
                                                        <option value="ML">Malayalam</option>
                                                        <option value="MT">Maltese</option>
                                                        <option value="MI">Maori</option>
                                                        <option value="MR">Marathi</option>
                                                        <option value="MN">Mongolian</option>
                                                        <option value="NE">Nepali</option>
                                                        <option value="NO">Norwegian</option>
                                                        <option value="FA">Persian</option>
                                                        <option value="PL">Polish</option>
                                                        <option value="PT">Portuguese</option>
                                                        <option value="PA">Punjabi</option>
                                                        <option value="QU">Quechua</option>
                                                        <option value="RO">Romanian</option>
                                                        <option value="RU">Russian</option>
                                                        <option value="SM">Samoan</option>
                                                        <option value="SR">Serbian</option>
                                                        <option value="SK">Slovak</option>
                                                        <option value="SL">Slovenian</option>
                                                        <option value="ES">Spanish</option>
                                                        <option value="SW">Swahili</option>
                                                        <option value="SV">Swedish</option>
                                                        <option value="TA">Tamil</option>
                                                        <option value="TT">Tatar</option>
                                                        <option value="TE">Telugu</option>
                                                        <option value="TH">Thai</option>
                                                        <option value="BO">Tibetan</option>
                                                        <option value="TO">Tonga</option>
                                                        <option value="TR">Turkish</option>
                                                        <option value="UK">Ukranian</option>
                                                        <option value="UR">Urdu</option>
                                                        <option value="UZ">Uzbek</option>
                                                        <option value="VI">Vietnamese</option>
                                                        <option value="CY">Welsh</option>
                                                        <option value="XH">Xhosa</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <button id="translate" class="btn btn-block btn-primary"><i
                                                                class="fa fa-language"></i>
                                                        Translate
                                                    </button>
                                                </div>
                                            </div>


                                            <br>
                                            <input type="hidden" id="postId">
                                            <textarea class="form-control" rows="4"
                                                      id="status"
                                                      placeholder="Type your content here"></textarea>
                                        </div>


                                    </div>


                                    {{--scheduling start--}}


                                    {{--scheduling end--}}

                                    <div class="form-group">
                                        <div class="btn-group">
                                            <button data-step="3"
                                                    data-intro="Click this button to post to your social media"
                                                    id="write"
                                                    class="btn btn-success"><i class="fa fa-send"></i>
                                                Post
                                            </button>

                                            <button data-toggle="modal" data-modal="#scheduleModal" data-step="4"
                                                    data-intro="Click here to schedule your post"
                                                    id="addschedule"
                                                    class="btn btn-default"><i class="fa fa-calendar"></i> Add
                                                to
                                                schedule
                                            </button>
                                        </div>
                                        <br><br>

                                    </div>
                                    <div id="ss" style="display: none;" class="form-group">
                                        <div>


                                        </div>


                                    </div>

                                </div>

                            </div>
                            <div data-step="5" data-intro="Select where you want to post your content" class="col-md-4">

                                <div
                                        style="padding-left: 10px" class="form-group">
                                    <br>
                                    <div class="btn-group btn-group" data-toggle="buttons">
                                        @if(\App\Http\Controllers\Data::myPackage('fb'))
                                            @if(!empty(\App\Http\Controllers\Data::get('fbAppId')))
                                                <label class="btn btn-default">
                                                    <input id="fbCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-facebook"></i>
                                                    {{--Facebook page--}}
                                                </label>

                                                <label class="btn btn-default">
                                                    <input id="fbgCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-users"></i>
                                                    {{--Facebook group--}}
                                                </label>
                                            @endif
                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('tw'))
                                            @if(!empty(\App\Http\Controllers\Data::get('twTokenSec')))
                                                <label class="btn btn-default">
                                                    <input id="twCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-twitter"></i>
                                                    {{--Twitter--}}
                                                </label>
                                            @endif
                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('in'))
                                            @if(!empty(\App\Http\Controllers\Data::get('inPass')))
                                                <label class="btn btn-default">
                                                    <input id="iCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-instagram"></i>
                                                    {{--Instagram--}}
                                                </label>
                                            @endif
                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('wp'))

                                            @if(!empty(\App\Http\Controllers\Data::get('wpPassword')))
                                                <label class="btn btn-default">
                                                    <input id="wpCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-wordpress"></i>
                                                    {{--Wordpress--}}
                                                </label>
                                            @endif

                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('tu'))
                                            @if(!empty(\App\Http\Controllers\Data::get('tuTokenSec')))
                                                <label class="btn btn-default">
                                                    <input id="tuCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-tumblr"></i>
                                                    {{--Tumblr--}}
                                                </label>
                                            @endif
                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('ln'))

                                            @if(!empty(\App\Http\Controllers\Data::get('liAccessToken')))
                                                <label class="btn btn-default">
                                                    <input id="linkedinCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-linkedin"></i>
                                                    {{--Linkedin--}}
                                                </label>
                                            @endif
                                        @endif

                                        @if(\App\Http\Controllers\Data::myPackage('pinterest'))
                                            @if(!empty(\App\Http\Controllers\Data::get('pinPass')))
                                                <label class="btn btn-default">
                                                    <input id="pinCheck" type="checkbox" autocomplete="off"><i
                                                            class="fa fa-pinterest"></i>

                                                </label>
                                            @endif
                                        @endif

                                    </div>

                                </div>
                                <div style="padding-left: 10px" class="form-group">
                            <span style="display: none" id="fbl" class="label label-default"><i
                                        class="fa fa-facebook"></i> Facebook page selected</span>

                                    <span style="display: none" id="fblg" class="label label-default"><i
                                                class="fa fa-users"></i> Facebook group selected</span>
                                    <span style="display: none" id="fblpg" class="label label-default"><i
                                                class="fa fa-users"></i> FB all public group selected</span>

                                    <span style="display: none" id="twl" class="label label-default"><i
                                                class="fa fa-twitter"></i> Twitter selected</span>

                                    <span style="display: none" id="inl" class="label label-default"><i
                                                class="fa fa-instagram"></i> Instagram selected</span>

                                    <span style="display: none" id="wpl" class="label label-default"><i
                                                class="fa fa-wordpress"></i> Wordpress selected</span>

                                    <span style="display: none" id="tul" class="label label-default"><i
                                                class="fa fa-tumblr"></i> Tumblr selected</span>
                                    <span style="display: none" id="skypel" class="label label-default"><i
                                                class="fa fa-skype"></i> Skype selected</span>
                                    <span style="display: none" id="linkedinl" class="label label-default"><i
                                                class="fa fa-linkedin"></i> Linkedin selected</span>

                                    <span style="display: none" id="pinl" class="label label-default"><i
                                                class="fa fa-pinterest"></i> Pinterest selected</span>
                                </div>
                                <div class="form-group" style="padding-left:10px">
                                    <div id="fbGroupsSection" style="display: none">
                                        <fieldset class="scheduler-border">
                                            Select Group

                                            <select class="form-control" id="fbgroups">
                                                @foreach($fbGroups as $fbg)
                                                    <option value="{{$fbg->pageId}}">{{$fbg->pageName}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-left:10px">
                                    <div id="liCompanySelection" style="display: none">
                                        <fieldset class="scheduler-border">
                                            Your linkedin company list <br>

                                            <select class="form-control" id="liCompanies" multiple>
                                                <option value="all" selected>All Companies</option>
                                                @if($liCompanies != "")
                                                    @foreach($liCompanies as $liCompany)
                                                        <option value="{{ $liCompany['id'] }}">{{ $liCompany['name'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-left:10px">


                                    <div id="fbPages" style="display: none;" class="form-group">
                                        <fieldset class="scheduler-border">
                                            Select your Page

                                            <select class="form-control" id="fbPages">
                                                @foreach($fbPages as $fb)
                                                    <option id="{{$fb->pageId}}"
                                                            value="{{$fb->pageToken}}">{{$fb->pageName}}</option>
                                                @endforeach
                                            </select>


                                        </fieldset>
                                    </div>

                                    <div style="display: none" id="urlOption"
                                         class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if($boards == 'Not available')
                                                    {{$boards}}
                                                @else
                                                    Select
                                                    <Board></Board>
                                                    <select id="boardId">
                                                        @foreach($boards as $board)
                                                            <option value="{{$board['id']}}">{{$board['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>

                                        </div>
                                        <br>
                                    </div>

                                    <div class="form-group" style="padding-left:10px">

                                        <div id="tuBlog" style="display: none">
                                            <fieldset class="scheduler-border">
                                                Select Tumblr Blog


                                                <select id="tuBlogName">
                                                    @foreach(\App\TuBlogs::where('userId',Auth::user()->id)->get() as $blog)
                                                        <option id="">{{$blog->blogName}}</option>
                                                    @endforeach
                                                </select>

                                            </fieldset>
                                        </div>
                                    </div>

                                    <div style="padding-left: 10px">
                                        <div style="display: none;" id="msgBox" class="form-group">
                                            <div class="box box-info">
                                                <div id="loading">
                                                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                                                    <b>Please wait ...</b>
                                                </div>
                                                <div id="returnMsg" class="box-body">
                                                    <br>

                                                    <span id="fbMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-facebook"></i> Successfully wrote on facebook Page</span>

                                                    <span id="fbgMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-facebook"></i> Successfully wrote on facebook Group</span>

                                                    <span id="twMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-twitter"></i> Successfully wrote on twitter</span>

                                                    <span id="iMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-instagram"></i> Successfully Posted on Instagram</span>

                                                    <span id="wpMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-wordpress"></i> Successfully wrote on wordpress</span>
                                                    <span id="skypeMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-skype"></i> Successfully sent to skype</span>

                                                    <span id="tuMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-tumblr"></i> Successfully wrote on tumblr</span>

                                                    <span id="liMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-linkedin"></i> Successfully wrote on linkedin</span>

                                                    <span id="pinMsgSu" style="display: none"
                                                          class="label label-success"><i
                                                                class="fa fa-pinterest"></i> Successfully posted on Pinterest</span>

                                                    <span id="fbMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-facebook"></i> Error occurred while trying to write on facebook page</span>
                                                    <span id="fbgMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-facebook"></i> Error occurred while trying to write on facebook group</span>

                                                    <span id="twMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-twitter"></i> Error occurred while trying to write on twitter</span>

                                                    <span id="iMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-instagram"></i> Error occurred while trying to write on instagram</span>

                                                    <span id="wpMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-wordpress"></i> Error occurred while trying to write on wordpress</span>

                                                    <span id="skypeMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-skype"></i> Error occurred while trying to send messsage on skype</span>

                                                    <span id="tuMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-tumblr"></i> Error occurred while trying to write on Tumblr</span>

                                                    <span id="liMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-linkedin"></i> Error occurred while trying to write on Pinterest</span>

                                                    <span id="pinMsgEr" style="display: none"
                                                          class="label label-danger"><i
                                                                class="fa fa-pinterest"></i> Error occurred while trying to write on Pinterest</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div style="padding-right: 0px" class="col-md-4">
                                <a href="#" data-toggle="modal" data-target="#creatorModal"
                                   data-modal="#creatorModel"><img data-step="6"
                                                                   data-intro="Content creator. Click the box to create your own image content"
                                                                   width="100%" id="imgPreview"
                                                                   src="{{url('/images/placeholder.png')}}"> </a>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </div>

        @include('components.footer')
    </div>

    {{-- Content creator start --}}

    <div class="modal fade modal-fullscreen" id="creatorModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div style="background: #62696C" class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-xs btn-danger"
                            data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>

                    <div class="modal-body">

                        <div class="col-md-12">

                            <div class="col-md-4">
                                {{-- canvas properties --}}

                                <div class="box no-border">
                                    <form role="form">
                                        <div class="box-body">
                                            <div class="panel-group" id="accordion" role="tablist"
                                                 aria-multiselectable="true">

                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingTwo">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseTwo"
                                                               aria-expanded="false"
                                                               aria-controls="collapseTwo">
                                                                <i class="fa fa-paint-brush"></i> Draw
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo"
                                                         class="panel-collapse collapse"
                                                         role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="panel-body">
                                                            <label><input type="checkbox"
                                                                          id="enableDrawing">
                                                                Enable</label>
                                                            <input type="color" id="drawingColor">
                                                            <input type="text" value="10"
                                                                   id="drawingSize">
                                                            <input type="button"
                                                                   class="btn btn-primary btn-xs"
                                                                   value="Done" id="drawingChange">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseThree"
                                                               aria-expanded="false"
                                                               aria-controls="collapseThree">
                                                                <i class="fa fa-image"></i> Add Image
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree"
                                                         class="panel-collapse collapse"
                                                         role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            <input class="form-control" type="file"
                                                                   id="imageLoader"
                                                                   name="imageLoader"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseFour"
                                                               aria-expanded="false"
                                                               aria-controls="collapseThree">
                                                                <i class="fa fa-font"></i> Add Text
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFour"
                                                         class="panel-collapse collapse"
                                                         role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            Text <input type="text" value="Hellow world"
                                                                        id="cText"><br>
                                                            Select color <input type="color"
                                                                                id="cTextColor"><br>
                                                            Size <input type="text" id="cTextSize"
                                                                        value="30"><br>
                                                            <input type="button" id="cTextAdd"
                                                                   value="Add text"
                                                                   class="btn btn-primary btn-xs">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseFive"
                                                               aria-expanded="false"
                                                               aria-controls="collapseThree">
                                                                <i class="fa fa-stop"></i> Add Rectangle
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFive"
                                                         class="panel-collapse collapse"
                                                         role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            Select Color <input type="color"
                                                                                id="rectColor"><br>
                                                            <input type="button" id="makeRect"
                                                                   value="Create"
                                                                   class="btn btn-xs btn-primary">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseSix"
                                                               aria-expanded="false"
                                                               aria-controls="collapseThree">
                                                                <i class="fa fa-circle-o"></i> Add
                                                                Circle
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseSix"
                                                         class="panel-collapse collapse"
                                                         role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            Select Color <input type="color"
                                                                                id="circleColor"><br>
                                                            <input type="button" id="makeCircle"
                                                                   value="Create"
                                                                   class="btn btn-xs btn-primary">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--<div class="panel panel-info">--}}
                                                {{--<div class="panel-heading" role="tab"--}}
                                                {{--id="headingThree">--}}
                                                {{--<h4 class="panel-title">--}}
                                                {{--<a class="collapsed" role="button"--}}
                                                {{--data-toggle="collapse"--}}
                                                {{--data-parent="#accordion"--}}
                                                {{--href="#collapseSeven"--}}
                                                {{--aria-expanded="false"--}}
                                                {{--aria-controls="collapseSeven">--}}
                                                {{--<i class="fa fa-th"></i> Library--}}

                                                {{--</a>--}}
                                                {{--</h4>--}}
                                                {{--</div>--}}
                                                {{--<div id="collapseSeven"--}}
                                                {{--class="panel-collapse collapse"--}}
                                                {{--role="tabpanel" aria-labelledby="headingThree">--}}
                                                {{--<div class="panel-body">--}}
                                                {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                {{--<div class="col-md-7">--}}
                                                {{--<input type="text" id="imageQuery"--}}
                                                {{--class="form-control">--}}
                                                {{--<input type="hidden" id="imageURL">--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-5">--}}
                                                {{--<a id="btnSearchImage"--}}
                                                {{--class="btn btn-block btn-primary"><i--}}
                                                {{--class="fa fa-search"></i> Search--}}
                                                {{--</a>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-12">--}}
                                                {{--<div id="showImages">--}}

                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}


                                                <div class="panel panel-primary">
                                                    <div class="panel-heading" role="tab"
                                                         id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse"
                                                               data-parent="#accordion"
                                                               href="#collapseOne"
                                                               aria-expanded="true"
                                                               aria-controls="collapseOne">
                                                                <i class="fa fa-file-o"></i> Background
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne"
                                                         class="panel-collapse collapse in"
                                                         role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <label for="cColor">Background Color</label>
                                                            <input type="color" id="cColor">
                                                            <button type="button" id="btnCColorChange"
                                                                    class="btn btn-primary btn-xs">
                                                                Change
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div id="canvas-container" style="padding-right: 0px;width: 500px"
                                     class="box no-border">

                                    <canvas height="600" width="500" id="c"></canvas>


                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="box no-border">
                                    <div class="box-body">
                                        {{--<input type="button" class="btn btn-danger btn-xs"--}}
                                        {{--value="Delete selected Object" id="delete">--}}
                                        <a id="delete" class="btn btn-app bg-red">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>

                                        <a id="moveUp" class="btn btn-app bg-blue">
                                            <i class="fa fa-arrow-up"></i> Move Up
                                        </a>

                                        <a id="moveDown" class="btn btn-app bg-blue">
                                            <i class="fa fa-arrow-down"></i> Move Down
                                        </a>

                                        <a id="moveTop" class="btn btn-app bg-blue">
                                            <i class="fa fa-circle"></i> Move Top
                                        </a>

                                        <a id="moveBottom" class="btn btn-app bg-blue">
                                            <i class="fa fa-circle-o"></i> Move Bottom
                                        </a>

                                        <a id="imageSaver" id="delete" class="btn btn-app bg-green">
                                            <i class="fa fa-download"></i> Download
                                        </a>

                                        <hr>


                                        <button type="button" id="createContent"
                                                class="btn btn-flat btn-success btn-block">
                                            <i class="fa fa-edit"></i> Create Content
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Content creator end--}}
    <div class="modal fade modal-fullscreen" id="contentListModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">X</span></button>
                    <h4 class="modal-title" id="myModalLabel">Created content list</h4>
                    <div class="modal-body">
                        <div id="contentList">

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>



    {{-- Select image modal for content creator --}}


    <div class="modal fade" id="showImageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <img width="100%" id="pImage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="useImage" type="button" class="btn btn-primary">Use This</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Content list start--}}




    {{-- Content List end--}}


    <div class="modal fade" id="scheduleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="box no-border">
                                    <div class="box-body">
                                        <p><b>Select Date & Time</b></p>
                                        <input class="form-control" type="text" placeholder="Select Date & Time"
                                               id="time">

                                        <br>
                                        <button id="saveschedule" class="btn btn-block btn-warning"><i
                                                    class="fa fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="box no-border">
                                    <div class="box-body">
                                        <p><b>Every : </b></p>
                                        <select id="days" class="form-control">
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                        </b><br>
                                        <p><b>At</b></p>

                                        <input class="form-control" type="text" placeholder="Select Time" id="time1">
                                        <br>

                                        <button id="saveScheduleDay" class="btn btn-block btn-warning"><i
                                                    class="fa fa-plus"></i> Add
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
@section('css')


    <style>

        /* .modal-fullscreen */
        .modal-fullscreen {

        }

        .modal-fullscreen .modal-content {

            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .modal-fullscreen .modal-dialog {
            margin: 0;
            margin-right: auto;
            margin-left: auto;
            width: 100%;
        }

        @media (min-width: 768px) {
            .modal-fullscreen .modal-dialog {
                width: 750px;
            }
        }

        @media (min-width: 992px) {
            .modal-fullscreen .modal-dialog {
                width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .modal-fullscreen .modal-dialog {
                width: 1170px;
            }
        }

    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.16/fabric.min.js"></script>
    <script>
        $(document).ready(function () {
//            content creator start
//==========================================


            var canvas = new fabric.Canvas('c', {
                backgroundColor: 'rgb(240,240,240)'
            });

//            change background color

            $('#btnCColorChange').click(function () {
                canvas.backgroundColor = $('#cColor').val();
                canvas.renderAll();
            });
//            Delete selected object


            function deleteObjects() {
                var activeObject = canvas.getActiveObject(),
                    activeGroup = canvas.getActiveGroup();
                if (activeObject) {
                    if (confirm('Are you sure?')) {
                        canvas.remove(activeObject);
                    }
                }
                else if (activeGroup) {
                    if (confirm('Are you sure?')) {
                        var objectsInGroup = activeGroup.getObjects();
                        canvas.discardActiveGroup();
                        objectsInGroup.forEach(function (object) {
                            canvas.remove(object);
                        });
                    }
                }
            }

            $("#delete").click(function () {
                canvas.isDrawingMode = false;
                deleteObjects();
            });

            $("#moveUp").click(function () {
                var activeObject = canvas.getActiveObject();
                canvas.bringForward(activeObject);
            });

            $("#moveDown").click(function () {
                var activeObject = canvas.getActiveObject();
                canvas.sendBackwards(activeObject);
            });

            $("#moveTop").click(function () {
                var activeObject = canvas.getActiveObject();
                canvas.bringToFront(activeObject);
            });

            $("#moveBottom").click(function () {
                var activeObject = canvas.getActiveObject();
                canvas.sendToBack(activeObject);
            });

            $("#useImage").click(function () {
                var imgURL = $("#pImage").attr('src');

                fabric.Image.fromURL(imgURL, function (img) {
                    isImageLoaded = true;
                    oImg = img.set({
                        scaleX: 0.2,
                        scaleY: 0.2
                    });
                    canvas.add(oImg);

                });


                $('#showImageModal').modal('toggle');
            });

//            enable/disable drawing mode

            $("#enableDrawing").change(function () {
                if (this.checked) {
                    canvas.isDrawingMode = true;
                } else {
                    canvas.isDrawingMode = false;
                }
            });

//            change drawing properties
            $('#drawingChange').click(function () {
                canvas.freeDrawingBrush.color = $('#drawingColor').val();
                canvas.freeDrawingBrush.width = $('#drawingSize').val();
            });

            $('#cTextAdd').click(function () {
                var newText = new fabric.Text($('#cText').val(), {
                    fontSize: $('#cTextSize').val(),
                    fill: $('#cTextColor').val()

                });

                canvas.add(newText);


            });

            $('#makeRect').click(function () {
                var rect = new fabric.Rect({
                    left: 100,
                    top: 100,
                    fill: $('#rectColor').val(),
                    width: 50,
                    height: 50

                });
                canvas.add(rect);
            });

            $('#makeCircle').click(function () {
                var circle = new fabric.Circle({
                    radius: 20, fill: $('#circleColor').val(), left: 100, top: 100
                });
                canvas.add(circle);
            });


//            save image

            function download(url, name) {
// make the link. set the href and download. emulate dom click
                $('<a>').attr({href: url, download: name})[0].click();
            }

            function downloadFabric(name) {
//  convert the canvas to a data url and download it.
                download(canvas.toDataURL(), name + '.png');
            }

            $('#imageSaver').click(function () {
                downloadFabric("content");
            });


            var imageLoader = document.getElementById('imageLoader');
            imageLoader.addEventListener('change', handleImage, false);

            function handleImage(e) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    var img = new Image();
                    img.onload = function () {
                        var imgInstance = new fabric.Image(img, {
                            scaleX: 0.2,
                            scaleY: 0.2
                        });
                        canvas.add(imgInstance);
                    }
                    img.src = event.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }

            $('#createContent').click(function () {
                var dataURL = canvas.toDataURL();
                $.ajax({
                    type: 'POST',
                    url: "{{url('/content/upload')}}",
                    data: {
                        imageData: dataURL
                    },
                    success: function (data) {
                        if (data['status'] == "success") {
                            $('#imgPreview').attr('src', '{{url('/uploads')}}/' + data['fileName']);
                            $('#image').val(data['fileName']);
                            $('#imagetype').prop('checked', true);
                            $('#creatorModal').modal('toggle');
                        } else {
                            alert(data);
                        }

                    },
                    error: function (data) {
                        alert("Something went wrong, Please check the console message");
                        console.log(data.responseText);
                    }
                });
            });

            $('#btnContentList').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{url('/content/list')}}',
                    data: {},
                    success: function (data) {
                        $('#contentList').html(data);
                    },
                    error: function (data) {
                        alert("Can't load Content list,Something went wrong, Please check console message");
                        console.log(data.responseText);
                    }
                });
            });


//========================================================================
//            Content creator end
            flatpickr("#time", {
                minDate: new Date(), // "today" / "2016-12-20" / 1477673788975
//                maxDate: "2017-12-20",
                enableTime: true,

                // create an extra input solely for display purposes
                altInput: true,
                altFormat: "F j, Y h:i K",
                @if(Auth::user()->timeFormat == 12)
                time_24hr: false
                @else
                time_24hr: true
                @endif
            });


            flatpickr("#time1", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });


            $('#caption').hide(200);
            $('#imgoption').hide(200);
            $('#desOption').hide(200);
            $('#linkoption').hide(200);

            $('#texttype').click(function () {

                $('#caption').hide(200);
                $('#imgoption').hide(200);
                $('#desOption').hide(200);
                $('#linkoption').hide(200);
            })

            $('#imagetype').click(function () {
                $('#imgoption').show(200);

                $('#desOption').hide(200);
                $('#linkoption').hide(200);
                $('#caption').hide(200);
            });

            $('#sharetype').click(function () {

                $('#caption').show(200);
                $('#imgoption').show(200);
                $('#desOption').show(200);
                $('#linkoption').show(200);
            });

            $('#dataTitle').on('input', function (e) {
                if ($('#sharetype').is(':checked')) {
                    if ($('#dataTitle').val().length == 0) {
                        $('.name').html('<span class="defaultName"></span>');
                    }
                    else {
                        $('.name').text($('#dataTitle').val());
                    }
                }


            });


            $('#description').on('input', function (e) {
                if ($('#description').val().length == 0) {
                    $('.description').html('<span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span><span class="defaultDescription"></span>');
                }
                else {
                    $('.description').html($('#description').val());
                }

            });


            $('#caption').on('input', function (e) {
                if ($('#caption').val().length == 0) {
                    $('.caption').html('<span class="defaultCaption"></span>');
                }
                else {
                    $('.caption').html($('#caption').val());
                }

            });

            var count = 0;
            setTimeout(
                function () {
                    if (count <= 3) {
                        $('.emojionearea-editor').bind("DOMSubtreeModified", function () {
                            if ($(this).text().length == 0) {
                                $('.message').html('<span class="defaultMessage"></span>');
                            }
                            else {
                                $('.message').html($(this).html());
                            }


                        });
                    }
                    count++;

                }, 1000);


        });

        $("#btnSearchImage").click(function () {
            $("#showImages").html("Please wait ...");
            $.ajax({
                url: '{{url('/search/image')}}',
                type: 'POST',
                data: {
                    'imageQuery': $('#imageQuery').val()
                },
                success: function (data) {
                    $("#showImages").html(data);
                },
                error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }
            })
        });


        // translate

        $('#translate').click(function () {
            $.ajax({
                type: 'POST',
                url: '{{url('/translate')}}',
                data: {
                    'text': $('#status').val(),
                    'lang': $('#lang').val()
                }, success: function (data) {
                    if (data.status == "success") {
                        $('.emojionearea-editor').html(data.content);
                        $('#status').val(data.content);
                    } else {
                        alert(data.error);
                    }

                }, error: function (data) {
                    alert("Something went wrong");
                    console.log(data.responseText);
                }

            });


        });



    </script>
@endsection

