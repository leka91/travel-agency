<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="{{ Request::is('tours') ? 'active' : '' }}">
            <a href="{{ route('admin.getAlltours') }}">
                Tours
            </a>
        </li>
        <li class="{{ Request::is('categories') ? 'active' : '' }}">
            <a href="{{ route('admin.categories') }}">
                Categories
            </a>
        </li>
        <li class="{{ Request::is('requirements') ? 'active' : '' }}">
            <a href="{{ route('admin.requirements') }}">
                Requirements
            </a>
        </li>
    </ul>
</div>