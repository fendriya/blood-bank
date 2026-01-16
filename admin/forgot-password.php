<?php
session_start();
include('includes/config.php');
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $newpassword = md5($_POST['newpassword']);
  $sql = "SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $con = "update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('Your Password succesfully changed');</script>";
  } else {
    echo "<script>alert('Email id or Mobile no is invalid');</script>";
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

  <title>BloodBank & Donor Management System | Forgot Password</title>
  <!-- Custom-Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body class="bg-danger bg-gradient d-flex align-items-center justify-content-center" style="min-height:100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-5">
        <div class="card shadow-lg rounded-4 border-0">
          <div class="card-body p-4">
            <h2 class="card-title text-center text-danger mb-4 fw-bold">Forgot Password</h2>
            <form method="post" name="chngpwd" onsubmit="return valid();">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" placeholder="Email Address" required name="email" id="email">
              </div>
              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control form-control-lg" name="mobile" id="mobile" placeholder="Mobile Number" required maxlength="10" pattern="[0-9]+">
              </div>
              <div class="mb-3">
                <label for="newpassword" class="form-label">New Password</label>
                <input class="form-control form-control-lg" type="password" name="newpassword" id="newpassword" placeholder="New Password" required />
              </div>
              <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input class="form-control form-control-lg" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required />
              </div>
              <button class="btn btn-danger w-100 py-2 fw-bold rounded-pill" name="submit" type="submit">Reset</button>
              <div class="text-end mt-2">
                <a href="index.php" class="link-danger text-decoration-underline">Sign in</a>
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
