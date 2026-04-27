<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("location: ../auth/login.php");
    exit;
}

// check role
if ($_SESSION['user']['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit;
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync - Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

    <div class="d-flex flex-column flex-md-row">

        <?php include 'sidebar.php'; ?>

        <div class="main-content">

            <!-- HEADER -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h2 class="page-title mb-1">Users</h2>
                    <p class="text-muted mb-0">Manage system users and roles</p>
                </div>

                <button class="btn btn-primary shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus me-1"></i> Add User
                </button>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body pt-3">

                            <form method="POST">

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <input name="firstname" class="form-control" placeholder="First Name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input name="lastname" class="form-control" placeholder="Last Name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input name="email" class="form-control" placeholder="Email" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                                    </div>

                                    <div class="col-md-6">
                                        <select name="role_id" class="form-select" required>
                                            <option value="">Select Role</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <button name="add_user" class="btn btn-primary w-100 py-2">
                                            Save User
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- STATS -->
            <div class="row g-3 mb-4">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">

                            <div>
                                <h6 class="text-muted mb-2">Total Users</h6>
                                <h3 class="fw-bold mb-0"></h3>
                            </div>

                            <i class="bi bi-people text-primary stat-icon"></i>

                        </div>
                    </div>
                </div>

            </div>

            <!-- TABLE -->
            <div class="card">

                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <h5 class="mb-0 fw-bold">Users List</h5>

                        <input type="text" class="form-control search-box" placeholder="Search users...">

                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>