<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (isset($_POST['send'])) {
    $cid = $_GET['cid'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $brf = $_POST['brf'];
    $message = $_POST['message'];
    $sql = "INSERT INTO  tblbloodrequirer(BloodDonarID,name,EmailId,ContactNumber,BloodRequirefor,Message) VALUES(:cid,:name,:email,:contactno,:brf,:message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':brf', $brf, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {

        echo '<script>alert("Request has been sent. We will contact you shortly.")</script>';
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}

?>

<?php include_once('includes/header.php'); ?>

<!-- banner 2 -->
<div class="inner-banner-w3ls">
    <div class="container">

    </div>
    <!-- //banner 2 -->
</div>

<!-- contact -->
<div class="agileits-contact py-5">
    <div class="py-xl-5 py-lg-3">
        <div class="w3ls-titles text-center mb-5">
            <h3 class="title">Contact For Blood</h3>
            <span>
                <i class="fas fa-user-md"></i>
            </span>
        </div>
        <div class="d-flex">
            <div class="col-lg-5 w3_agileits-contact-left">
            </div>
            <div class="col-lg-7 contact-right-w3l">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-danger bg-gradient text-white text-center py-3 border-0 rounded-top-4">
                        <h5 class="mb-1 fw-bold"><i class="fas fa-envelope me-2"></i>Fill following form for blood</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="#" method="post">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold"><i class="fas fa-user me-2 text-danger"></i>Your Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm" id="name" name="fullname" placeholder="Please enter your name.">
                                </div>
                                <div class="col-md-6">
                                    <label for="contactno" class="form-label fw-semibold"><i class="fas fa-phone me-2 text-danger"></i>Phone Number</label>
                                    <input type="tel" class="form-control form-control-lg rounded-3 shadow-sm" id="contactno" name="contactno" placeholder="Please enter your phone number.">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold"><i class="fas fa-envelope me-2 text-danger"></i>Email Address</label>
                                    <input type="email" class="form-control form-control-lg rounded-3 shadow-sm" id="email" name="email" required placeholder="Please enter your email address.">
                                </div>
                                <div class="col-md-6">
                                    <label for="brf" class="form-label fw-semibold"><i class="fas fa-users me-2 text-danger"></i>Blood Require For</label>
                                    <select class="form-select form-select-lg rounded-3 shadow-sm" id="brf" name="brf">
                                        <option value="">Blood Require For</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold"><i class="fas fa-comment me-2 text-danger"></i>Message</label>
                                    <textarea rows="5" class="form-control form-control-lg rounded-3 shadow-sm" id="message" name="message" placeholder="Please enter your message" maxlength="999" style="resize:none"></textarea>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-danger px-5 py-2 fw-bold rounded-pill shadow-lg" name="send">
                                        <i class="fas fa-paper-plane me-2"></i>Send Request
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //contact -->

<?php include_once('includes/footer.php'); ?>
