@extends('layouts.default')

@section('title', 'User Login')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item active">消息列表</li>
        @foreach ($list as $row)
            <li class="list-group-item"><?php echo $row->content; ?></li>
        @endforeach
        </ul>
    </div>
</div>
@endsection
