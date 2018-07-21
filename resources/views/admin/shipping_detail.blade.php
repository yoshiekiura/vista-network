@extends('master')
@section('site-title')
    Shipping Detail
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Shipping Detail</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tr>
                                                <th>Title</th>
                                                <td><b>Detail</b></td>
                                            </tr>
                                            <tr>
                                                <th>Order ID:</th>
                                                <td>{{$order_id}}</td>
                                            </tr>
                                            <tr>
                                                <th>User's Name:</th>
                                                <td><a href="{{route('user.view', $ship->ship_user->id)}}">{{$ship->ship_user->first_name}} {{$ship->ship_user->last_name}}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Product Name:</th>
                                                <td><a href="{{route('product.edit', $ship->ship_product->id)}}"> {{$ship->ship_product->title}}</a></td>
                                            </tr>

                                            <tr>
                                                <th>Product Price:</th>
                                                <td> {{$general->symbol}} {{$ship->ship_product->price}} </td>
                                            </tr>

                                            <tr>
                                                <th>Date Of Create</th>
                                                <td>  {{ date('g:ia \o\n l jS F Y', strtotime($ship->created_at)) }}</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <form class="form-horizontal" method="post" action="{{route('shipment.process', $ship->id)}}">
                                            {{csrf_field()}}
                                           <div class="form-body">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <strong class="col-md-12">Message To User (Email)</strong>
                                                           <hr>
                                                           <textarea class="form-control col-md-12" name="message" rows="5"></textarea>
                                                           <input type="hidden" name="order_id" value="{{$order_id}}">
                                                       </div>

                                                       <button type="submit" name="status" value="1" class="btn btn-success pull-left">Processed</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                                       <button type="submit" name="status" value="2" class="btn btn-info">Delivered</button>
                                                       @if($ship->status != 1)
                                                       <button type="submit" name="status"  value="3" class="btn red pull-right">Reject</button>
                                                       @endif
                                                   </div>
                                               </div>
                                           </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption font-white">
                                    <i class="icon-settings font-red-sunglo"></i>
                                    <span class="caption-subject bold uppercase">Shipping Address</span>

                                </div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            @foreach($address as $adr)
                                            <tr>
                                                <th>Client's Name</th>
                                                <td>{{ $adr->fname }}&nbsp;{{ $adr->lname }}</td>
                                            </tr>
                                            <tr>
                                                <th>Company</th>
                                                <td>{{ $adr->company }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td>{{ $adr->street_address }}</td>
                                            </tr>

                                            <tr>
                                                <th>City:</th>
                                                <td>{{ $adr->city }}</td>
                                            </tr>

                                            <tr>
                                                <th>Country</th>
                                                <td>{{ $adr->country }}</td>
                                            </tr>

                                            <tr>
                                                <th>Post Code</th>
                                                <td>  {{ $adr->post_code }}</td>
                                            </tr>
                                            @endforeach    
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });
    </script>
@endsection