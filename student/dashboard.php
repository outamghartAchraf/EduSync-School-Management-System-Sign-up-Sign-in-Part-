

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
                <a href="myprogramme.php" class="nav-link"><?php   header("myprogramme.php")  ?>
                    <i class="bi bi-book"></i> Mon Programme
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="mapromotion.php" class="nav-link"><?php   header("mapromotion.php")  ?>
                    <i class="bi bi-journal-check"></i> Mon promotion
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="profile.php" class="nav-link"><?php   header("profile.php")  ?>
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="details.php" class="nav-link"><?php   header("details.php")  ?>
                    <i class=""></i> Details
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