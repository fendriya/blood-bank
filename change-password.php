<?php
session_start();
error_reporting(0);
include_once('includes/config.php');

if (strlen($_SESSION['bbdmsdid']) == 0) {
	header('location:logout.php');
	exit();
}

if (isset($_POST['change'])) {
	$uid = $_SESSION['bbdmsdid'];
	$cpassword = md5($_POST['currentpassword']);
	$newpassword = md5($_POST['newpassword']);
	$sql = "SELECT ID FROM tblblooddonars WHERE id=:uid and Password=:cpassword";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uid', $uid, PDO::PARAM_STR);
	$query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);

	if ($query->rowCount() > 0) {
		$con = "update tblblooddonars set Password=:newpassword where id=:uid";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
		$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();

		echo '<script>alert("Your password successully changed")</script>';
	} else {
		echo '<script>alert("Your current password is wrong")</script>';
	}
}

$pageTitle = "Blood Bank Donar Management System | Change Password";

?>

<script type="text/javascript">
	function checkpass() {
		if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
			alert('New Password and Confirm Password field does not match');
			document.changepassword.confirmpassword.focus();
			return false;
		}
		return true;
	}
</script>
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
			<h3 class="title">Change Password</h3>
			<span>
				<i class="fas fa-user-md"></i>
			</span>
		</div>
		<div class="d-flex">
			<div class="col-lg-5 w3_agileits-contact-left"></div>
			<div class="col-lg-7 contact-right-w3l">
				<div class="card shadow-lg border-0 rounded-4">
					<div class="card-header bg-primary bg-gradient text-white text-center py-3 border-0 rounded-top-4">
						<h5 class="mb-1 fw-bold"><i class="fas fa-key me-2"></i>Reset your password if needed</h5>
					</div>
					<div class="card-body p-4">
						<form action="#" method="post" onsubmit="return checkpass();" name="changepassword">
							<div class="row g-4">
								<div class="col-12">
									<label for="currentpassword" class="form-label fw-semibold"><i class="fas fa-lock me-2 text-primary"></i>Current Password</label>
									<input type="password" class="form-control form-control-lg rounded-3 shadow-sm" name="currentpassword" id="currentpassword" required>
								</div>
								<div class="col-12">
									<label for="newpassword" class="form-label fw-semibold"><i class="fas fa-unlock-alt me-2 text-primary"></i>New Password</label>
									<input type="password" name="newpassword" class="form-control form-control-lg rounded-3 shadow-sm" required>
								</div>
								<div class="col-12">
									<label for="confirmpassword" class="form-label fw-semibold"><i class="fas fa-check-double me-2 text-primary"></i>Confirm Password</label>
									<input type="password" class="form-control form-control-lg rounded-3 shadow-sm" name="confirmpassword" id="confirmpassword" required>
								</div>
								<div class="col-12 text-center mt-3">
									<button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow-lg" name="change">
										<i class="fas fa-save me-2"></i>Update
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