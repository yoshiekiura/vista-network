    <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="sidebar-search-wrapper">
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/home')?:"";@endphp">
                <a href="{{url('admin/home')}}" class="nav-link nav-toggle">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            @php
                $url = Find_fist_int(request()->path());
            @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/general')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/terms')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/sms-api')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/template')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-desktop"></i>
                    <span class="title">Website Control</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/general' ) active open @endif">
                        <a href="{{route('general.index')}}" class="nav-link ">
                            <i class="fas fa-cog"></i>
                            <span class="title">General Settings</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/terms' ) active open @endif">
                        <a href="{{route('terms.polices')}}" class="nav-link ">
                            <i class="far fa-sticky-note"></i>
                            <span class="title">Policy/Terms</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/template' ) active open @endif">
                        <a href="{{route('email.index.admin')}}" class="nav-link ">
                            <i class="fas fa-envelope-open"></i>
                            <span class="title">Email Template</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/sms-api' ) active open @endif">
                        <a href="{{route('sms.index.admin')}}" class="nav-link ">
                            <i class="far fa-comments"></i>
                            <span class="title">SMS Api</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item  @if( request()->path() == 'admin/charge/commission' ) active open @endif">
                <a href="{{route('charge.commission')}}" class="nav-link ">
                    <i class="fas fa-money-bill-alt"></i>
                    <span class="title">Charge/Commision</span>
                </a>
            </li>


            <li class="nav-item start  @if( request()->path() == 'admin/testimonial' || request()->path() == "admin/testimonial_edit/$url" ) active open @endif
            @php echo "active",(request()->path() != 'admin/menu')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/menu/create')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/logo/icon')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/service')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/team')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/about')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/social/index')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/contact')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/footer')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/testimonial'  )?:"";@endphp
            @php echo "active",(request()->path() != 'admin/footer'  )?:"";@endphp
            @php echo "active",(request()->path() != 'admin/background/images'  )?:"";@endphp
            @php echo "active",(request()->path() != 'admin/tree/image'  )?:"";@endphp
            @php echo "active",(request()->path() != 'admin/slider')?:"";@endphp">

                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fab fa-internet-explorer"></i>
                    <span class="title">Website Interface </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/menu'  ) active open @endif
                    @if( request()->path() == 'admin/menu/create' ) active open @endif
                    @if( request()->path() == 'admin/menu/create' ) active open @endif
                    @if( request()->path() == "admin/menu_edit/$url" ) active open @endif">
                        <a href="{{route('menu.index')}}" class="nav-link ">
                            <i class="fas fa-bars"></i>
                            <span class="title">Menu</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/slider' ) active open @endif">
                        <a href="{{route('slide.settings')}}" class="nav-link ">
                            <i class="fas fa-images"></i>
                            <span class="title">Slider Image</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/logo/icon' ) active open @endif">
                        <a href="{{route('logo.icon')}}" class="nav-link ">
                            <i class="fas fa-file-image"></i>
                            <span class="title">Logo</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/service' ) active open @endif">
                        <a href="{{route('service.index')}}" class="nav-link ">
                            <i class="fab fa-servicestack"></i>
                            <span class="title">Service</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/team' ) active open @endif">
                        <a href="{{route('team.index')}}" class="nav-link ">
                            <i class="fas fa-sitemap"></i>
                            <span class="title">Team</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/contact' || request()->path() == "admin/contact" ) active open @endif">
                        <a href="{{route('contact.admin.index')}}" class="nav-link ">
                            <i class="fab fa-contao"></i>
                            <span class="title">Contact</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/about' || request()->path() == "admin/about" ) active open @endif">
                        <a href="{{route('about.admin.index')}}" class="nav-link ">
                            <i class="fab fa-buysellads"></i>
                            <span class="title">About</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/social/index' || request()->path() == "admin/social/index" ) active open @endif">
                        <a href="{{route('social.admin.index')}}" class="nav-link ">
                            <i class="fab fa-stripe-s"></i>
                            <span class="title">Social</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/footer' || request()->path() == "admin/footer" ) active open @endif">
                        <a href="{{route('footer.index.admin')}}" class="nav-link ">
                            <i class="fab fa-foursquare"></i>
                            <span class="title">Footer</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/testimonial' || request()->path() == "admin/testimonial_edit/$url" ) active open @endif">
                        <a href="{{route('testimonial.index')}}" class="nav-link ">
                            <i class="fas fa-comment-alt"></i>
                            <span class="title">Testimonial</span>
                        </a>
                    </li>

                    <li class="nav-item start @php echo "active",(request()->path() != 'admin/tree/image')?:"";@endphp">
                        <a href="{{route('user.tree.image')}}" class="nav-link nav-toggle">
                            <i class="fas fa-user-circle"></i>
                            <span class="title">Users Tree Image</span>
                        </a>
                    </li>

                    <li class="nav-item start @php echo "active",(request()->path() != 'admin/background/images')?:"";@endphp">
                        <a href="{{route('background.image.index')}}" class="nav-link nav-toggle">
                            <i class="far fa-file-image"></i>
                            <span class="title">Background Images</span>
                        </a>
                    </li>
                </ul>
            </li>

            @php $req = \App\WithdrawTrasection::where('status', 0)->count() @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/withdraw/method')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/withdraw/requests')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/withdraw/log')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="far fa-money-bill-alt"></i>
                    <span class="title">Withdraw System @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/method' ) active open @endif">
                        <a href="{{route('add.withdraw.method')}}" class="nav-link ">
                            <i class="fab fa-paypal"></i>
                            <span class="title">Withdraw Methods</span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/requests' ) active open @endif">
                        <a href="{{route('withdraw.request.index')}}" class="nav-link ">
                            <i class="fas fa-spinner"></i>
                            <span class="title">Withdraw Requests @if($req == 0)  @else<span class="badge badge-danger">{{$req}} @endif</span></span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/withdraw/log' ) active open @endif">
                        <a href="{{route('withdraw.viewlog.admin')}}" class="nav-link ">
                            <i class="fas fa-eye"></i>
                            <span class="title">View Log</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item  @if( request()->path() == 'admin/gateway' ) active open @endif">
                <a href="{{route('gateway.index')}}" class="nav-link ">
                    <i class="far fa-credit-card"></i>
                    <span class="title">Payment Gateways</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  @if( request()->path() == 'admin/add/fund/user' ) active open @endif">
                <a href="{{route('index.deposit.user')}}" class="nav-link ">
                    <i class="fab fa-cc-mastercard"></i>
                    <span class="title">Payment Log</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start {{ request()->path() == 'admin/users' || request()->path() == 'admin/users/detail/' ? "active" : "" }}">
                <a href="{{route('user.manage')}}" class="nav-link nav-toggle">
                    <i class="fas fa-users"></i>
                    <span class="title">Users Management</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/match')?:"";@endphp">
                <a href="{{route('match.index')}}" class="nav-link nav-toggle">
                    <i class="far fa-clone"></i>
                    <span class="title">Matching History</span>
                    <span class="selected"></span>
                </a>
            </li>

            @php $check_count = \App\Ticket::where('status', 1)->get() @endphp
            <li class="nav-item @if( request()->path() == 'admin/supports' || request()->path() == 'admin/supports' ) active open @endif
            @if( request()->path() == '' || request()->path() == '' ) active open @endif">
                <a href="{{route('support.admin.index')}}" class="nav-link nav-toggle">
                    <i class="fas fa-ticket-alt"></i>
                    <span class="title">Support @if(count($check_count) == 0)  @else <span class="badge badge-danger"> {{count($check_count)}} @endif </span></span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item @if( request()->path() == '' || request()->path() == '' ) active open @endif
            @if( request()->path() == '' || request()->path() == '' ) active open @endif">
                <a  data-toggle="modal" href="#basic" class="nav-link nav-toggle">
                    <i class="fas fa-sync-alt"></i>
                    <span class="title">GENERATE MATCHING</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item @if( request()->path() == '' || request()->path() == 'admin/product' ) active open @endif
            @if( request()->path() == '' || request()->path() == '' ) active open @endif">
                <a href="{{route('product.index')}}" class="nav-link nav-toggle">
                    <i class="fab fa-product-hunt"></i>
                    <span class="title">Product Managment</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/hash-power')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/hash-power/purchase/list')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/hash-power/users/balance')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-hashtag"></i>
                    <span class="title">Hash Power Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/hash-power' ) active open @endif">
                        <a href="{{route('hashpower.index')}}" class="nav-link ">
                            <i class="fab fa-500px"></i>
                            <span class="title">Hash Power Products </span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/hash-power/purchase/list' ) active open @endif">
                        <a href="{{route('hashpower.purchase.list')}}" class="nav-link ">
                            <i class="fas fa-table"></i>
                            <span class="title">HP Transactions  </span>
                        </a>
                    </li>
                    <li class="nav-item  @if( request()->path() == 'admin/hash-power/users/balance' ) active open @endif">
                        <a href="{{route('hashpower.users.balance')}}" class="nav-link ">
                            <i class="fas fa-balance-scale"></i>
                            <span class="title">HP Balances  </span>
                        </a>
                    </li>
                </ul>
            </li>

            @php 
                $now = \Carbon\Carbon::now();     
                $installments = \App\SchedulePayment::whereDate('due_date', '<=', $now)
                                                    ->where('status', 0)
                                                    ->count(); 
            
            @endphp
            <li class="nav-item start @php echo "active",(request()->path() != 'admin/orders/list')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/orders/list/installments')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/orders/commissions')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="title">Order Management <span class="badge badge-danger">{{ $installments != 0 ? $installments : '' }}</span></span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/orders/list' ) active open @endif">
                        <a href="{{route('orders.list')}}" class="nav-link ">
                            <i class="fas fa-chart-line"></i>
                            <span class="title">View Orders </span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/orders/list/installments' ) active open @endif">
                        <a href="{{route('orders.installment')}}" class="nav-link ">
                            <i class="fas fa-calendar-check"></i>
                            <span class="title">Installements <span class="badge badge-danger">{{ $installments != 0 ? $installments : '' }}</span></span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/orders/commissions' ) active open @endif">
                        <a href="{{route('commission')}}" class="nav-link ">
                            <i class="fab fa-gg"></i>
                            <span class="title">Commissions</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/coins')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/coins/purchase/list')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/coins/withdraw/list')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/coins/log')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/coins/balance')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fab fa-bitcoin"></i>
                    <span class="title">Coins Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/coins' ) active open @endif">
                        <a href="{{route('coins.admin.index')}}" class="nav-link ">
                            <i class="fas fa-th"></i>
                            <span class="title">View Coins </span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/coins/purchase/list' ) active open @endif">
                        <a href="{{route('coins.purchase.list')}}" class="nav-link ">
                            <i class="fas fa-check-circle"></i>
                            <span class="title">Coins Purchased</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/coins/withdraw/list' ) active open @endif">
                        <a href="{{route('coins.withdraw.list')}}" class="nav-link ">
                            <i class="fas fa-check-circle"></i>
                            <span class="title">Coins Withdraw</span>
                        </a>
                    </li>

                <!--    <li class="nav-item  @if( request()->path() == 'admin/coins/balance' ) active open @endif">
                        <a href="{{route('coins.balance')}}" class="nav-link ">
                            <i class="fas fa-check-circle"></i>
                            <span class="title">Coins Balance</span>
                        </a>
                    </li>  -->

                    <li class="nav-item  @if( request()->path() == 'admin/coins/log' ) active open @endif">
                        <a href="{{route('coins.viewlog.admin')}}" class="nav-link ">
                            <i class="fas fa-eye"></i>
                            <span class="title">Coins Logs</span>
                        </a>
                    </li>

                </ul>
            </li>

            @php $ship = \App\ProductShipment::where('status', 0)->count() @endphp

            <li class="nav-item start @php echo "active",(request()->path() != 'admin/shipment')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/shipment/complete')?:"";@endphp
            @php echo "active",(request()->path() != 'admin/shipment/reject')?:"";@endphp">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-truck"></i>
                    <span class="title">Shipment Orders @if($ship == 0)  @else<span class="badge badge-danger">{{$ship}}</span> @endif</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if( request()->path() == 'admin/shipment' ) active open @endif">
                        <a href="{{route('shipment.index')}}" class="nav-link ">
                            <i class="fas fa-spinner"></i>
                            <span class="title">Shipment Requests @if($ship == 0)  @else<span class="badge badge-danger">{{$ship}}</span> @endif</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/shipment/complete' ) active open @endif">
                        <a href="{{route('shipment.success.index')}}" class="nav-link ">
                            <i class="fas fa-check-circle"></i>
                            <span class="title">Delivered Product</span>
                        </a>
                    </li>

                    <li class="nav-item  @if( request()->path() == 'admin/shipment/reject' ) active open @endif">
                        <a href="{{route('shipment.reject')}}" class="nav-link ">
                            <i class="fas fa-times-circle"></i>
                            <span class="title">Rejected Request</span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>