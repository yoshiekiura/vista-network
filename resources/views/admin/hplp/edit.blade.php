@extends('master')
@section('site-title')
    Hash Power Edit
@endsection
@section('style')
    <style>
        .btn, button {
            color: #fff;
            background-color: #09f;
            border: 1px solid #09f;
            text-align: center;
            display: inline-block;
            vertical-align: middle;
            white-space: nowrap;
            margin: 0.6em 0.6em .6em 0;
            padding: 0.35em .7em 0.4em;
            text-decoration: none;
            width: auto;
            position: relative;
            border-radius: 4px;
            user-select: none;
            outline: none;
            -webkit-transition: all, 0.25s, ease-in;
            -moz-transition: all, 0.25s, ease-in;
            transition: all, 0.25s, ease-in;
        }
        .btn:hover, button:hover {
            background-color: #ddd;
            color: #333;
            -webkit-transition: all, 0.25s, ease-in;
            -moz-transition: all, 0.25s, ease-in;
            transition: all, 0.25s, ease-in;
        }
        .btn:active, button:active {
            background-color: #ccc;
            box-shadow: 0 !important;
            top: 2px;
            -webkit-transition: background-color, 0.2s, linear;
            -moz-transition: background-color, 0.2s, linear;
            transition: background-color, 0.2s, linear;
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }

        input {
            border: 2px solid #eee;
            padding: 1em .25em;
            width: 96%;
            color: #999;
            border-radius: 4px;
        }

        .left, .right {
            display: table-cell;
            vertical-align: middle;
        }

        .left {
            width: 6em;
            min-width: 6em;
            padding-right: 1em;
        }
        .left img {
            width: 100%;
        }

        .img-holder {
            display: block;
            vertical-align: middle;
            width: 2em;
            height: 2em;
        }
        .img-holder img {
            width: 100%;
            max-width: 100%;
        }

        .file-wrapper {
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            position: relative;
        }
        .file-wrapper:hover .btn {
            background-color: #33adff !important;
        }

        .file-wrapper input {
            cursor: pointer;
            font-size: 100px;
            height: 100%;
            filter: alpha(opacity=1);
            -moz-opacity: 0.01;
            opacity: 0.01;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 9;
        }

    </style>

@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-list font-green"></i>
                                <span class="caption-subject font-green bold uppercase">Edit {{$product->title}} </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{route('hashpower.update', $product->id) }}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group ">
                                        <div class="col-md-12">

                                            <div class="col-md-12">
                                                <div class="description" style="width: 100%;border: 1px solid #ddd;padding: 10px;border-radius: 5px" >
                                                    <div class="row">
                                                        <div class="col-md-12" id="planDescriptionContainer">
                                                            @foreach($product->product as $image)
                                                                <input type="hidden" name="image_id[]" value="{{$image->id}}">
                                                            <div class="input-group" data-value="{{$image->id}}">
                                                                <div class="left">
                                                                    <img class="img-uploaded" id="preview1"  src="{{ asset('assets/images/hash/'.$image->image) }}" alt="your image" />
                                                                </div>
                                                                <div class="right">
                                                                    <input type="text" readonly class="img-path" placeholder="Product Image Path">
                                                                    <span class="file-wrapper">
                                                           <input type="file" name="image[]" id="imgInp" class="uploader pranto" data-preview="#preview1" />
                                                           <span class="btn btn-large btn-alpha">Product Image</span>
                                                           </span>
                                                                </div>

                                                                    <span class="input-group-btn">
                                                                         <button class="btn btn-danger margin-top-10 delete_desc" type="button" value="{{$image->id}}"><i class='fa fa-times'></i></button>
                                                                    </span>

                                                            </div>
                                                            @endforeach

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 text-right margin-top-10">
                                                            <button id="btnAddDescription" type="button" class="btn btn-sm grey-mint pullri">Add Product Image</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label class="control-label">Product Title</label>
                                                <input class="form-control " value="{{$product->title}}" type="text" required name="title">
                                            </div>
                                        </div>


                                            <div class="col-md-6">
                                                <label class="control-label">Price</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$product->price}}" required name="price" >
                                                    <span class="input-group-addon">{{$general->currency}}</span>
                                                </div>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <label class="control-label">Detail</label>
                                                <textarea class="form-control" name="description" >{!! $product->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="footer">
                                        <button type="submit" class="btn dark btn-block">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        var max = 1;
        $(document).ready(function () {
            $('.pranto').click(false);

            $("#btnAddDescription").on('click', function () {
                appendPlanDescField($("#planDescriptionContainer"));
            });
            $(document).on('click', '.delete_desc', function () {

                image = $(this).val();
                $.ajax({
                    type:'POST',
                    url:'{{route('image.delete')}}',
                    data:{
                        image: image,
                        _token : '{{ csrf_token() }}'
                    },
                    success:function(data){
                        console.log(data);
                        location.reload();
                    }
                });
            });
        });

        function appendPlanDescField(container) {
            max++;
            container.append(
                '<div class="col-md-12">'+
                '<div class="input-group">' +
                '<input type="hidden" name="image_id[]">' +
                '<div class="left">\n' +
                '<img class="img-uploaded" id="preview' + max + '" src="http://placehold.it/350x350?text=your+image" alt="your image" />\n' +
                '</div>\n' +
                '<div class="right">\n' +
                '<input type="text" readonly class="img-path" placeholder="Product Image Path">\n' +
                '<span class="file-wrapper">\n' +
                '<input type="file" name="image[]" id="imgInp" data-preview="#preview' + max + '" class="uploader" />\n' +
                '<span class="btn btn-large btn-alpha">Product Image</span>\n' +
                '</span>\n' +
                '</div>'+
                '<span class="input-group-btn">'+
                '<button class="btn btn-danger margin-top-10 delete_desc" type="button"><i class="fa fa-times"></i></button>' +
                '</span>' +
                '</div>'+
                '</div>'
            );
        }
    </script>

    <script>
        /*----------------------------------------
        Upload btn
        ------------------------------------------*/
        var SITE = SITE || {};

        SITE.fileInputs = function() {
            var $this = $(this),
                $val = $this.val(),
                valArray = $val.split('\\'),
                newVal = valArray[valArray.length-1],
                $button = $this.siblings('.btn'),
                $fakeFile = $this.siblings('.file-holder');
            if(newVal !== '') {
                $button.text('Photo Chosen');
                if($fakeFile.length === 0) {
                    $button.after('<span class="file-holder">' + newVal + '</span>');
                } else {
                    $fakeFile.text(newVal);
                }
            }
        };

        $('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var tmppath = URL.createObjectURL(event.target.files[0]);

                reader.onload = function (e) {
                    var preview = $(input).attr('data-preview');
                    $(preview).attr('src', e.target.result);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on('change', '.uploader', function(){
            readURL(this);
        });
    </script>
@endsection
