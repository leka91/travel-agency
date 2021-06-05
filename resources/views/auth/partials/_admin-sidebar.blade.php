<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="{{ Request::is('tours') ? 'active' : '' }}">
            <a href="{{ route('admin.tours') }}">
                Tours
            </a>
        </li>
    </ul>
</div>