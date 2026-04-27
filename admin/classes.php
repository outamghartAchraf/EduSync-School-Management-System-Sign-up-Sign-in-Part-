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

// get classes from database
$sqlState = $pdo->query("SELECT * FROM classes");
$classes = $sqlState->fetchAll(PDO::FETCH_OBJ);

// delete class
if (isset($_POST['delete_class'])) {
    $class_id = $_POST['class_id'];
    $deleteStmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    $deleteStmt->execute([$class_id]);
    header("Location: classes.php");
    exit;
}

// add class 

if (isset($_POST['add_class'])) {
    $name = htmlspecialchars($_POST['name']);
    $classroom_number = htmlspecialchars($_POST['classroom_number']);

    $sql = $pdo->prepare("INSERT INTO classes (name, classroom_number) VALUES (?, ?)");
    $sql->execute([$name, $classroom_number]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;

}

// get class for editing 
$editClass = null ;
if(isset($_POST['edit_class'])) {
    $class_id = $_POST['class_id'];
    $sqlState = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
    $sqlState->execute([$class_id]);
    $editClass = $sqlState->fetch(PDO::FETCH_OBJ);

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync - Classes</title>

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
                    <h2 class="page-title mb-1">Classes</h2>
                    <p class="text-muted mb-0">Manage school classes</p>
                </div>

                <button class="btn btn-warning shadow-sm px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addClassModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Class
                </button>

            </div>

            <!-- ADD CLASS MODAL -->
            <div class="modal fade" id="addClassModal" tabindex="-1" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">

                        <div class="modal-header bg-warning">
                            <h5 class="modal-title fw-bold">
                                <i class="bi bi-building me-1"></i> Add New Class
                            </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form method="POST">

                            <div class="modal-body p-4">

                                <div class="mb-3">
                                    <label class="form-label">Class Name</label>

                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Enter class name"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Classroom Number</label>

                                    <input type="text"
                                        name="classroom_number"
                                        class="form-control"
                                        placeholder="Enter classroom number"
                                        required>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <button type="submit"
                                    name="add_class"
                                    class="btn btn-warning">
                                    Save Class
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

 <?php if($editClass): ?>
<div class="modal fade show" style="display:block; background:rgba(0,0,0,0.5);" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">
          <i class="bi bi-pencil"></i> Edit Class
        </h5>
        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn-close"></a>
      </div>

      <form method="POST">

        <div class="modal-body p-4">

          <input type="hidden" name="id" value="<?= $editClass->id ?>">

          <div class="mb-3">
            <label class="form-label">Class Name</label>
            <input type="text" name="name" class="form-control" value="<?= $editClass->name ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Classroom Number</label>
            <input type="text" name="classroom_number" class="form-control" value="<?= $editClass->classroom_number ?>" required>
          </div>

        </div>

        <div class="modal-footer">
          <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary">Cancel</a>
          <button type="submit" name="update_class" class="btn btn-warning">
            Update Class
          </button>
        </div>

      </form>

    </div>

  </div>
</div>
<?php endif; ?>           

            <!-- STATS -->
            <div class="row g-3 mb-4">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">

                        <div class="card-body d-flex justify-content-between align-items-center">

                            <div>
                                <h6 class="text-muted mb-1">Total Classes</h6>
                                <h3 class="fw-bold mb-0"><?php echo count($classes); ?></h3>
                            </div>

                            <i class="bi bi-building fs-1 text-warning"></i>

                        </div>

                    </div>
                </div>

            </div>

            <!-- TABLE -->
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                        <h5 class="mb-0 fw-bold">Classes List</h5>

                        <input type="text"
                            class="form-control search-box"
                            placeholder="Search classes...">

                    </div>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Classroom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($classes as $class): ?>
                                    <tr>
                                        <td><?= $class->id; ?></td>
                                        <td><?= $class->name; ?></td>
                                        <td><?= $class->classroom_number; ?></td>
                                        <td>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="class_id" value="<?= $class->id ?>" >
                                            <button type="submit" name="edit_class" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </form>

                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="class_id" value="<?= $class->id ?>">
                                                <button type="submit" name="delete_class" class="btn btn-sm btn-outline-danger">
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