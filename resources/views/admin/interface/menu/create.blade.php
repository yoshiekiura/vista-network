@extends('master')
@section('site-title')
    Menu
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
                        <span class="caption-subject font-black bold uppercase">Add New Menu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form role="form"  method="POST" action="{{route('menu.post.admin')}}">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input type="text" class="form-control input-lg" name="menu_name" required placeholder="Menu Name">

                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control input-lg" name="title" required placeholder="Menu Title">
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group">
                                <label>Page Content</label>
                                <textarea name="description" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn blue btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection