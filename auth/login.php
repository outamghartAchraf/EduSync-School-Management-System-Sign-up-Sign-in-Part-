<?php
session_start();
include '../config/db.php';

$messageError = '';
if (isset($_SESSION['messageError'])) {
    $messageError = $_SESSION['messageError'];
    unset($_SESSION['messageError']);
}

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['messageError'] = "email and password required";
        header("location: login.php");
        exit;
    }

    $sqlState = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $sqlState->execute([$email]);
    $user = $sqlState->fetch(PDO::FETCH_OBJ);


    if ($user && password_verify($password, $user->password)) {

        $_SESSION['user'] = [
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'role_id' => $user->role_id
        ];

        if ($user->role_id == 1) {
            header("location: ../admin/dashboard.php");
            exit;
        } else if ($user->role_id == 3) {
            header("location: ../student/dashboard.php");
            exit;
        }
    } else {

        $_SESSION['messageError'] = "Email ou mot de passe incorrect";
        header("location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-body-secondary vh-100 h-100 m-0 d-flex align-items-center">

    <div class="container h-100">
        <div class="row justify-content-center align-items-center w-100 h-100">
            <div class="col-12 col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-primary text-white p-4 p-lg-5 d-flex flex-column justify-content-center">
                            <span class="badge rounded-pill text-bg-light text-primary mb-3 w-auto">EduSync Portal</span>
                            <h1 class="h3 fw-bold mb-3">Welcome Back</h1>
                            <p class="mb-4">Log in to continue managing your school dashboard and student activities.</p>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2">- Secure account access</li>
                                <li class="mb-2">- Fast and simple login</li>
                                <li>- Built for daily school workflows</li>
                            </ul>
                        </div>

                        <div class="col-md-7 bg-white p-4 p-lg-5">
                            <h2 class="h4 fw-bold mb-1">Login</h2>
                            <p class="text-muted mb-4">Enter your credentials to continue.</p>

                            <?php if ($messageError): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($messageError) ?></div>
                            <?php endif; ?>

                            <form method="POST">

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email Address"  >
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"  >
                                </div>

                                <button type="submit" name="login" class="btn btn-primary btn-lg w-100">Login</button>

                            </form>

                            <p class="text-center text-muted mt-4 mb-0">
                                Don&apos;t have an account?
                                <a href="register.php" class="link-primary fw-semibold text-decoration-none">Create account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>