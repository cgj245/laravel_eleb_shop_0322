<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('shops.index')}}"><span class="glyphicon glyphicon-book"></span>首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('shops.create')}}">商家注册 <span class="sr-only">(current)</span></a></li>

                <li><a href="{{route('shop_users.index')}}">我的商家账号</a></li>
                <li><a href="{{route('actions.index')}}">活动列表</a></li>
                <li><a href="{{route('orders.index')}}">订单管理</a></li>
                <li><a href="{{route('eventShops.index')}}">报名列表</a></li>
                <li><a href="{{route('events.index')}}">活动报名</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理  <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menu_cates.index')}}">菜品分类</a></li>
                        <li><a href="{{route('menus.index')}}">菜品信息</a></li>
                        <li><a href="{{route('menuCount')}}">菜品销量统计</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form  class="navbar-form navbar-left" action=""   role="search">
                <div class="form-group">
                    <input type="text" name="keyword" class="form-contro" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>{{\Illuminate\Support\Facades\Auth::user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">点券</a></li>
                        <li><a href="{{route('shop_users.edit',[Auth::user()->id])}}">修改我的信息</a></li>
                        <li><a href="#">我的收藏</a></li>
                        <li role="separator" class="divider"></li>
                        <li> <form action="{{route('logout')}}" method="post" style="display:inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="btn btn-link">注销</button>
                        </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>