@extends('master')
@section('site-title')
    Shipment Management
@endsection
@section('style')

@endsection
@section('main-content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box dark">
                            <div class="portlet-title">
                                <div class="caption uppercase bold"><i class="fa fa-th"></i> Shipment Rejects</div>
                            </div>
                            <div class="portlet-body table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th> Sl</th>
                                        <th> User Name </th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>User Address</th>
                                        <th> Current Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ship as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{route('user.view', $data->ship_user->id)}}">
                                                    {{$data->ship_user->first_name}} {{$data->ship_user->last_name}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('product.edit', $data->ship_product->id)}}"> {{$data->ship_product->title}}</a>
                                            </td>
                                            <td>
                                                {{$data->ship_product->price}}
                                            </td>
                                            <td>
                                                <p>
                                                    Mobile: {{$data->mobile}},
                                                    Street: {{$data->street_address}},<br>
                                                    Post Code: {{$data->post_code}},
                                                    City: {{$data->city}},
                                                    Country: {{$data->country}}
                                                </p>
                                            </td>
                                            <td>
                                                @if($data->status == 3)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 text-center">{{$ship->links()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- END PAGE CONTENT-->
        </div>
    </div>
@endsection

