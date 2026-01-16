<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (isset($_POST['send'])) {
   $name = $_POST['fullname'];
   $email = $_POST['email'];
   $contactno = $_POST['contactno'];
   $message = $_POST['message'];
   $sql = "INSERT INTO  tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
   $query = $dbh->prepare($sql);
   $query->bindParam(':name', $name, PDO::PARAM_STR);
   $query->bindParam(':email', $email, PDO::PARAM_STR);
   $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
   $query->bindParam(':message', $message, PDO::PARAM_STR);
   $query->execute();
   $lastInsertId = $dbh->lastInsertId();
   if ($lastInsertId) {

      echo '<script>alert("Query Sent. We will contact you shortly.")</script>';
   } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
   }
}

$pageTitle = "Blood Bank Donar Management System | Contact Us";

include_once('includes/header.php');
?>

<!-- banner 2 -->
<div class="inner-banner-w3ls">
   <div class="container">
   </div>
   <!-- //banner 2 -->
</div>
<!-- contact modern section -->
<div class="search-section-bg py-5">
   <div class="container">
      <div class="text-center mb-5">
         <span class="d-inline-block mb-2" style="font-size:2.5rem;color:#dc3545;"><i class="fas fa-envelope"></i></span>
         <h2 class="fw-bold mb-1" style="color:#dc3545;">Contact Us</h2>
         <p class="text-muted mb-0">We'd love to hear from you. Please fill out the form below.</p>
      </div>
      <div class="row justify-content-center">
         <div class="col-lg-8">
            <div class="card p-4">
               <h5 class="card-title text-center mb-4" style="color:#dc3545;">Get In Touch</h5>
               <form action="#" method="post">
                  <div class="row g-3 mb-3">
                     <div class="col-md-6">
                        <input type="text" class="form-control" id="name" name="fullname" placeholder="Your Name" required>
                     </div>
                     <div class="col-md-6">
                        <input type="tel" class="form-control" id="phone" name="contactno" placeholder="Phone Number" required>
                     </div>
                  </div>
                  <div class="mb-3">
                     <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address">
                  </div>
                  <div class="mb-3">
                     <textarea rows="5" class="form-control" id="message" name="message" placeholder="Your Message" maxlength="999" required></textarea>
                  </div>
                  <div class="d-grid">
                     <button type="submit" class="btn btn-danger px-4 py-2 fw-semibold shadow-sm rounded-pill" name="send">Send Message</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- //contact modern section -->
<?php include_once('includes/footer.php'); ?>
