@extends('master')
@section('site-title')
    Hash Power - LP
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

        form {
            display: table;
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
            <h3 class="page-title uppercase bold"> Hash Power - Lay Away Program
                <a class="btn blue-dark btn-md pull-right" data-toggle="modal" href="#basicPranto">
                    <i class="fa fa-plus"></i>   ADD NEW
                </a>
            </h3>
            <hr>
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
                    <div class="portlet box blue-dark">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-road"></i>Product
                            </div>
                            <div class="tools">
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-scrollable table-bordered table-hover" id="awards">
                                    <thead>
                                    <tr>
                                        <th> Serial </th>
                                        <th> Product Name </th>
                                        <th width="50%">Image</th>
                                        <th style="text-align: center"> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->title}}</td>

                                            <td>
                                                @foreach($data->product as $image)
                                                    <img height="80px" src="{{ asset('assets/images/hash/'.$image->image) }}">
                                                @endforeach
                                            </td>

                                            <td>
                                                <a class="btn green-meadow" href="{{route('hashpower.edit', $data->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="btn red"  data-toggle="modal" href="#deleteModal{{$data->id}}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <div id="deleteModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">

                                            <form method="post" action="{{route('hashpower.delete', $data->id)}}">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h2 class="modal-title" style="color: red;">Are you sure?</h2>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                                        <button type="submit" class="btn red"><i class="fa fa-trash"></i>Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    {{$product->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="basicPranto" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Add New HP Product</h4>
                            </div>

                            <form class="form-horizontal" role="form" method="POST" action="{{route('hashpower.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group ">
                                    <div class="col-md-12">

                                           <div class="col-md-12">
                                               <div class="description" style="width: 100%;border: 1px solid #ddd;padding: 10px;border-radius: 5px" >
                                                   <div class="row">
                                                       <div class="col-md-12" id="planDescriptionContainer">
                                                           <div class="input-group">
                                                               <div class="left">
                                                                   <img class="img-uploaded" id="preview1" src="http://placehold.it/350x350" alt="your image" />
                                                               </div>
                                                               <div class="right">
                                                                   <input type="text" readonly class="img-path" placeholder="Product Image Path">
                                                                   <span class="file-wrapper">
                                                           <input type="file" name="image[]" id="imgInp" class="uploader" data-preview="#preview1" />
                                                           <span class="btn btn-large btn-alpha">Product Image</span>
                                                           </span>
                                                               </div>
                                                               <span class="input-group-btn">
                                                            <input class="btn btn-danger margin-top-10 delete_desc" type="button" value="Delete" ></span>
                                                           </div>
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
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label class="control-label">Product Title</label>
                                            <input class="form-control text-capitalize" placeholder="Product Name" type="text" required name="title">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                        <label class="control-label">Price</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="price" placeholder="Product Price" name="price" >
                                            <span class="input-group-addon">{{$general->currency}}</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label class="control-label">Detail</label>
                                            <textarea class="form-control" style="width: 470px; height: 100px;" name="description" placeholder=""></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                    <button type="submit" class="btn dark">Save</button>
                                </div>
                            </form>
                        </div>
                </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        var max = 1;
        $(document).ready(function () {
            $("#btnAddDescription").on('click', function () {
                appendPlanDescField($("#planDescriptionContainer"));
            });

            $(document).on('click', '.delete_desc', function () {
                $(this).closest('.input-group').remove();
            });
        });

        function appendPlanDescField(container) {
            max++;

            container.append(
                '<div class="col-md-12">'+
                '<div class="input-group">' +
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
