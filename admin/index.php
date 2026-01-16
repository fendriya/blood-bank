<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM tbladmin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>BloodBank & Donor Management System | Admin Login</title>
	<!-- Custom-Files -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/fontawesome-all.css">
      <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-danger bg-gradient d-flex align-items-center justify-content-center" style="min-height:100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5">
        <div class="card shadow-lg rounded-4 border-0">
          <div class="card-body p-4">
            <h2 class="card-title text-center text-danger mb-4 fw-bold">Admin Login</h2>
            <form method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Your Username</label>
                <input type="text" placeholder="Username" name="username" id="username" class="form-control form-control-lg">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" placeholder="Password" name="password" id="password" class="form-control form-control-lg">
              </div>
              <button class="btn btn-danger w-100 py-2 fw-bold rounded-pill" name="login" type="submit">LOGIN</button>
              <div class="text-end mt-2">
                <a href="forgot-password.php" class="link-danger text-decoration-underline">Forgot Password?</a>
              </div>
            </form>
            <div class="text-center mt-4">
              <a href="../index.php" class="btn btn-outline-danger rounded-pill">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>