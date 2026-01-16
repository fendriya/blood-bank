<?php error_reporting(0);
session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Blood Bank System'; ?></title>

    <!-- Custom-Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- //Web-Fonts -->
</head>

<body>
    <!-- header -->
    <header>
        <!-- header 2 -->
        <div id="home">
            <!-- navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 rounded-3" style="z-index:1000;">
                <div class="container">
                    <!-- logo -->
                    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php" style="font-size:1.7rem;">
                        <span style="color:#dc3545;">Blood</span><span style="color:#222;">Bank</span>
                        <i class="fas fa-syringe ms-2" style="color:#dc3545;"></i>
                    </a>
                    <!-- //logo -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="donor-list.php">Donor List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="contact.php">Contact us</a>
                            </li>
                            <?php if (strlen($_SESSION['bbdmsdid'] != 0)) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        My Account
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                                        <li><a class="dropdown-item" href="request-received.php">Request Received</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if (strlen($_SESSION['bbdmsdid'] == 0)) { ?>
                                <li class="nav-item">
                                    <a class="nav-link fw-semibold" href="admin/index.php">Admin</a>
                                </li>
                                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                    <a href="login.php" class="btn btn-danger px-4 py-2 fw-semibold shadow-sm rounded-pill">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- //navigation -->
        </div>
        <!-- //header 2 -->