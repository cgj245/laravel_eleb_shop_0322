@extends('default')
@section('contents')
    {{--引入错误提示信息--}}
    @include('_errors')
    <form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data" style="width: 400px">

        <div class="form-group">
            <label>名称:</label>
            <input type="text" class="form-control" name="goods_name" value="{{old('goods_name')}}" placeholder="请输入名称">
        </div>
        <div class="form-group">
            <label>价格:</label>
            <input type="text" class="form-control" name="goods_price" value="{{old('goods_price')}}" placeholder="请输入价格">
        </div>

        <div class="form-group">
            <label>描述:</label>
            <textarea name="description" class="form-control"   rows="3">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <input class="form-control" type="hidden" name="shop_id" value="{{auth()->user()->shop_id}}">
        </div>

        <div class="form-group">
            <label>菜品分类:</label>
            <select name="category_id" id="" class="form-control">
                @foreach($menuCate as $value)
                <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>商品图片:</label>
            <input type="hidden" id="img" name="goods_img" value="">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>
        <img src="" id="img2" alt="">
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block"> 提交</button>

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