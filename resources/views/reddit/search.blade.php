<table class="table table-bordered">
    <thead>
    <td>Title</td>
    <td>Time</td>
    <td><i style="color: green" class="fa fa-arrow-circle-up"></i> Ups</td>

    <td><i style="color: red" class="fa fa-arrow-circle-down"></i> Downs</td>
    <td>Url</td>
    </thead>
    <tbody>
    @foreach($data as $datum)
        <tr>
            <td><b>{{$datum['data']['title']}}</b></td>
            <td>{{\Carbon\Carbon::createFromTimestamp($datum['data']['created'])->diffForHumans()}}</td>
            <td><b style="color: green">{{$datum['data']['ups']}}</b></td>
            <td><b style="color: red"> {{$datum['data']['downs']}}</b></td>
            <td><a href="{{$datum['data']['url']}}" target="_blank">Click here</a></td>
        </tr>

    @endforeach
    </tbody>
</table>