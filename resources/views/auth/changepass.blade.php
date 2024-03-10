<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .card h2 {
            margin: 0 0 1rem 0;
            color: #333;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .button-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin: 5px 0;
            cursor: pointer;
        }

        .reset-btn {
            background-color: #ff8c00;
            color: white;
        }

        .back-btn {
            background-color: #ccc;
            color: #333;
        }

        a {
            text-decoration: none;
            color: rgb(0, 0, 0);
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="card">
        @if (session('msg'))
            <div class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true" data-delay="15000">
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

        <h2>RESET PASSWORD</h2>
        <form action="/resetpass" method="POST">
            @csrf
            <div class="input-group">
                <input type="password" placeholder="New Password">
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password">
            </div>
            <div class="button-group">
                <button type="submit" class="reset-btn btn-primary">Reset Password</button>
                <a class="" href="/">Back to login</a>
        </form>
    </div>
    </div>
</body>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-DEpEJyZkgAe5wS7iOTV5n9Tu5omN4tXtM/9dGGDtLHLrKhj+ZPz9w0xuGveQCq1Q" crossorigin="anonymous">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-VoPFnP+ARbL2WP4LTO3zvei+sLbq+ZRb/2XkA34BTKZI+1+21Q3tB1zzQ3O4XvG/" crossorigin="anonymous">
</script>


<script>
    $(document).ready(function() {
        $('.toast').toast('show');
    });
</script>

</html>
