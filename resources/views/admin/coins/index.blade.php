@extends('master')
@section('site-title')
    Coins
@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-010">
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
                <h3 class="page-title uppercase bold">Coins
                    <div class="pull-right">
                        <a class="btn blue-dark btn-md " data-toggle="modal" href="#basic">
                            <i class="fa fa-plus"></i>   ADD NEW
                        </a>
                    </div>
                </h3>

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue-dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Coins</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                Coin Name
                                            </th>
                                            <th>
                                                Coin Logo
                                            </th>
                                            <th>
                                                Min Coins
                                            </th>
                                            <th>Max Coins</th>
                                            <th>Rate</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coins as $coin)
                                            <tr id="row1">
                                                <td> <b>{{$coin->name}}</b></td>
                                                <td>
                                                    @if($coin->image == "")
                                                    <img style="height: 80px; width: 80px" src="{{asset('assets/images/coins/default_coin.jpg')}}">
                                                    @else 
                                                    <img style="height: 80px; width: 80px" src="{{asset('assets/images/coins/'.$coin->image)}}">
                                                    @endif
                                                </td>
                                                <td> {{$coin->min_coins}} </td>
                                                <td> {{$coin->max_coins}} </td>
                                                <td> {{$coin->rate . ' USD'}}</td>
                                                <td>
                                                    @if($coin->status == 1)
                                                        <span class="badge badge-info">Active</span>
                                                        @else
                                                        <span class="badge badge-danger">Deactive</span>
                                                    @endif
                                                    </td>
                                                <td><a class="btn blue-dark" data-toggle="modal" href="#editModal{{$coin->id}}">Edit </a></td>
                                            </tr>
                                            <div id="editModal{{$coin->id}}" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                        <h4 class="modal-title">Edit {{$coin->name}}</h4>
                                                    </div>
                                                    <form role="form" method="post" action="{{route('update.admin.coins', $coin->id)}}" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        {{method_field('put')}}
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Coin Image</label>
                                                                    <input class="form-control" type="file" name="image">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Coin Name</label>
                                                                    <input class="form-control text-capitalize" value="{{$coin->name}}" type="text" required name="name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Minimum Coin to Purchase ( {{$general->currency}} )</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control text-capitalize" value="{{$coin->min_coins}}" type="number" required name="min_coins">
                                                                        <span class="input-group-addon"> {{$general->currency}}</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Rate for 1 Coin</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control text-capitalize" placeholder="Rate" value="{{$coin->rate}}" type="text" required name="rate">
                                                                        <span class="input-group-addon"> {{$general->currency}}</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <label class="control-label">Status</label>
                                                                    <select class="form-control" name="status">
                                                                        <option  @if($coin->status == 1) selected @else   @endif value="1">Active</option>
                                                                        <option @if($coin->status == 0) selected @else   @endif value="0">Deactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="col-md-12">
                                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                                                <button type="submit" class="btn purple-intense"> Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div id="basic" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title">Add New Coin</h4>
                                        </div>
                                        <form class="form-horizontal" role="form" method="post" action="{{route('store.admin.coins')}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Coin Image</label>
                                                        <input class="form-control"  type="file" required name="image">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Coin Name</label>
                                                        <input class="form-control text-capitalize" placeholder="Method Name" type="text" required name="name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Minimum Coins Purchase</label>
                                                        <div class="input-group">
                                                            <input class="form-control text-capitalize" placeholder="Minimum Amount" type="number" required name="min_coins">
                                                            <span class="input-group-addon"> {{$general->currency}}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <label class="control-label">Rate for 1 Coin</label>
                                                        <div class="input-group">
                                                            <input class="form-control text-capitalize" placeholder="Rate" type="text" required name="rate">
                                                            <span class="input-group-addon">{{$general->currency}}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                                                <button type="submit" class="btn purple-intense"> Save</button>
                                            </div>
                                        </form>
                                    </div>

                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection