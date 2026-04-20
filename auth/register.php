<?php
session_start();
include '../config/db.php';

$messageError = '';

if (isset($_POST['register'])) {
 

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-secondary">
    <div class="container py-4 py-md-5">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-success text-white p-4 p-lg-5 d-flex flex-column justify-content-center">
                            <span class="badge rounded-pill text-bg-light text-success mb-3 w-auto">EduSync Portal</span>
                            <h1 class="h3 fw-bold mb-3">Create Your Account</h1>
                            <p class="mb-4">Join EduSync to manage school activities with a simple and secure experience.</p>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2">- Fast registration</li>
                                <li class="mb-2">- Mobile friendly access</li>
                                <li>- Student and teacher ready</li>
                            </ul>
                        </div>

                        <div class="col-md-7 bg-white p-4 p-lg-5">
                            <h2 class="h4 fw-bold mb-1">Register</h2>
                            <p class="text-muted mb-4">Fill your details to continue.</p>



                            <form method="POST">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name">
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email Address">
                                </div>

                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                                </div>

                                <div class="mb-4">
                                    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password">
                                </div>

                                <button type="submit" name="register" class="btn btn-success btn-lg w-100">Create Account</button>
                            </form>

                            <p class="text-center text-muted mt-4 mb-0">
                                Already have an account?
                                <a href="login.php" class="link-success fw-semibold text-decoration-none">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>