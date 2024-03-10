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
                <a href="#intro" class="scrollto"><img src="assets/img/logoindex.png" alt="" title=""></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="/index">Home</a></li>
                    <li class="menu-active"><a href="#about">details of the event</a></li>
                    <li><a href="#speakers">Speakers</a></li>
                    <li><a href="#schedule">Schedule</a></li>
                    <li><a href="#venue">Venue</a></li>
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
                    <a href="/reservation">Show my reservation</a>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <img src="assets/images/{{ $event->image }}" class="card-img-top" alt="{{ $event->title }}">
                        <div class="card-body">
                            <h2 class="card-title">{{ $event->title }}</h2>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="posted-author">By: <a href="#">{{ $admin->name }}</a></div>
                                <div class="post-comments">Category: <a href="#">{{ $ctgr->name }}</a></div>
                            </div>
                            <p class="card-text">{{ $event->description }}</p>
                            <ul class="list-unstyled mb-4">
                                <li><i class="bi bi-geo-alt"></i> <strong>Location:</strong> {{ $event->location }}</li>
                                <li><i class="bi bi-calendar"></i> <strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</li>
                                <li><i class="bi bi-clock"></i> <strong>Time:</strong>
                                    {{ date('H:i', strtotime($event->time)) }}</li>
                                <li><i class="bi bi-hourglass-split"></i> <strong>Duration:</strong>
                                    {{ $event->duration }} min</li>
                                <li><i class="bi bi-people"></i> <strong>Number of Places:</strong>
                                    {{ $event->total_places }}</li>
                                <li><i class="bi bi-people"></i> <strong>Number of Places Remaining:</strong> <span
                                        class="badge bg-info">{{ $event->total_places - $event->total_reservations }}</span>
                                </li>
                            </ul>
                            <div class="text-center">
                                @if ($event->total_places - $event->total_reservations > 0)
                                    <input class="btn gradient-bg" type="submit" value="Reservation"
                                        data-bs-toggle="modal" data-bs-target="#AddEmail">
                                @else
                                    <p class="text-danger mt-3">No Places Remaining</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="blog-pagination">
                        <ul class="flex align-items-center">

                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <section id="contact" class="section-bg wow fadeInUp">

            <div class="container">

                <div class="section-header">
                    <h2>Contact Us</h2>
                    <p>Nihil officia ut sint molestiae tenetur.</p>
                </div>

                <div class="row contact-info">

                    <div class="col-md-4">
                        <div class="contact-address">
                            <i class="ion-ios-location-outline"></i>
                            <h3>Address</h3>
                            <address>A108 Adam Street, NY 535022, USA</address>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-phone">
                            <i class="ion-ios-telephone-outline"></i>
                            <h3>Phone Number</h3>
                            <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-email">
                            <i class="ion-ios-email-outline"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                    </div>

                </div>

                <div class="form">
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars" />
                                <div class="validation"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" data-rule="email"
                                    data-msg="Please enter a valid email" />
                                <div class="validation"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Subject" data-rule="minlen:4"
                                data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required"
                                data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>
        </section><!-- #contact -->

    </main>
    <div class="back-to-top flex justify-content-center align-items-center">
        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z" />
            </svg></span>
    </div>

    {{-- Modal Reservation $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ --}}
    <div class="modal fade" id="AddEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($user != null)
                        <form action="/create" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" value="{{ $event->id }}" name="event_id">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname"
                                    placeholder="Enter first name" required>
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname"
                                    placeholder="Enter last name" required>
                            </div>
                            <label for="lname" class="form-label">Email for ticket</label>
                            <div class="mb-3 form-check">
                                <input type="radio" class="form-check-input" id="existingEmail" name="email"
                                    value="{{ $user->email }}" required>
                                <label class="form-check-label" for="existingEmail">{{ $user->email }}</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="radio" class="form-check-input" id="newEmail" name="email"
                                    value="new" required>
                                <label class="form-check-label" for="newEmail">Add New Email</label>
                            </div>
                            <div class="mb-3" id="newEmailSection" style="display: none;">
                                <label for="new_email" class="form-label">New Email</label>
                                <input type="email" class="form-control" name="new_email" id="new_email"
                                    placeholder="Enter new email">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Reservation</button>
                            </div>
                        </form>
                    @else
                        <h3>You mest be to Register before resirving</h3>
                        <style>
                            .modal-footer .btn {
                                font-size: 0.875em;
                                /* Adjust the font size */
                                padding: 1em 1.5em;
                                /* Adjust the padding */
                            }
                        </style>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="/" type="submit" class="btn btn-primary">Register</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>



        <!--==========================
    Footer
  ============================-->
        <footer id="footer">
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
