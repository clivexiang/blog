@extends('layouts.default')
@section('title', '注册')

@section('content')

<!-- <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1523621377877&di=0e61e1f1b79e3e21a696b6941fa93672&imgtype=0&src=http%3A%2F%2Fb3-q.mafengwo.net%2Fs10%2FM00%2F44%2F54%2FwKgBZ1h7JMaAc8PeAAFC76SybfM74.jpeg%3FimageView2%2F2%2Fw%2F600%2Fh%2F600%2Fq%2F90" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div> -->
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5>注册</h5>
    </div>
    <div class="panel-body">
       @include('shared._errors')
      <form method="POST" action="{{ route('users.store') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">注册</button>
      </form>
    </div>
  </div>
</div>
@stop
