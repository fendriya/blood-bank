<?php session_start();
error_reporting(0);
include_once('includes/config.php');
if (isset($_POST['login'])) {
   $email = $_POST['email'];
   $password = md5($_POST['password']);
   $sql = "SELECT id FROM tblblooddonars WHERE EmailId=:email and Password=:password";
   $query = $dbh->prepare($sql);
   $query->bindParam(':email', $email, PDO::PARAM_STR);
   $query->bindParam(':password', $password, PDO::PARAM_STR);
   $query->execute();
   $results = $query->fetchAll(PDO::FETCH_OBJ);
   if ($query->rowCount() > 0) {
      foreach ($results as $result) {
         $_SESSION['bbdmsdid'] = $result->id;
      }
      $_SESSION['login'] = $_POST['email'];
      echo "<script type='text/javascript'> document.location ='index.php'; </script>";
   } else {
      echo "<script>alert('Invalid Details');</script>";
   }
}

$pageTitle = "Blood Bank Donar Management System | Login";
?>
<?php include_once('includes/header.php'); ?>
<!-- banner 2 -->
<div class="inner-banner-w3ls">
   <div class="container">
   </div>
   <!-- //banner 2 -->
</div>
<!-- about -->
<section class="search-section-bg py-5">
   <div class="container py-xl-5 py-lg-3">
      <div class="row justify-content-center">
         <div class="col-md-7 col-lg-5">
            <div class="card search-form-card p-4">
               <div class="text-center mb-3">
                  <span class="d-inline-block mb-2" style="font-size:2.5rem;color:#dc3545;"><i class="fas fa-sign-in-alt"></i></span>
                  <h4 class="fw-bold mb-1" style="color:#dc3545;">Login</h4>
                  <p class="text-muted mb-0">Access your account</p>
               </div>
               <form action="#" method="post" name="login">
                  <div class="mb-3">
                     <label for="email" class="form-label fw-semibold">Email ID</label>
                     <input type="email" class="form-control rounded-pill px-3 py-2" name="email" id="email" placeholder="Enter your email" required>
                  </div>
                  <div class="mb-3">
                     <label for="password" class="form-label fw-semibold">Password</label>
                     <input type="password" class="form-control rounded-pill px-3 py-2" name="password" id="password" placeholder="Enter your password" required>
                  </div>
                  <div class="d-grid mb-3">
                     <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold shadow-sm rounded-pill" name="login">Login</button>
                  </div>
                  <p class="account-w3ls text-center pb-2" style="color:#000">
                     Don't have an account?
                     <a href="sign-up.php">Create one now</a>
                  </p>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- //about -->
<?php include_once('includes/footer.php'); ?>
