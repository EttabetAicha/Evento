<header class="site-header">

    <?php $usercheck = session('user_id') ?>

    <div class="header-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-10 col-lg-2 order-lg-1">
                    <div class="site-branding">
                        <div class="site-title">
                            <a href="#"><img src="images/logo.png" alt="logo"></a>
                        </div><!-- .site-title -->
                    </div><!-- .site-branding -->
                </div><!-- .col -->

                <div class="col-2 col-lg-7 order-3 order-lg-2">
                    <nav class="site-navigation">
                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <ul>
                            <li><a href="/index">Home</a></li>
                            <li><a href="/reservation">My reservations</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav><!-- .site-navigation -->
                </div><!-- .col -->

                <div class="col-lg-3 d-none d-lg-block order-2 order-lg-3">
                    @if($usercheck == null)
                            <div class="buy-tickets">
                                <a class="btn gradient-bg" href="/">Register</a>
                            </div><!-- .buy-tickets -->
                    @else 
                            <div class="buy-tickets">
                                <a class="btn gradient-bg" href="/">Logout</a>
                            </div><!-- .buy-tickets -->
                    @endif
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .header-bar -->

    <div class="page-header events-news-page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="entry-header">
                        <h1 class="entry-title">Events news.</h1>
                    </header>
                </div>
            </div>
        </div>
    </div>
</header><!-- .site-header -->