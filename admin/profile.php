<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}

// Code for change password	
if (isset($_POST['submit'])) {
	$adminid = $_SESSION['alogin'];
	$AName = $_POST['adminname'];
	$mobno = $_POST['mobilenumber'];
	$email = $_POST['email'];
	$sql = "update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where UserName=:aid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':adminname', $AName, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
	$query->bindParam(':aid', $adminid, PDO::PARAM_STR);
	$query->execute();

	echo '<script>alert("Your profile has been updated")</script>';
	echo "<script>window.location.href ='profile.php'</script>";
}

$pageTitle = "Admin Profile";
?>

<?php include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Admin Profile</h2>
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Form fields</div>
								<div class="panel-body">
									<form method="post" class="form-horizontal" onSubmit="return valid();">
										<?php
										$sql = "SELECT * from  tbladmin";
										$query = $dbh->prepare($sql);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);
										$cnt = 1;
										if ($query->rowCount() > 0) {
											foreach ($results as $row) {               ?>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Admin Name</label>
													<div class="col-sm-8">
														<input type="text" name="adminname" value="<?php echo $row->AdminName; ?>" class="form-control" required='true'>
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-4 control-label">User Name</label>
													<div class="col-sm-8">
														<input type="text" name="username" value="<?php echo $row->UserName; ?>" class="form-control" readonly="">
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Contact Number</label>
													<div class="col-sm-8">
														<input type="text" name="mobilenumber" value="<?php echo $row->MobileNumber; ?>" class="form-control" maxlength='10' required='true' pattern="[0-9]+">
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Email</label>
													<div class="col-sm-8">
														<input type="email" name="email" value="<?php echo $row->Email; ?>" class="form-control" required='true'>
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Admin Registration Date</label>
													<div class="col-sm-8">
														<input type="text" name="" value="<?php echo $row->AdminRegdate; ?>" readonly="" class="form-control">
													</div>
												</div>
												<div class="hr-dashed"></div>
										<?php $cnt = $cnt + 1;
											}
										} ?>
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-4">
												<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
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
