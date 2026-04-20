<?php
session_start();
include '../config/db.php';

 
if (!isset($_SESSION['user_id'])) {
    header('location: ../auth/login.php');
    exit;
}

// Fetch admin info
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$admin = $stmt->fetch(PDO::FETCH_OBJ);

// Fetch system stats
$totalUsers = $pdo->query("SELECT COUNT(*) as count FROM users")->fetch(PDO::FETCH_OBJ)->count;
$totalStudents = $pdo->query("SELECT COUNT(*) as count FROM users WHERE role_id = 3")->fetch(PDO::FETCH_OBJ)->count;
$totalTeachers = $pdo->query("SELECT COUNT(*) as count FROM users WHERE role_id = 2")->fetch(PDO::FETCH_OBJ)->count;
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-body-secondary h-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shield-lock"></i> EduSync Admin
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
                        <a class="nav-link" href="#users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reports">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#settings">Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($admin->firstname ?? 'Admin') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#profile">Profile</a></li>
                            <li><a class="dropdown-item" href="#settings">Admin Settings</a></li>
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
                <h1 class="h3 fw-bold text-dark">Admin Dashboard</h1>
                <p class="text-muted">System overview and management center</p>
            </div>
        </div>

        <!-- Key Stats Row -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="card-text text-muted small mb-1">Total Users</p>
                                <h4 class="card-title fw-bold mb-0"><?= $totalUsers ?></h4>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people text-primary"></i>
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
                                <p class="card-text text-muted small mb-1">Students</p>
                                <h4 class="card-title fw-bold mb-0"><?= $totalStudents ?></h4>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-person-check text-success"></i>
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
                                <p class="card-text text-muted small mb-1">Teachers</p>
                                <h4 class="card-title fw-bold mb-0"><?= $totalTeachers ?></h4>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-person-badge text-info"></i>
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
                                <p class="card-text text-muted small mb-1">System Health</p>
                                <h4 class="card-title fw-bold mb-0">99%</h4>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-heart-pulse text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Management Row -->
        <div class="row g-3">
            <!-- Recent Users -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">Recent Users</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>John Smith</strong></td>
                                        <td>john.smith@example.com</td>
                                        <td><span class="badge bg-primary">Student</span></td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dr. Jane Doe</strong></td>
                                        <td>jane.doe@example.com</td>
                                        <td><span class="badge bg-info">Teacher</span></td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sarah Johnson</strong></td>
                                        <td>sarah.johnson@example.com</td>
                                        <td><span class="badge bg-primary">Student</span></td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Prof. Michael Brown</strong></td>
                                        <td>michael.brown@example.com</td>
                                        <td><span class="badge bg-info">Teacher</span></td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="#users" class="btn btn-sm btn-danger">Manage All Users</a>
                    </div>
                </div>
            </div>

            <!-- System Alerts & Notifications -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">System Alerts</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="alert alert-info mb-3" role="alert">
                                <i class="bi bi-info-circle"></i>
                                <strong class="ms-2">System Update</strong>
                                <p class="small mt-2">New security patches available</p>
                            </div>

                            <div class="alert alert-warning mb-3" role="alert">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong class="ms-2">Maintenance Scheduled</strong>
                                <p class="small mt-2">Database backup on April 25</p>
                            </div>

                            <div class="alert alert-success mb-3" role="alert">
                                <i class="bi bi-check-circle"></i>
                                <strong class="ms-2">All Systems Operational</strong>
                                <p class="small mt-2">99% uptime this month</p>
                            </div>

                            <div class="alert alert-info mb-0" role="alert">
                                <i class="bi bi-clock"></i>
                                <strong class="ms-2">Daily Backup Complete</strong>
                                <p class="small mt-2">Last backup: Today at 2:30 AM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Actions -->
        <div class="row g-3 mt-2">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="card-title mb-0 fw-bold">Management Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-danger">
                                <i class="bi bi-person-plus"></i> Add New User
                            </a>
                            <a href="#" class="btn btn-outline-danger">
                                <i class="bi bi-file-earmark-pdf"></i> Generate Reports
                            </a>
                            <a href="#" class="btn btn-outline-danger">
                                <i class="bi bi-shield-check"></i> View Audit Logs
                            </a>
                            <a href="#" class="btn btn-outline-danger">
                                <i class="bi bi-gear"></i> System Settings
                            </a>
                            <a href="#" class="btn btn-outline-danger">
                                <i class="bi bi-download"></i> Backup Database
                            </a>
                            <a href="#" class="btn btn-outline-danger">
                                <i class="bi bi-exclamation-octagon"></i> View Logs
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
