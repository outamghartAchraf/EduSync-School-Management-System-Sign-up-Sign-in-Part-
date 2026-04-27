<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<!-- MOBILE TOPBAR -->
<nav class="navbar navbar-dark bg-dark d-md-none px-3">
    
    <a href="dashboard.php" class="navbar-brand fw-bold">
        EduSync
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <span class="navbar-toggler-icon"></span>
    </button>

</nav>

<!-- MOBILE SIDEBAR -->
<div class="offcanvas offcanvas-start bg-dark text-white d-md-none" tabindex="-1" id="mobileSidebar">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold">EduSync</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        <ul class="nav nav-pills flex-column gap-2">

            <li>
                <a href="dashboard.php"
                   class="nav-link <?= $currentPage == 'dashboard.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="users.php"
                   class="nav-link <?= $currentPage == 'users.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </li>

 

            <li>
                <a href="classes.php"
                   class="nav-link <?= $currentPage == 'classes.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                    <i class="bi bi-building me-2"></i> Classes
                </a>
            </li>

            <li>
                <a href="courses.php"
                   class="nav-link <?= $currentPage == 'courses.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                    <i class="bi bi-journal-bookmark me-2"></i> Courses
                </a>
            </li>

            <li>
                <a href="enrollments.php"
                   class="nav-link <?= $currentPage == 'enrollments.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                    <i class="bi bi-journal-check me-2"></i> Enrollments
                </a>
            </li>

        </ul>

        <hr>

        <a href="../auth/logout.php" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>

    </div>
</div>

<!-- DESKTOP SIDEBAR -->
<nav class="sidebar p-3 shadow bg-dark d-none d-md-block">

    <a href="dashboard.php" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <span class="fs-4 fw-bold">EduSync</span>
    </a>

    <hr class="text-secondary">

    <ul class="nav nav-pills flex-column gap-2">

        <li>
            <a href="dashboard.php"
               class="nav-link px-3 py-2 <?= $currentPage == 'dashboard.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="users.php"
               class="nav-link px-3 py-2 <?= $currentPage == 'users.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>

 

        <li>
            <a href="classes.php"
               class="nav-link px-3 py-2 <?= $currentPage == 'classes.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-building me-2"></i> Classes
            </a>
        </li>

        <li>
            <a href="courses.php"
               class="nav-link px-3 py-2 <?= $currentPage == 'courses.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-journal-bookmark me-2"></i> Courses
            </a>
        </li>

        <li>
            <a href="enrollments.php"
               class="nav-link px-3 py-2 <?= $currentPage == 'enrollments.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-journal-check me-2"></i> Enrollments
            </a>
        </li>

    </ul>

    <hr class="text-secondary">

    <a href="../auth/logout.php" class="nav-link text-danger">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>

</nav>