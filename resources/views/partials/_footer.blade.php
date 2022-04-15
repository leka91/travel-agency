<div class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="footer-logo">
                    <a href="{{ route('pages.home') }}">
                        <img src="{{ asset('/images/logo.png') }}" alt="Get away Serbia">
                    </a>
                </div>
            </div> <!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="copyright">
                    <span>
                        Copyright &copy; {{ now()->year }} 
                        <a href="{{ route('pages.home') }}">
                            <strong>
                                {{ config('app.name') }}
                            </strong>
                        </a>
                    </span>
                </div>
            </div> <!-- /.col-md-4 -->
            <div class="col-md-4 col-sm-4">
                <ul class="social-icons">
                    <li>
                        <a href="#" class="fa fa-facebook" target="_blank"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-youtube-play" target="_blank"></a>
                    </li>
                    <li>
                        <a href="#" class="fa fa-instagram" target="_blank"></a>
                    </li>
                </ul>
            </div> <!-- /.col-md-4 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.site-footer -->