<div class="site-header">
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-10">
                    <div class="logo">
                        <a href="{{ route('pages.home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="travel html5 template" title="travel html5 template">
                        </a>
                    </div> <!-- /.logo -->
                </div> <!-- /.col-md-4 -->
                <div class="col-md-8 col-sm-6 col-xs-2">
                    <div class="main-menu">
                        <ul class="visible-lg visible-md">
                            <li class="{{ Request::is('/') ? 'active' : '' }}">
                                <a href="{{ route('pages.home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="{{ Request::is('tours') ? 'active' : '' }}">
                                <a href="{{ route('pages.tours') }}">
                                    Tours
                                </a>
                            </li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}">
                                <a href="{{ route('pages.about') }}">
                                    About Us
                                </a>
                            </li>
                            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                <a href="{{ route('pages.contact') }}">
                                    Contact
                                </a>
                            </li>
                        </ul>
                        <a href="#" class="toggle-menu visible-sm visible-xs">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div> <!-- /.main-menu -->
                </div> <!-- /.col-md-8 -->
            </div> <!-- /.row -->
        </div> <!-- /.main-header -->
        <div class="row">
            <div class="col-md-12 visible-sm visible-xs">
                <div class="menu-responsive">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ route('pages.home') }}">
                                Home
                            </a>
                        </li>
                        <li class="{{ Request::is('tours') ? 'active' : '' }}">
                            <a href="{{ route('pages.tours') }}">
                                Tours
                            </a>
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}">
                            <a href="{{ route('pages.about') }}">
                                About Us
                            </a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ route('pages.contact') }}">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div> <!-- /.menu-responsive -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.site-header -->