<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
  role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="nav-link" href="{{ route('home') }}"><i class="la la-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-opencart"></i><span>Products</span></a>
          <ul class="dropdown-menu">
            <li data-menu=""><a class="dropdown-item" href="{{ route('shopping.user.index') }}" data-toggle="dropdown"><i class="la la-shopping-cart"></i>Buy Product</a></li>
            <li data-menu=""><a class="dropdown-item" href="{{ route('user.shopping.history') }}" data-toggle="dropdown"><i class="la la-credit-card"></i>My Orders</a></li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-sort"></i><span>Hash Power</span></a>
          <ul class="dropdown-menu">
            <li data-menu=""><a class="dropdown-item" href="{{ route('hp.user.index') }}" data-toggle="dropdown"><i class="la la-shopping-cart"></i>Buy Hash Power</a></li>
            <li data-menu=""><a class="dropdown-item" href="{{ route('hp.history') }}" data-toggle="dropdown"><i class="la la-credit-card"></i>HP Transactions</a></li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-btc"></i><span>Coins</span></a>
          <ul class="dropdown-menu">
            <li data-menu=""><a class="dropdown-item" href="{{ route('coins.index') }}" data-toggle="dropdown"><i class="la la-shopping-cart"></i>Buy/Sell Coins</a></li>
            <li data-menu=""><a class="dropdown-item" href="{{ route('coins.transactions') }}" data-toggle="dropdown"><i class="la la-copy"></i>Coins Transactions</a></li>
          <!--  <li data-menu=""><a class="dropdown-item" href="#" data-toggle="dropdown"><i class="la la-copy"></i>Transfer Coins</a></li> -->
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-pie-chart"></i><span>Marketing</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('binary.summery.index') }}" data-toggle="dropdown"><i class="la la-copy"></i>Binary Summary</a>
            </li>
            <li data-menu=""><a class="dropdown-item " href="{{ route('tree.index') }}" data-toggle="dropdown"><i class="la la-tree"></i>My Tree</a>
            </li> 
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('referral.index') }}" data-toggle="dropdown"><i class="la la-android"></i>My Referral</a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-dollar"></i><span>Income</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('ref.commision.index') }}" data-toggle="dropdown"><i class="la la-gift"></i>Referral Commission</a>
            </li>
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('hp.commision.index') }}" data-toggle="dropdown"><i class="la la-gift"></i>HP Commission</a>
            </li>
            <li data-menu=""><a class="dropdown-item" href="{{ route('bin.commision.index') }}" data-toggle="dropdown"><i class="la la-gift"></i>Binary Commission</a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-bank"></i><span>Finance</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('add.fund.index') }}" data-toggle="dropdown"><i class="la la-cc-visa"></i>Deposit Funds</a>
            </li>
            <li class="disabled" data-menu=""><a class="dropdown-item" href="{{ route('request.users_management.index') }}" data-toggle="dropdown"><i class="la la-cc-paypal"></i>Withdraw Funds</a>
            </li>
            <li class="disabled" data-menu=""><a class="dropdown-item" href="{{ route('fund.transfer.index') }}" data-toggle="dropdown"><i class="la la-retweet"></i>Transfer Funds</a>
            </li>
            <li class="disabled" data-menu=""><a class="dropdown-item" href="{{ route('transaction.history') }}" data-toggle="dropdown"><i class="la la-arrows-alt"></i>Fund Transactions</a>
            </li>
          </ul>
        </li>
        
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-suitcase"></i><span>Wallet</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('wallet') }}" data-toggle="dropdown"><i class="la la-suitcase"></i>My Wallet</a>
            </li>
          </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-support"></i><span>Support Ticket</span></a>
          <ul class="dropdown-menu">
            <li data-menu="">
              <a class="dropdown-item" href="{{ route('support.index.customer') }}" data-toggle="dropdown"><i class="la la-tags"></i>My Tickets</a>
            </li>
            <li class="disabled" data-menu=""><a class="dropdown-item" href="{{ route('add.new.ticket') }}" data-toggle="dropdown"><i class="la la-ticket"></i>New Ticket</a>
            </li>
          </ul>
        </li>
        
      </ul>
    </div>
  </div>