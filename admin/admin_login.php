<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Admin Login</h4>
                    </div>
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div id="responseMsg" class="alert d-none"></div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script>
        $("#loginForm").on("submit", function (e) {
            e.preventDefault();

            const email = $("#email").val().trim();
            const password = $("#password").val().trim();

            $.ajax({
                type: "POST",
                url: "auth/login.php", // 🔄 Update path as needed
                data: { email, password },
                dataType: "json",
                success: function (response) {
                    const $msg = $("#responseMsg").removeClass("d-none alert-success alert-danger");

                    if (response.status === 1) {
                        $msg.addClass("alert-success").text(response.message);
                        setTimeout(() => {
                            window.location.href = "index.php"; // 🔁 redirect after success
                        }, 500);
                    } else {
                        $msg.addClass("alert-danger").text(response.message);
                    }
                },
                error: function () {
                    $("#responseMsg").removeClass("d-none").addClass("alert alert-danger").text("Server error. Please try again.");
                }


            });
        });
    </script>

</body>

</html>