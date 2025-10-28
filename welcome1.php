<?php
session_start();
require 'dbcon.php';

// ✅ 1. Make sure user is logged in BEFORE sending any HTML
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

// ✅ 2. Get session id safely
$id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;

// ✅ 3. Validate the ID before running query
$res_Uname = $res_Email = $res_Age = $res_id = '';
if ($id > 0) {
    // ⚙️ Removed extra space before `.users`
    $query = mysqli_query($con, "SELECT * FROM tutorial.users WHERE Id=$id");

    if ($query && mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet">
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Welcome</title>
</head>

<body style="background-image: url('assets/img/doc2.jpg'); background-size: cover;">

<div class="nav" style="background-color: #f4623a;">
    <div class="logo">
        <p><a href="index.html" style="color: white;">MY DOC</a></p>
    </div>

    <div class="right-links ml-auto">
        <?php
        echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
        ?>
        <a href="php/logout.php"><button class="btn" style="color: white;">Log Out</button></a>
    </div>
</div>

<div class="intro" style="display: inline-block; padding-left: 50%; padding-top: 30px;">
    <h1 class="btn btn-primary btn-xl" style="background-color: #f4623a;">
        <b>Welcome, <?php echo htmlspecialchars($res_Uname); ?></b>
    </h1>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-gradient-primary sidebar sidebar-dark accordion" style="background-color: #0dcaf0;">
            <ul class="navbar-nav sidebar sidebar-dark accordion">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="welcome1.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3" style="color: white;">Your Patients</div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item active">
                    <a class="nav-link" href="index.html"><i class="fas fa-fw fa-tachometer-alt"></i>
                        <span style="color: white;">Home</span></a>
                </li>

                <hr class="sidebar-divider">

                <li class="nav-item"><a class="nav-link" href="patient-create.php"><i class="fas fa-fw fa-cog"></i><span style="color: white;">Add Patients</span></a></li>
                <li class="nav-item"><a class="nav-link" href="edit.php"><i class="fas fa-fw fa-cog"></i><span style="color: white;">Change Profile</span></a></li>
                <li class="nav-item"><a class="nav-link" href="php/logout.php"><i class="fas fa-fw fa-cog"></i><span style="color: white;">Log out</span></a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <?php include('message.php'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Patient Details
                                    <a href="patient-create.php" class="btn btn-primary float-end">Add Patient</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Diagnosis</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM patients";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $patient) {
                                                ?>
                                                <tr>
                                                    <td><?= $patient['id']; ?></td>
                                                    <td><?= $patient['name']; ?></td>
                                                    <td><?= $patient['email']; ?></td>
                                                    <td><?= $patient['phone']; ?></td>
                                                    <td><?= $patient['Diagnosis']; ?></td>
                                                    <td>
                                                        <a href="patient-view.php?id=<?= $patient['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                        <a href="patient-edit.php?id=<?= $patient['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                        <form action="code.php" method="POST" class="d-inline">
                                                            <button type="submit" name="delete_patient" value="<?= $patient['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No Record Found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
