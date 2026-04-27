<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<nav class="sidebar p-3 shadow">
    <a href="index.php" class="d-flex align-items-center mb-4 text-white text-decoration-none">
        <span class="fs-4 fw-bold">EduSync</span>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item">
            <a href="dashboard.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'dashboard.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="users.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'users.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>

        <li>
            <a href="roles.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'roles.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-shield-lock me-2"></i> Roles
            </a>
        </li>

        <li>
            <a href="students.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'students.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-person-video3 me-2"></i> Students
            </a>
        </li>

        <li>
            <a href="classes.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'classes.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-building me-2"></i> Classes
            </a>
        </li>

        <li>
            <a href="courses.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'courses.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-journal-bookmark me-2"></i> Courses
            </a>
        </li>

        <li>
            <a href="enrollments.php"
               class="nav-link px-3 py-2 rounded-2 <?= $currentPage == 'enrollments.php' ? 'bg-primary text-white' : 'text-white-50'; ?>">
                <i class="bi bi-journal-check me-2"></i> Enrollments
            </a>
        </li>

    </ul>

    <hr>

    <a href="../auth/logout.php" class="nav-link text-danger">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
</nav>