<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['bbdmsdid'] == 0)) {
	header('location:logout.php');
	exit();
}

if (isset($_POST['update'])) {
	$uid = $_SESSION['bbdmsdid'];
	$name = $_POST['fullname'];
	$mno = $_POST['mobileno'];
	$emailid = $_POST['emailid'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$bloodgroup = $_POST['bloodgroup'];
	$address = $_POST['address'];
	$message = $_POST['message'];
	$sql = "update tblblooddonars set FullName=:name,MobileNumber=:mno, Age=:age,Gender=:gender,BloodGroup=:bloodgroup,Address=:address,Message=:message  where id=:uid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':mno', $mno, PDO::PARAM_STR);
	$query->bindParam(':age', $age, PDO::PARAM_STR);
	$query->bindParam(':gender', $gender, PDO::PARAM_STR);
	$query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
	$query->bindParam(':address', $address, PDO::PARAM_STR);
	$query->bindParam(':message', $message, PDO::PARAM_STR);
	$query->bindParam(':uid', $uid, PDO::PARAM_STR);
	$query->execute();
	echo '<script>alert("Profile has been updated")</script>';
}

$pageTitle = "Blood Bank Donar Management System | Donor Profile";
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
			<h3 class="title">Donor Profile</h3>
			<span>
				<i class="fas fa-user-md"></i>
			</span>
		</div>
		<div class="d-flex">
			<div class="col-lg-5 w3_agileits-contact-left"></div>
			<div class="col-lg-7 contact-right-w3l">
				<div class="card shadow-lg border-0 rounded-4">
					<div class="card-header bg-primary bg-gradient text-white text-center py-3 border-0 rounded-top-4">
						<h5 class="mb-1 fw-bold"><i class="fas fa-user me-2"></i>Update Your Profile</h5>
					</div>
					<div class="card-body p-4">
						<form action="#" method="post">
							<div class="row g-4">
								<?php
								$uid = $_SESSION['bbdmsdid'];
								$sql = "SELECT * from  tblblooddonars where id=:uid";
								$query = $dbh->prepare($sql);
								$query->bindParam(':uid', $uid, PDO::PARAM_STR);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								$cnt = 1;
								if ($query->rowCount() > 0) {
									foreach ($results as $row) { ?>
										<div class="col-md-6">
											<label for="fullname" class="form-label fw-semibold"><i class="fas fa-user me-2 text-primary"></i>Full Name</label>
											<input type="text" class="form-control form-control-lg rounded-3 shadow-sm" name="fullname" id="fullname" value="<?php echo $row->FullName; ?>">
										</div>
										<div class="col-md-6">
											<label for="mobileno" class="form-label fw-semibold"><i class="fas fa-phone me-2 text-primary"></i>Mobile Number</label>
											<input type="text" class="form-control form-control-lg rounded-3 shadow-sm" name="mobileno" id="mobileno" required maxlength="10" pattern="[0-9]+" value="<?php echo $row->MobileNumber; ?>">
										</div>
										<div class="col-md-6">
											<label for="emailid" class="form-label fw-semibold"><i class="fas fa-envelope me-2 text-primary"></i>Email Id <span style="color:red; font-size:10px;">(Can't be Changed)</span></label>
											<input type="email" name="emailid" class="form-control form-control-lg rounded-3 shadow-sm" value="<?php echo $row->EmailId; ?>" readonly>
										</div>
										<div class="col-md-6">
											<label for="age" class="form-label fw-semibold"><i class="fas fa-user-clock me-2 text-primary"></i>Age</label>
											<input type="text" class="form-control form-control-lg rounded-3 shadow-sm" name="age" id="age" required value="<?php echo $row->Age; ?>">
										</div>
										<div class="col-md-6">
											<label for="gender" class="form-label fw-semibold"><i class="fas fa-venus-mars me-2 text-primary"></i>Gender</label>
											<select required class="form-select form-select-lg rounded-3 shadow-sm" name="gender">
												<option value="<?php echo $row->Gender; ?>"><?php echo $row->Gender; ?></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="bloodgroup" class="form-label fw-semibold"><i class="fas fa-tint me-2 text-primary"></i>Blood Group</label>
											<select name="bloodgroup" class="form-select form-select-lg rounded-3 shadow-sm" required>
												<option value="<?php echo $row->BloodGroup; ?>"><?php echo $row->BloodGroup; ?></option>
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
										<div class="col-12">
											<label for="address" class="form-label fw-semibold"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Address</label>
											<input type="text" class="form-control form-control-lg rounded-3 shadow-sm" name="address" id="address" required value="<?php echo $row->Address; ?>">
										</div>
										<div class="col-12">
											<label for="message" class="form-label fw-semibold"><i class="fas fa-comment me-2 text-primary"></i>Message</label>
											<textarea class="form-control form-control-lg rounded-3 shadow-sm" name="message" rows="4" required><?php echo $row->Message; ?></textarea>
										</div>
								<?php $cnt = $cnt + 1;
									}
								} ?>
								<div class="col-12 text-center mt-3">
									<button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow-lg" name="update">
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

<?php include('includes/footer.php'); ?>