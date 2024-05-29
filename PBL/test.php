<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your meta tags, link tags, and other head elements here -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your additional styles -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>

    <main id="main" class="main">
        <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded me-2" alt="...">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (place it before the closing </body> tag) -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Your additional scripts -->
        <script>
            // Initialize Bootstrap Toast
            var toastTrigger = document.getElementById('liveToastBtn');
            var toastLiveExample = document.getElementById('liveToast');

            if (toastTrigger) {
                toastTrigger.addEventListener('click', function () {
                    var toast = new bootstrap.Toast(toastLiveExample);

                    toast.show();
                });
            }
        </script>
    </main>

</body>

</html>
