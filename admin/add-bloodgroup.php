<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}
// Code for add blood group with duplicate check
if (isset($_POST['submit'])) {
	$bloodgroup = $_POST['bloodgroup'];
	// Check if blood group already exists
	$sql = "SELECT id FROM tblbloodgroup WHERE BloodGroup = :bloodgroup";
	$query = $dbh->prepare($sql);
	$query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
	$query->execute();
	if ($query->rowCount() > 0) {
		$error = "Blood Group already exists.";
	} else {
		$sql = "INSERT INTO tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Blood Group Created successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}
}

$pageTitle = "Admin Add Blood Group";

include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Add Blood Group </h2>
					<div class="row">
						<div class="col-md-10">
							<div class="panel panel-default">
								<div class="panel-heading">Form fields</div>
								<div class="panel-body">
									<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										<?php if ($error) { ?>
											<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
										<?php } else if ($msg) { ?>
											<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
										<?php } ?>
										<div class="form-group">
											<label class="col-sm-4 control-label">Blood Group</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="bloodgroup" id="bloodgroup" required>
											</div>
										</div>
										<div class="hr-dashed"></div>
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-4 d-flex gap-3">
												<button class="btn btn-primary" name="submit" type="submit">Submit</button>&nbsp;&nbsp;
												<a href="manage-bloodgroup.php" class="btn btn-primary">
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