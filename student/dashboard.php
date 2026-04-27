<?php
session_start();
include '../config/db.php';

 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduSync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background-color: #f8f9fa; }
        
        /* Sidebar styling */
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #0d6efd; /* Primary Color */
            color: white;
            min-height: 100vh;
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .sidebar .nav-link i { font-size: 1.2rem; margin-right: 10px; }

        /* Main Content area */
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar { position: relative; min-width: 100%; max-width: 100%; min-height: auto; }
            .main-content { margin-left: 0; width: 100%; }
            .d-flex-container { flex-direction: column; }
        }
    </style>
</head>
<body>

<div class="d-flex d-flex-container">
    <nav class="sidebar p-3 shadow">
        <div class="d-flex align-items-center mb-4 px-2">
            <i class="bi bi-mortarboard fs-3 me-2"></i>
            <span class="fs-4 fw-bold">EduSync</span>
        </div>
        <hr class="text-white-50">
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="#dashboard" class="nav-link active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#courses" class="nav-link">
                    <i class="bi bi-book"></i> My Courses
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#grades" class="nav-link">
                    <i class="bi bi-journal-check"></i> Grades
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#profile" class="nav-link">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#settings" class="nav-link">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
        </ul>
        
        <hr class="text-white-50">
        <div class="px-2">
            <div class="small mb-2 text-white-50 text-uppercase">Account</div>
            <a href="../auth/logout.php" class="nav-link text-warning p-0">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </nav>

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <h1 class="h3 fw-bold mb-0">Welcome,   </h1>
                <p class="text-muted mb-0">Here's your academic overview.</p>
            </div>
            <div class="d-flex align-items-center bg-white p-2 rounded shadow-sm">
                <i class="bi bi-person-circle fs-4 me-2 text-primary"></i>
                <span class="fw-semibold"> </span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Active Courses</p>
                            <h4 class="fw-bold mb-0">5</h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded"><i class="bi bi-book text-primary"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Current GPA</p>
                            <h4 class="fw-bold mb-0">3.85</h4>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded"><i class="bi bi-graph-up text-success"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Assignments</p>
                            <h4 class="fw-bold mb-0">12</h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded"><i class="bi bi-clipboard-check text-warning"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Attendance</p>
                            <h4 class="fw-bold mb-0">94%</h4>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded"><i class="bi bi-calendar-check text-info"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 fw-bold">Enrolled Courses</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
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
                                        <td style="width: 30%;">
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-success" style="width: 85%;"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success-subtle text-success">A-</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Physics 201</strong></td>
                                        <td>Prof. Johnson</td>
                                        <td>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-info" style="width: 72%;"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info-subtle text-info">B+</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 fw-bold">Upcoming Events</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="badge bg-primary-subtle text-primary p-2 rounded me-3"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <p class="mb-0 fw-semibold small">Math Midterm Exam</p>
                                <span class="text-muted extra-small">April 25, 2026</span>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="badge bg-warning-subtle text-warning p-2 rounded me-3"><i class="bi bi-file-earmark"></i></div>
                            <div>
                                <p class="mb-0 fw-semibold small">Physics Assignment</p>
                                <span class="text-muted extra-small">April 22, 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-3">
                    <h5 class="fw-bold mb-3">Quick Actions</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-primary btn-sm"><i class="bi bi-download"></i> Materials</button>
                        <button class="btn btn-outline-success btn-sm"><i class="bi bi-upload"></i> Submit</button>
                        <button class="btn btn-outline-info btn-sm"><i class="bi bi-chat"></i> Message</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>