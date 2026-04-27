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
                                    <label class="form-label">Professor ID</label>

                                    <input type="number"
                                           name="prof_id"
                                           class="form-control"
                                           placeholder="Enter professor ID"
                                           required>
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
                            <h3 class="fw-bold mb-0"> </h3>
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