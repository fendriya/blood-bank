<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}

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
	$sql = "INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status)";
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
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if ($lastInsertId) {
		$msg = "Your info submitted successfully";
	} else {
		$error = "Something went wrong. Please try again";
	}
}
$pageTitle = "Admin Add Donor";

?>

<script language="javascript">
	function isNumberKey(evt) {

		var charCode = (evt.which) ? evt.which : event.keyCode

		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
			return false;

		return true;
	}
</script>

<?php include('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Add Donor</h2>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">Basic Info</div>
								<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
								<div class="panel-body">
									<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="fullname" class="form-control" required>
											</div>
											<label class="col-sm-2 control-label">Mobile No<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="mobileno" onKeyPress="return isNumberKey(event)" maxlength="10" class="form-control" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Email id </label>
											<div class="col-sm-4">
												<input type="email" name="emailid" class="form-control">
											</div>
											<label class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input type="text" name="age" class="form-control" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Gender <span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select name="gender" class="form-control" required>
													<option value="">Select</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
											<label class="col-sm-2 control-label">Blood Group<span style="color:red">*</span></label>
											<div class="col-sm-4">
												<select name="bloodgroup" class="form-control" required>
													<option value="">Select</option>
													<?php $sql = "SELECT * from  tblbloodgroup ";
													$query = $dbh->prepare($sql);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													$cnt = 1;
													if ($query->rowCount() > 0) {
														foreach ($results as $result) {				?>
															<option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
													<?php }
													} ?>
												</select>
											</div>
										</div>
										<div class="hr-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Address</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="address"></textarea>
											</div>
										</div>
										<div class="hr-dashed"></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Message<span style="color:red">*</span></label>
											<div class="col-sm-10">
												<textarea class="form-control" name="message" required> </textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												<a href="donor-list.php" class="btn btn-primary">
													Back
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once('includes/footer.php'); ?>