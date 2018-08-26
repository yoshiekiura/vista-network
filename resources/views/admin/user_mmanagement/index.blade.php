@extends('master')
@section('site-title')
    User Management
@endsection
@section('style')
    <style>
        #imaginary_container{
            margin-top:20%; /* Don't copy this */
        }
        .stylish-input-group .input-group-addon{
            background: white !important;
        }
        .stylish-input-group .form-control{
            border-right:0;
            box-shadow:0 0 0;
            border-color:#ccc;
        }
        .stylish-input-group button{
            border:0;
            background:transparent;
        }
    </style>
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <h3 class="bold">
                User's List
            </h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box dark">
                        <div class="portlet-title">
                            <div class="caption uppercase bold"><i class="fa fa-search"></i> Search Users</div>
                        </div>
                        <div class="portlet-body table-responsive">
                            <div class="row">
                               <div class="col-md-12">
                                   <div class="col-md-6" style="margin-bottom: 5px">
                                       <form class="form-horizontal" method="GET" action="{{route('username.search')}}">

                                           <div class="input-group stylish-input-group">
                                               <input type="text" class="form-control" name="username" required placeholder="Search By Username" >
                                               <span class="input-group-addon">
                                                <button type="submit">
                                                    <span><i class="fa fa-search"></i></span>
                                                </button>
                                            </span>
                                           </div>
                                       </form>
                                   </div>

                                   <div class="col-md-6">
                                       <form class="form-horizontal" method="GET" action="{{route('email.search')}}">

                                           <div class="input-group stylish-input-group">
                                               <input type="email" class="form-control" name="email"  placeholder="Search By Email" required >
                                               <span class="input-group-addon">
                                                <button type="submit">
                                                    <span><i class="fa fa-search"></i></span>
                                                </button>
                                            </span>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @if (Session::has('not_found'))
                    <div class="col-md-12">
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-user"></i> User</div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h1 class="bold" style="color: red">{{ Session::get('not_found') }} <i class="fas fa-frown"></i></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else

                    <div class="col-md-12">
                        <p class="pull-right">
                        <!--    <a href="{{ route('export.users.list') }}" class="btn btn-default" target="_self"><i class="fas fa-cloud-download-alt"></i> Export CSV</a>
                            <a href="#" class="btn btn-info" target="_blank" data-toggle="modal" data-target="#myModal"><i class="fas fa-cloud-upload-alt"></i> Import CSV</a> -->
                            
                        </p>    
                    </div>    
                        
                    <div class="col-md-12">

                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-user"></i> User List</div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> Sl</th>
                                        <th> Name </th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th> Balance </th>
                                        <th> Details </th>
                                        <th> Notifications </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->first_name}} {{$data->last_name}}
                                                @if($data->paid_status == 1)
                                                    <span class="badge badge-primary">Premium User</span>
                                                @elseif($data->paid_status == 0)
                                                    <span class="badge badge-success">Free User</span>
                                                @elseif($data->status == 0)
                                                    <span class="badge badge-danger">Deactivated</span>
                                                @else
                                                    
                                                @endif
                                            </td>
                                            <td><b>{{$data->email}}</b></td>
                                            <td>{{$data->mobile}}</td>
                                            <td>{{$general->symbol}} {{$data->balance}}</td>
                                            <td>
                                                <a class="btn purple" href="{{route('user.view', $data->id)}}" title="view details"><i class="fas fa-desktop"></i></a>
                                            </td>
                                            <td>
                                                <a class="btn purple" href="{{route('user.notification.view', $data->id)}}" title="view notifications"><i class="fas fa-bell"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        {{$users->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

            </div>
            <!-- END PAGE CONTENT-->


            <!-- Modal start -->
            <div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModal Label">
                <!-- Modal content-->
                                            
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <strong class="modal-title"><i class="fas fa-cloud-upload-alt"></i> Import Excel</strong>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('import.users.list') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table cellpadding="5" border="0" style="width: 100%;">
                                <tr>
                                    <td><input type="file" name="import_file" required /></td>
                                    <td>
                                        <button class="btn btn-default">    
                                            Submit
                                        </button>
                                    </td>
                                </tr>
                            </table>            
                        </form>
                            

                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
            <!-- Modal ends -->
            
        </div>
    </div>
@endsection

