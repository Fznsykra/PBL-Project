<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <style>

body {
    background-image: url('image/background.png');
    background-color: #fdb714;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    margin: 0;
}

    </style>
</head>

<body>


    <div class="container">
        <div class="row form-container">
            <div class="col-md-6 offset-md-6">
                <!--Form Login-->
                <h2>Login</h2>
                <form action="proses_login.php" method="POST" autocomplete="off">
                    <div class="mb-2 form-check">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-2 form-check">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-2 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="mb-2 form-check d-grid gap-2">
                        <button type="submit" class="btn btn-outline-warning rounded-pill">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>