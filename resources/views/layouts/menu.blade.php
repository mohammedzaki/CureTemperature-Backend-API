
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('deviceCategories*') ? 'active' : '' }}">
    <a href="{!! route('deviceCategories.index') !!}"><i class="fa fa-edit"></i><span>Device Categories</span></a>
</li>

<li class="{{ Request::is('devices*') ? 'active' : '' }}">
    <a href="{!! route('devices.index') !!}"><i class="fa fa-edit"></i><span>Devices</span></a>
</li>

