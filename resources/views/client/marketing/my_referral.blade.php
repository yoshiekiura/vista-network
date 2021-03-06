@extends('home')

@section('content')

<div class="content-header row">
  <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title">My Referral</h3>
    <div class="row breadcrumbs-top">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Marketing</a></li>
          <li class="breadcrumb-item active">My Referral</li>
        </ol>
      </div>
    </div>
  </div>
</div>
        
<div class="content-body">

  <!-- Shopping cards section start -->
  <section id="shopping-cards">
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Member Referred By Me</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
              <td>
                  <button class="btn btn-sm round btn-info btn-glow"><i class="la la-user-plus font-medium-1"></i> Total: {{ $total }}</button>
              </td>
            </div>
          </div>
          <div class="card-content">
            <div class="table-responsive">
              <table class="table table-de mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Created On</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($ref as $key => $data)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                    <td>{{ $data->email }}</td>
                    @php    

                          $dt = $data->created_at;
                          $created_format = $dt->toFormattedDateString();

                    @endphp
                    <td>{{ $created_format }}</td>
                </tr>
                @endforeach  
                </tbody>
                <tfoot>
                  <tr>
                      <td colspan="8" class="text-center">{{ $ref->links() }}</td>
                  </tr>  
                </tfoot>  
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- // Shopping cards section end -->      
</div>
<br/><br/>
@endsection
