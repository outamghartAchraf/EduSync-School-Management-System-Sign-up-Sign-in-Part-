<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("location: ../auth/login.php");
    exit;
}

$userId = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_OBJ);

 
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-body-secondary h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-mortarboard"></i> EduSync
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#grades">Grades</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($user->firstname ?? 'Student') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#profile">Profile</a></li>
                            <li><a class="dropdown-item" href="#settings">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../auth/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 fw-bold text-dark">Welcome, <?= htmlspecialchars($user->firstname ?? 'Student') ?>!</h1>
                <p class="text-muted">Here's your academic overview for this term.</p>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="card-text text-muted small mb-1">Active Courses</p>
                                <h4 class="card-title fw-bold mb-0">5</h4>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-book text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="card-text text-muted small mb-1">GPA</p>
                                <h4 class="card-title fw-bold mb-0">3.85</h4>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-graph-up text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="card-text text-muted small mb-1">Assignments</p>
                                <h4 class="card-title fw-bold mb-0">12</h4>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-clipboard-check text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="card-text text-muted small mb-1">Attendance</p>
                                <h4 class="card-title fw-bold mb-0">94%</h4>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-calendar-check text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row g-3">
            <!-- Recent Courses -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">Enrolled Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Instructor</th>
                                        <th>Progress</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Mathematics 101</strong></td>
                                        <td>Dr. Smith</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">A-</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Physics 201</strong></td>
                                        <td>Prof. Johnson</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">72%</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">B+</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>English Literature</strong></td>
                                        <td>Ms. Williams</td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 68%;" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100">68%</div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning text-dark">B</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="#courses" class="btn btn-sm btn-primary">View All Courses</a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">Upcoming Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex gap-2 mb-3">
                                <div class="flex-shrink-0">
                                    <div class="badge bg-primary rounded-circle p-2">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">Math Midterm Exam</p>
                                    <small class="text-muted">April 25, 2026</small>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-3">
                                <div class="flex-shrink-0">
                                    <div class="badge bg-info rounded-circle p-2">
                                        <i class="bi bi-file-earmark"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">Physics Assignment Due</p>
                                    <small class="text-muted">April 22, 2026</small>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-3">
                                <div class="flex-shrink-0">
                                    <div class="badge bg-warning rounded-circle p-2">
                                        <i class="bi bi-chat-dots"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">Class Discussion Forum</p>
                                    <small class="text-muted">April 23, 2026</small>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <div class="flex-shrink-0">
                                    <div class="badge bg-success rounded-circle p-2">
                                        <i class="bi bi-presentation"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-1 fw-semibold">Project Presentation</p>
                                    <small class="text-muted">April 28, 2026</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="#events" class="btn btn-sm btn-outline-primary">View Calendar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-3 mt-2">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="bi bi-download"></i> Download Materials
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-upload"></i> Submit Assignment
                            </a>
                            <a href="#" class="btn btn-outline-info">
                                <i class="bi bi-chat-left-dots"></i> Contact Instructor
                            </a>
                            <a href="#" class="btn btn-outline-warning">
                                <i class="bi bi-question-circle"></i> Get Help
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
