@extends('layouts.default')

@section('title', 'User Login')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">发送消息</div>
          <div class="panel-body">
          <form method="post" class="form-inline" action="/post/<?php echo $id;?>">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label class="sr-only" for="user_mobile">发给手机号</label>
                <input type="text" class="form-control" id="user_mobile" name="mobile" placeholder="手机号">
              </div>
              <div class="form-group">
                <label class="sr-only" for="short_message">消息</label>
                <input type="text" class="form-control" id="short_message" name="content" placeholder="消息">
              </div>
              <button type="submit" class="btn btn-default">发送</button>
            </form>
          </div>
        </div>
    </div>
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item active">消息列表</li>
        @foreach ($list as $row)
            @if ($id)
                <li class="list-group-item"><?php echo $row->content; ?></li>
            @else
                <li class="list-group-item"><a href="/list/<?php echo $row->id;?>"><?php echo $row->content; ?></a></li>
            @endif
        @endforeach
        </ul>
    </div>
</div>
@endsection
