<div class="box no-border">
    <div class="box-body">

        <h2>{{$rss->title}}</h2>
        <p>{{$rss->description}}</p>
        <a href="{{$rss->link}}" target="_blank"><img src="https://www.google.com/s2/favicons?domain={{$rss->link}}"> <i class="fa fa-link"></i> Link</a>
    </div>
</div>
<ul class="timeline">

    @foreach ($rss->item as $item)
    {{--echo 'Title: ', $item->title;--}}
    {{--echo 'Link: ', $item->link;--}}
    {{--echo 'Timestamp: ', $item->timestamp;--}}
    {{--echo 'Description ', $item->description;--}}
    {{--echo 'HTML encoded content: ', $item->{'content:encoded'};--}}

    <li>
        <i class="fa fa-rss bg-yellow"></i>

        <div class="timeline-item">


            <h3 class="timeline-header"><a target="_blank" href="{{$item->link}}">{{$item->title}}</a></h3>

            <div class="timeline-body">
                {{$item->description}}
            </div>
            <div class="timeline-footer">
                <a href="{{$item->link}}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-link"></i> Link</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{$item->link}}" target="_blank" class="btn btn-default bg-blue-active btn-xs"><i class="fa fa-facebook"></i> Share to Facebook</a>
                <a href="https://twitter.com/home?status={{$item->link}}" target="_blank" class="btn btn-default bg-blue btn-xs"><i class="fa fa-twitter"></i> Share to Twitter</a>
                <a href="https://plus.google.com/share?url={{$item->link}}" target="_blank" class="btn btn-default bg-red btn-xs"><i class="fa fa-google-plus"></i> Share to Google Plus</a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$item->link}}&title={{$item->title}}&summary={{$item->description}}&source={{$item->link}}" target="_blank" class="btn btn-default bg-light-blue btn-xs"><i class="fa fa-linkedin"></i> Share to Linkedin</a>
                <a href="http://www.reddit.com/submit?url={{$item->link}}" target="_blank" class="btn btn-default bg-gray btn-xs"><i class="fa fa-reddit"></i> Share to Reddit</a>
            </div>
        </div>
    </li>

    @endforeach
    <li>
        <i class="fa fa-clock-o bg-gray"></i>
    </li>
</ul>