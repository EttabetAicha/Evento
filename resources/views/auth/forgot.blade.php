<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="auth/fonts/icomoon/style.css">

    <link rel="stylesheet" href="auth/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="auth/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="auth/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-3fNDXXGWPHvKDfivz2EKlJTVqGh2byCzGwiG5ZYeDErk2d8pZ8CPCgK6YbJhugTdZFGISrITzpeV7pUy+c8hzA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Reset password</title>
</head>

<body>

    <div class="d-md-flex half">
        <div class="container">
            <div class="position-absolute" style="z-index: 999 ; width:100% ; margin-top:5vh">
                <div id="toast-container" aria-live="polite" aria-atomic="true" class="d-flex flex-column">
                    @if (session('msg'))
                        <div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true"
                            data-delay="15000">
                            <div class="toast-header">
                                <strong class="mr-auto">Error</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body" style="color: black">
                                {{ session('msg') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <div class="form-block mx-auto">
                        <div class="text-center mb-5">
                            <h3 class="text-uppercase">Get back your password</h3>
                        </div>
                       
                        <form action="/checkemail" method="post" class="custom-form">
                            @csrf
                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="your-email@gmail.com" id="username">
                            </div>
                            <input type="submit" value="Reset Password" class="btn btn-block py-2 btn-info">

                            <a href="/" class="back-to-login"><i class="fas fa-arrow-left"></i> Back to login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-VoPFnP+ARbL2WP4LTO3zvei+sLbq+ZRb/2XkA34BTKZI+1+21Q3tB1zzQ3O4XvG/" crossorigin="anonymous">
    </script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });
    </script>

    <!-- Your other scripts -->
    <script src="auth/js/jquery-3.3.1.min.js"></script>
    <script src="auth/js/popper.min.js"></script>
    <script src="auth/js/bootstrap.min.js"></script>
    <script src="auth/js/main.js"></script>
</body>

</html>
