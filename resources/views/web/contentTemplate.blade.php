<ul class="timeline">
    @foreach($output as $no => $content)
        @if($content != "")
            <li>
                <i class="fa fa-file-text bg-green"></i>

                <div class="timeline-item">
                    <div class="timeline-body">
                        <b>{{$content}}</b>
                    </div>
                    <div class="timeline-footer">

                    </div>
                </div>
            </li>
        @endif

    @endforeach

        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
</ul>