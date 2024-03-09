<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheEvent - Bootstrap Event Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/venobox/venobox.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
    <style>
        #footer.fixed-top {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!--==========================
    Header
  ============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <!-- Uncomment below if you prefer to use a text logo -->
                <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
                <a href="#intro" class="scrollto"><img src="assets/img/logo.png" alt="" title=""></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/index">Home</a></li>
                    <li><a href="#about">details of the event</a></li>
                    <li><a href="#speakers">Speakers</a></li>
                    <li><a href="#schedule">Schedule</a></li>
                    <li class="menu-active"><a href="#venue">Reservation</a></li>
                    <li><a href="#hotels">Hotels</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#supporters">Sponsors</a></li>
                    <li><a href="#contact">Contact</a></li>
                    @if (Session::has('user_id'))
                        <li class="buy-tickets"><a href="/logout">Logout</a></li>
                    @else
                        <li class="buy-tickets"><a href="{{ url('login') }}">Login</a></li>
                    @endif

                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->

    <!--==========================
    Intro Section
  ============================-->


    <main id="main">

        <!--==========================
      About Section
    ============================-->
        <section id="about">

        </section>
        <br>
        <br>


        <!--==========================
      event Section
    ============================-->


    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ Session::get('success') }}
                <a href="/reservation" class="btn btn-success">Show My Reservations</a>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger text-center" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row mt-4">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Event Name</th>
                                <th scope="col">Date Event</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tickets PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservations as $res)
                                <tr>
                                    <td>{{ $res->title }}</td>
                                    <td>{{ $res->date }}</td>
                                    <td>
                                        @if ($res->status == 1 || $res->accepte == 0)
                                            <span class="badge bg-success">Complete</span>
                                        @elseif($res->status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Reject</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if ($res->status == 1 || $res->accepte == 0)
                                            <a href="/ticket/{{ $res->id }}/{{ $res->user_id }}" class="btn btn-primary">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">You don't have any reservations</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <!--==========================
    Footer
  ============================-->
    <footer id="footer" style="position: fixed;
        bottom: 0;
        width: 100%;">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-info">
                        <img src="assets/img/logo.png" alt="TheEvenet">
                        <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor
                            et
                            totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur
                            id
                            quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat
                            cumque.
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>

                        <div class="social-links">
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="assets/lib/jquery/jquery.min.js"></script>
    <script src="assets/lib/jquery/jquery-migrate.min.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/superfish/hoverIntent.js"></script>
    <script src="assets/lib/superfish/superfish.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/venobox/venobox.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Template Main Javascript File -->
    <script src="assets/js/main.js"></script>
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='js/circle-progress.min.js'></script>
    <script type='text/javascript' src='js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='js/custom.js'></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var existingEmailRadio = document.getElementById("existingEmail");
            var newEmailRadio = document.getElementById("newEmail");
            var newEmailSection = document.getElementById("newEmailSection");

            existingEmailRadio.addEventListener("change", function() {
                newEmailSection.style.display = "none";
            });

            newEmailRadio.addEventListener("change", function() {
                newEmailSection.style.display = "block";
            });
        });
    </script>



</body>

</html>
