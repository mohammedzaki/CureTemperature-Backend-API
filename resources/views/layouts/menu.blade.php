
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('deviceCategories*') ? 'active' : '' }}">
    <a href="{!! route('deviceCategories.index') !!}"><i class="fa fa-edit"></i><span>Device Categories</span></a>
</li>

<li class="{{ Request::is('devices*') ? 'active' : '' }}">
    <a href="{!! route('devices.index') !!}"><i class="fa fa-edit"></i><span>Devices</span></a>
</li>

<li class="{{ Request::is('deviceFeeds*') ? 'active' : '' }}">
    <a href="{!! route('deviceFeeds.index') !!}"><i class="fa fa-edit"></i><span>Device Feeds</span></a>
</li>

<li class="{{ Request::is('userDevices*') ? 'active' : '' }}">
    <a href="{!! route('userDevices.index') !!}"><i class="fa fa-edit"></i><span>User Devices</span></a>
</li>

<li class="{{ Request::is('userCates*') ? 'active' : '' }}">
    <a href="{!! route('userCates.index') !!}"><i class="fa fa-edit"></i><span>User Cates</span></a>
</li>

<li class="{{ Request::is('accounts*') ? 'active' : '' }}">
    <a href="{!! route('accounts.index') !!}"><i class="fa fa-edit"></i><span>Accounts</span></a>
</li>

