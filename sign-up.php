<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (isset($_POST['submit'])) {
   $fullname = $_POST['fullname'];
   $mobile = $_POST['mobileno'];
   $email = $_POST['emailid'];
   $age = $_POST['age'];
   $gender = $_POST['gender'];
   $blodgroup = $_POST['bloodgroup'];
   $address = $_POST['address'];
   $message = $_POST['message'];
   $status = 1;
   $password = md5($_POST['password']);
   $ret = "select EmailId from tblblooddonars where EmailId=:email";
   $query = $dbh->prepare($ret);
   $query->bindParam(':email', $email, PDO::PARAM_STR);
   $query->execute();
   $results = $query->fetchAll(PDO::FETCH_OBJ);
   if ($query->rowCount() == 0) {
      $sql = "INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status,Password) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status,:password)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
      $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->bindParam(':age', $age, PDO::PARAM_STR);
      $query->bindParam(':gender', $gender, PDO::PARAM_STR);
      $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
      $query->bindParam(':address', $address, PDO::PARAM_STR);
      $query->bindParam(':message', $message, PDO::PARAM_STR);
      $query->bindParam(':status', $status, PDO::PARAM_STR);
      $query->bindParam(':password', $password, PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId) {
         echo "<script>alert('You have signup  Scuccessfully');</script>";
      } else {
         echo "<script>alert('Something went wrong.Please try again');</script>";
      }
   } else {
      echo "<script>alert('Email-id already exist. Please try again');</script>";
   }
}

$pageTitle = "Blood Bank Donar Management System | Sign Up";

?>

<?php include_once('includes/header.php'); ?>
<!-- banner 2 -->
<div class="inner-banner-w3ls">
   <div class="container">
   </div>
   <!-- //banner 2 -->
</div>
<!-- about -->
<!-- Styles moved to css/style.css -->
<section class="about py-5">
   <div class="container py-xl-5 py-lg-3">
      <div class="signup-card">
         <h5 class="text-center mb-4">Register Now</h5>
         <form action="#" method="post" name="signup" onsubmit="return checkpass();">
            <div class="form-group">
               <label>Full Name</label>
               <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
               <label>Mobile Number</label>
               <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
            </div>
            <div class="form-group">
               <label class="mb-2">Email Id</label>
               <input type="email" name="emailid" class="form-control" placeholder="Email Id">
            </div>
            <div class="form-group">
               <label class="mb-2">Age</label>
               <input type="text" class="form-control" name="age" id="age" placeholder="Age" required="">
            </div>
            <div class="form-group">
               <label class="mb-2">Gender</label>
               <select name="gender" class="form-control" required>
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
               </select>
            </div>
            <div class="form-group">
               <label class="mb-2">Blood Group</label>
               <select name="bloodgroup" class="form-control" required>
                  <?php $sql = "SELECT * from  tblbloodgroup ";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $cnt = 1;
                  if ($query->rowCount() > 0) {
                     foreach ($results as $result) { ?>
                        <option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
                  <?php }
                  } ?>
               </select>
            </div>
            <div class="form-group">
               <label>Address</label>
               <input type="text" class="form-control" name="address" id="address" required="true" placeholder="Address">
            </div>
            <div class="form-group">
               <label>Message</label>
               <textarea class="form-control" name="message" required></textarea>
            </div>
            <div class="form-group">
               <label>Password</label>
               <input type="password" class="form-control" name="password" id="password" required="">
            </div>
            <button type="submit" class="btn btn-primary submit mb-4" name="submit">Register</button>
            <p class="account-w3ls text-center pb-4">Already Registered?
               <a href="login.php">Sign in</a>
            </p>
         </form>
      </div>
   </div>
</section>
<!-- //about -->
<?php include_once('includes/footer.php'); ?>