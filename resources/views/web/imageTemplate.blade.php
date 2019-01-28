{{--//        foreach ($images as $no => $src){--}}
{{--//            echo "<img src='".$src."'></img>";--}}
{{--//        }--}}
<ul class="timeline">
    @foreach($images as $no => $src)
        @if($src != "")
            <li>
                <i class="fa fa-image bg-green"></i>

                <div class="timeline-item">
                    <div class="timeline-body">
                        <img src="{{$src}}">
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-success btn-xs" href="{{$src}}" target="_blank"><i class="fa fa-download"></i> Image Download Link</a>
                        <a class="btn btn-default bg-blue-active btn-xs" target="_blank" href="http://www.facebook.com/sharer.php?u={{$src}}"><i class="fa fa-facebook"></i> Post to
                            Facebook</a>

                        <a class="btn btn-default bg-red btn-xs" target="_blank" href="https://pinterest.com/pin/create/button/?url=&media={{$src}}&description="><i class="fa fa-pinterest"></i> Share to Pinterest</a>


                    </div>
                </div>
            </li>
        @endif

    @endforeach

        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
</ul>

