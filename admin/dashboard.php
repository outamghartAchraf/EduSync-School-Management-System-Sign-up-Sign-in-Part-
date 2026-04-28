<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
  header("location: ../auth/login.php");
  exit;
}

if ($_SESSION['user']['role_id'] != 1) {
  header("location: ../auth/login.php");
  exit;
}

// total students
$sqlStudents = $pdo->query("SELECT COUNT(*) AS total_students FROM students");
$totalStudents = $sqlStudents->fetch(PDO::FETCH_OBJ);

// total teachers
$sqlTeachers = $pdo->query("
SELECT COUNT(*) AS total_teachers
FROM users u
JOIN roles r ON u.role_id = r.id
WHERE r.role_name = 'Professor'
");
$totalTeachers = $sqlTeachers->fetch(PDO::FETCH_OBJ);

// total courese
$sqlCourses = $pdo->query("SELECT COUNT(*) AS total_courses FROM courses");
$totalCourses = $sqlCourses->fetch(PDO::FETCH_OBJ);

// total classes
$sqlClasses = $pdo->query("SELECT COUNT(*) AS total_classes FROM classes");
$totalClasses = $sqlClasses->fetch(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduSync Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body class="bg-light">

  <div class="d-flex flex-column flex-md-row">

    <?php include 'sidebar.php'; ?>

    <main class="main-content container-fluid py-4">

      <div class="mb-4">
        <h2 class="fw-bold">Dashboard Overview</h2>
        <p class="text-muted">Welcome back, manage your school system efficiently.</p>
      </div>

      <div class="row g-3 mb-4">

        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted">Students</h6>
                <h3 class="fw-bold"><?= $totalStudents->total_students ?></h3>
              </div>
              <i class="bi bi-people fs-1 text-primary"></i>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted">Teachers</h6>
                <h3 class="fw-bold"><?= $totalTeachers->total_teachers ?></h3>
              </div>
              <i class="bi bi-person-badge fs-1 text-success"></i>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted">Courses</h6>
                <h3 class="fw-bold"><?= $totalCourses->total_courses ?></h3>
              </div>
              <i class="bi bi-journal-bookmark fs-1 text-info"></i>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card border-0 shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted">Classes</h6>
                <h3 class="fw-bold"><?= $totalClasses->total_classes ?></h3>
              </div>
              <i class="bi bi-building fs-1 text-warning"></i>
            </div>
          </div>
        </div>

      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
          <h5 class="mb-0">Students Distribution by Class</h5>
        </div>

        <div class="card-body p-0">
          <table class="table table-hover mb-0">

            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Total Students</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($classStats as $index => $row): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= $row->name ?></td>
                  <td>
                    <span class="badge bg-primary">
                      <?= $row->total_students ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>

          </table>
        </div>
      </div>

    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>