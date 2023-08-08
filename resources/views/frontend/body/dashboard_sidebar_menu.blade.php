
@php

$route = Route::current()->getName();
@endphp

<div class="col-md-3">
<div class="dashboard-menu">
<ul class="nav flex-column" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ ($route ==  'dashboard')? 'active':  '' }} "  href="{{ url('dashboard') }}" ><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($route ==  'user/order/page')? 'active':  '' }}" href="{{ url('user/order/page') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
    </li>

     <li class="nav-item">
        <a class="nav-link {{ ($route ==  'return/order/page')? 'active':  '' }}" href="{{url('return/order/page') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('user/track/order') }}" ><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#address" ><i class="fi-rs-marker mr-10"></i>My Address</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ ($route ==  'user/account/page')? 'active':  '' }}" href="{{ url('user.account.page') }}" ><i class="fi-rs-user mr-10"></i>Account details</a>
    </li>

      <li class="nav-item">
        <a class="nav-link {{ ($route ==  'user/change/password')? 'active':  '' }}" href="{{ url('user/change/password') }}" ><i class="fi-rs-user mr-10"></i>Change Password</a>
    </li>


    <li class="nav-item" style="background:#ddd;">
        <a class="nav-link" href="{{ url('user/logout') }}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
    </li>
</ul>
</div>
</div>