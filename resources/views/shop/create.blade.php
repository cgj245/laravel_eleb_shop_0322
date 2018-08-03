@extends('default')
@section('contents')
    {{--引入错误提示信息--}}
    @include('_errors')
    <form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data" style="width: 400px">
        <div>
        <h1>账号注册</h1>
        <div class="form-group">
            <label for="">名称 ：</label>
            <input class="form-control" type="text" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">邮箱 ：</label>
            <input class="form-control" type="text" name="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="">密码 ：</label>
            <input class="form-control" type="text" name="password" value="{{old('password')}}">
        </div>
            <div class="form-group">
                <label for="">确认密码 ：</label>
                <input class="form-control" type="text" name="repassword" value="{{old('repassword')}}">
            </div>

            <div class="form-group">
                <label for="">验证码 ：</label>
                <input id="captcha" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>

        </div>

        <div>
        <h1>店铺注册</h1>
        <div class="form-group">
            <label>商家名称:</label>
            <input type="text" class="form-control" name="shop_name" value="{{old('shop_name')}}" placeholder="请输入商家名称">
        </div>
        <div class="form-group">
            <label>分类ID:</label>
            <select name="shop_category_id" id="" class="form-control">
                @foreach($shop_categorys as $shop_category)
                    <option value="{{$shop_category->id}}">{{$shop_category->name}}</option>
                    @endforeach

            </select>
        </div>
        <div class="form-group">
            <label>店铺图片:</label>
            <input type="hidden" id="img" name="shop_img" value="">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>
            <img src="" id="img2" alt="" width="50px">
        <div class="form-group">
            <label>是否是品牌:</label>
            <label><input type="radio" name="brand" value="1" checked>是</label>
            <label><input type="radio" name="brand" value="0">否</label>
        </div>

        <div class="form-group">
            <label>是否准时配送:</label>
            <label><input type="radio" name="on_time" value="1" checked>是</label>
            <label><input type="radio" name="on_time" value="0">否</label>
        </div>
        <div class="form-group">
            <label>是否蜂鸟配送:</label>
            <label><input type="radio" name="fengniao" value="1" checked>是</label>
            <label><input type="radio" name="fengniao" value="0">否</label>
        </div>
        <div class="form-group">
            <label>是否保:</label>
            <label><input type="radio" name="bao" value="1" checked>是</label>
            <label><input type="radio" name="bao" value="0">否</label>
        </div>
        <div class="form-group">
            <label>是否票:</label>
            <label><input type="radio" name="piao" value="1" checked>是</label>
            <label><input type="radio" name="piao" value="0">否</label>
        </div>
        <div class="form-group">
            <label>是否准:</label>
            <label><input type="radio" name="zhun" value="1" checked>是</label>
            <label><input type="radio" name="zhun" value="0">否</label>
        </div>
        <div class="form-group">
            <label>起送金额:</label>
            <input type="text" name="start_send" value="{{old('start_send')}}" class="form-control" placeholder="请填写起送金额">
        </div>
        <div class="form-group">
            <label>配送费:</label>
            <input type="text" name="send_cost" value="{{old('send_cost')}}" class="form-control" placeholder="请填写配送费">
        </div>
        <div class="form-group">
            <label>店铺公告:</label>
            <textarea class="form-control" rows="4" placeholder="店铺公告" name="notice"></textarea>
        </div>
        <div class="form-group">
            <label>优惠信息:</label>
            <textarea class="form-control" rows="3" placeholder="优惠信息" name="discount"></textarea>
        </div>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block"> 注册</button>

    </form>
@stop
@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{route('upload')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            }
        });

        uploader.on( 'uploadSuccess', function( file,response) {
            // //给src赋值,赋的值就是图片的绝对地址
            $('#img2').attr('src',response.fileName);
            //写一个input(hidden)id设为img_url,图片上传成功后,就把图片的地址传到数据库保存
            $('#img').val(response.fileName);
        });


    </script>
@stop