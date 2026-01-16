<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}
if (isset($_REQUEST['hidden'])) {
	$eid = intval($_GET['hidden']);
	$status = "0";
	$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:eid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':status', $status, PDO::PARAM_STR);
	$query->bindParam(':eid', $eid, PDO::PARAM_STR);
	$query->execute();

	$msg = "Donor details hidden Successfully";
}

if (isset($_REQUEST['public'])) {
	$aeid = intval($_GET['public']);
	$status = 1;

	$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:aeid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':status', $status, PDO::PARAM_STR);
	$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
	$query->execute();

	$msg = "Donor details public";
}
//Code for Deletion
if (isset($_REQUEST['del'])) {
	$did = intval($_GET['del']);
	$sql = "delete from tblblooddonars WHERE  id=:did";
	$query = $dbh->prepare($sql);
	$query->bindParam(':did', $did, PDO::PARAM_STR);
	$query->execute();

	$msg = "Record deleted Successfully ";
}

$pageTitle = "Admin Donor List";

include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div style="overflow: hidden; margin-bottom: 16px;">
						<h2 class="page-title" style="float: left; margin: 0;">Donor List</h2>
						<a href="add-donor.php" style="float: right; font-size: 14px; padding: 6px 12px;" class="btn btn-info">
							<i class="fa fa-plus"></i> Add Donor
						</a>
					</div>
					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Donors Info</div>
						<a href="download-records.php" style="font-size:14px; float:right; margin-top:16px;" class="btn btn-info mt-3 mb-3">Download Donor List</a>
						<div style="clear:both;"></div>
						<div class="panel-body">
							<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
							<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Mobile No</th>
										<th>Email</th>
										<th>Age</th>
										<th>Gender</th>
										<th>Blood Group</th>
										<th>address</th>
										<th>Message </th>
										<th>action </th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Mobile No</th>
										<th>Email</th>
										<th>Age</th>
										<th>Gender</th>
										<th>Blood Group</th>
										<th>address</th>
										<th>Message </th>
										<th>action </th>
									</tr>
								</tfoot>
								<tbody>
									<?php $sql = "SELECT * from  tblblooddonars order by id desc";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($result->FullName); ?></td>
												<td><?php echo htmlentities($result->MobileNumber); ?></td>
												<td><?php echo htmlentities($result->EmailId); ?></td>
												<td><?php echo htmlentities($result->Gender); ?></td>
												<td><?php echo htmlentities($result->Age); ?></td>
												<td><?php echo htmlentities($result->BloodGroup); ?></td>
												<td><?php echo htmlentities($result->Address); ?></td>
												<td><?php echo htmlentities($result->Message); ?></td>
												<td>
													<?php if ($result->status == 1) { ?>
														<a href="donor-list.php?hidden=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to hiidden this detail')" class="btn btn-primary"> Make it Hidden</a>
													<?php } else { ?>
														<a href="donor-list.php?public=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Public this detail')" class="btn btn-primary"> Make it Public</a>
													<?php } ?>
													<a href="donor-list.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to delete this record')" class="btn btn-danger" style="margin-top:1%;">
														<i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>
									<?php $cnt = $cnt + 1;
										}
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once('includes/footer.php'); ?>