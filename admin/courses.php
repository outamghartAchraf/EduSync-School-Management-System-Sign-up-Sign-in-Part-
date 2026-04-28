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

// get courses from database 

$sqlState = $pdo->prepare("SELECT courses.*, users.firstname AS prof_firstname, users.lastname AS prof_lastname
 FROM courses JOIN users ON courses.prof_id = users.id");
$sqlState->execute();
$courses = $sqlState->fetchAll(PDO::FETCH_OBJ);

// get professors for dropdown 
$profState = $pdo->prepare("SELECT users.id, users.firstname, users.lastname FROM users JOIN roles ON users.role_id = roles.id WHERE roles.role_name = 'Professor'");
$profState->execute();
$professors = $profState->fetchAll(PDO::FETCH_OBJ);

// add new course 
if(isset($_POST['add_course'])) {
    $title = $_POST['title'];
    $total_hours = $_POST['total_hours'];
    $prof_id = $_POST['prof_id'];

    $courseState = $pdo->prepare("INSERT INTO courses (title, total_hours, prof_id) VALUES (?, ?, ?)");
    $courseState->execute([$title, $total_hours, $prof_id]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// delete course 
if(isset($_POST['delete_course'])) {
    $course_id = $_POST['course_id'];
    $deletState = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $deletState->execute([$course_id]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync - Courses</title>
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
                    <h2 class="page-title mb-1">Courses</h2>
                    <p class="text-muted mb-0">Manage all school courses</p>
                </div>

                <button class="btn btn-info shadow-sm px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addCourseModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Course
                </button>

            </div>

            <!-- ADD COURSE MODAL -->
            <div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">

                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow">

                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title fw-bold">
                                <i class="bi bi-journal-plus me-1"></i> Add New Course
                            </h5>

                            <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal">
                            </button>
                        </div>

                        <div class="modal-body p-4">

                            <form method="POST">

                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Course Title</label>

                                        <input type="text"
                                            name="title"
                                            class="form-control"
                                            placeholder="Enter course title"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Total Hours</label>

                                        <input type="number"
                                            name="total_hours"
                                            class="form-control"
                                            placeholder="e.g. 40"
                                            required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>

                                        <textarea name="description"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Course description"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Professor </label>
                                       <select name="prof_id" class="form-select" required >
                                            <option value="" >Select a professor</option>
                                            <?php foreach ($professors as $professor): ?>
                                                <option value="<?= $professor->id ?>">
                                                    <?= $professor->firstname . ' ' . $professor->lastname ?>
                                                </option>
                                            <?php endforeach; ?>
                                       </select>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <button type="submit"
                                        name="add_course"
                                        class="btn btn-info w-100">
                                        Save Course
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
                                <h6 class="text-muted mb-1">Total Courses</h6>
                                <h3 class="fw-bold mb-0"> <?= count($courses) ?> </h3>
                            </div>

                            <i class="bi bi-journal-bookmark fs-1 text-info"></i>

                        </div>

                    </div>
                </div>

            </div>

            <!-- TABLE -->
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <h5 class="mb-0 fw-bold">Courses List</h5>

                        <input type="text"
                            class="form-control search-box"
                            placeholder="Search courses...">

                    </div>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Hours</th>
                                    <th>Professor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td><?= $course->id ?></td>
                                                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2"
                                                    style="width:35px; height:35px;">
                                                    <?= strtoupper(substr($course->title, 0, 1)); ?>
                                                </div>

                                                <span>
                                                    <?= $course->title; ?>
                                                </span>

                                            </div>
                                        </td>
                                        <td><?= $course->total_hours ?></td>
                                        <td><?= $course->prof_firstname . ' ' . $course->prof_lastname ?></td>
                                        <td>
                                      <form method="POST" class="d-inline">
                                            <input type="hidden" name="course_id" value="<?= $course->id ?>">
                                            <button type="submit" name="edit_course" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                      </form>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="course_id" value="<?= $course->id ?>">
                                            <button type="submit" name="delete_course" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>    

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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