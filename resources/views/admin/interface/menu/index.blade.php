@extends('master')
@section('site-title')
    Menu
@endsection

@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="page-title uppercase bold"> Menu
                <a class="btn blue btn-md pull-right" data-toggle="modal" href="{{route('menu.create.admin')}}">
                    <i class="fa fa-plus"></i>   ADD NEW MENU
                </a>
            </h3>
            <hr>
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-06">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Menu List</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Serial </th>
                                    <th> Name </th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menu as $key => $data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->menu_name}}</td>
                                        <td><b>{{$data->title}}</b></td>
                                        <td>{!! $data->description !!}</td>
                                        <td>
                                            <a class="btn blue" href="{{route('edit.menu.admin', $data->id)}}"><i class="fas fa-pen-square"></i></a>
                                            <a class="btn red"  data-toggle="modal" href="#deleteModal{{$data->id}}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <div id="deleteModal{{$data->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h2 class="modal-title" style="color: red;">Are you sure?</h2>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                                <a type="submit" href="{{route('menu.delete', $data->id)}}" class="btn red" id="delete"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection