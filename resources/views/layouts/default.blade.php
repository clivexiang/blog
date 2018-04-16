<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'myapp') - myapp</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <!-- <header class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="col-md-offset-1 col-md-10">
          <a href="/" id="logo">aotu</a>
          <nav>
            <ul class="nav navbar-nav navbar-right">

              <li><a href="/help">帮助</a></li>
              <li><a href="#">登录</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header> -->
   @include('layouts._vheader')

    <div class="container">
 <div class="col-md-offset-1 col-md-10">
      @include('shared._messages')
      @yield('content')
       @include('layouts._vfooter')
        </div>
    </div>
  </body>
</html>
