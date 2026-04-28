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

// get student and course data from database

$EnrollmentsState =  $pdo->query("
SELECT 
    enrollments.id,
    enrollments.status,
    students.student_number,
    users.firstname,
    users.lastname,
    courses.title AS course_title
FROM enrollments
JOIN students ON enrollments.student_id = students.id
JOIN users ON students.user_id = users.id
JOIN courses ON enrollments.course_id = courses.id
");


$studentState = $pdo->query("SELECT id, user_id FROM  students");
$students = $studentState->fetchAll(PDO::FETCH_OBJ);

$courseState = $pdo->query("SELECT id, title FROM courses");
$courses = $courseState->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync - Enrollments</title>

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
                <h2 class="page-title mb-1">Enrollments</h2>
                <p class="text-muted mb-0">Manage students course enrollments</p>
            </div>

            <button class="btn btn-dark shadow-sm px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addEnrollmentModal">
                <i class="bi bi-plus-circle me-1"></i> Add Enrollment
            </button>

        </div>

        <!-- ADD ENROLLMENT MODAL -->
        <div class="modal fade" id="addEnrollmentModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-link-45deg me-1"></i> Add New Enrollment
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body p-4">

                        <form method="POST">

                            <div class="row g-3">

                                <!-- Student -->
                                <div class="col-md-6">
                                    <label class="form-label">Student</label>

                                    <select name="student_id" class="form-select" required>
                                        <option value="">Select Student</option>

                                        <?php foreach ($students as $student): ?>
                                            <option value="<?= $student->id ?>">
                                                <?= $student->firstname . ' ' . $student->lastname ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Course -->
                                <div class="col-md-6">
                                    <label class="form-label">Course</label>

                                    <select name="course_id" class="form-select" required>
                                        <option value="">Select Course</option>

                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?= $course->id ?>">
                                                <?= $course->title ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-12">
                                    <label class="form-label">Status</label>

                                    <select name="status" class="form-select" required>
                                        <option value="active">Active</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                        name="add_enrollment"
                                        class="btn btn-dark w-100">
                                    Save Enrollment
                                </button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

        <!-- STATS -->
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h6 class="text-muted mb-1">Total Enrollments</h6>
                            <h3 class="fw-bold mb-0"> </h3>
                        </div>

                        <i class="bi bi-link-45deg fs-1 text-dark"></i>

                    </div>

                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <h5 class="mb-0 fw-bold">Enrollments List</h5>

                    <input type="text"
                           class="form-control search-box"
                           placeholder="Search enrollments...">

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Status</th>
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