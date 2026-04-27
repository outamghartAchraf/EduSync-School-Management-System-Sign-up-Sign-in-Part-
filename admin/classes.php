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
    <title>EduSync - Classes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="bg-light">

<div class="d-flex flex-column flex-md-row">

    <?php include 'sidebar.php'; ?>

    <div class="main-content">

        <!-- HEADER -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div>
                <h2 class="page-title mb-1">Classes</h2>
                <p class="text-muted mb-0">Manage school classes</p>
            </div>

            <button class="btn btn-warning shadow-sm px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addClassModal">
                <i class="bi bi-plus-circle me-1"></i> Add Class
            </button>

        </div>

        <!-- ADD CLASS MODAL -->
        <div class="modal fade" id="addClassModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-warning">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-building me-1"></i> Add New Class
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST">

                        <div class="modal-body p-4">

                            <div class="mb-3">
                                <label class="form-label">Class Name</label>

                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Enter class name"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Classroom Number</label>

                                <input type="text"
                                       name="classroom_number"
                                       class="form-control"
                                       placeholder="Enter classroom number"
                                       required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit"
                                    name="add_class"
                                    class="btn btn-warning">
                                Save Class
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <!-- STATS -->
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h6 class="text-muted mb-1">Total Classes</h6>
                            <h3 class="fw-bold mb-0"></h3>
                        </div>

                        <i class="bi bi-building fs-1 text-warning"></i>

                    </div>

                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <h5 class="mb-0 fw-bold">Classes List</h5>

                    <input type="text"
                           class="form-control search-box"
                           placeholder="Search classes...">

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Classroom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <!-- DATA HERE -->

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