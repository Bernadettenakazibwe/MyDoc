<?php
    session_start();
    require 'dbcon.php';
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Welcome</title>
</head>
<body style="background-image: url('assets/img/doc2.jpg'); background-size: cover;">


<div class="nav" style="background-color: #f4623a;">
        <div class="logo" >
            <p><a href="index.html" style="color: white;">MY DOC</a> </p>
        </div>

        <div class="right-links' 'ml-auto'" >

            <?php 
            include("php/config.php");
            if(!isset($_SESSION['valid'])){
             header("Location: index.php");
            }
            
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM tutorial .users WHERE Id=$id");


            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php? Id=$res_id'>Change Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn" style="color: white;">Log Out</button> </a>

        </div>
    </div>
    <!-- Welcome Heading -->
<div class="intro" style= "display: inline-block; padding-left: 50%; padding-top: 30px;  ">
<h1 class="btn btn-primary btn-xl " style= "display: inline-block; padding-left: 10px; background-color: #f4623a"><b> You are welcome</b></h1>
</div>


<div class="container-fluid" >
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0dcaf0;">
            <!-- Your sidebar content goes here -->
            <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

<!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="welcome1.php">
    <div class="sidebar-brand-icon rotate-n-15" >
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3" style="margin-top: 20px; color: white;">Your patients </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span style="color: white;">Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="patient-create.php" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span style="color: white;">Add Patients</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="edit.php" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span style="color: white;">Change Profile</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="php/logout.php" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span style="color: white;">Log out</span>
    </a>
   
</li>


        </nav>

        <!-- Main content area -->
        <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4" style=" margin-top: 5px; margin-right: 10px">

                <?php include('message.php'); ?>

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style=" margin-top: 5px; margin-left: 2px">
                                <h4>Patient Details
                                    <a href="patient-create.php" class="btn btn-primary float-end">Add Patient</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <!-- Your table content goes here -->
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
                                            include('dbcon.php'); 
                                            $query = "SELECT * FROM patients";
                                            $query_run = mysqli_query($con, $query);

                                            if(mysqli_num_rows($query_run) > 0)
                                            {
                                                foreach($query_run as $patient)
                                                {
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
                                                                <button type="submit" name="delete_patient" value="<?=$patient['id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                                else
                                                {
                                                    echo "<h5> No Record Found </h5>";
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



<!-- Include your scripts here -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
