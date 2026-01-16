<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	$sql = "delete from tblbloodgroup  WHERE id=:id";
	$query = $dbh->prepare($sql);
	$query->bindParam(':id', $id, PDO::PARAM_STR);
	$query->execute();
	$msg = "Data Deleted successfully";
}
$pageTitle = "Admin Manage Blood Groups";
?>

<?php include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div style="overflow: hidden; margin-bottom: 16px;">
						<h2 class="page-title" style="float: left; margin: 0;">Manage Blood Groups</h2>
						<a href="add-bloodgroup.php" style="float: right; font-size: 14px; padding: 6px 12px;" class="btn btn-info">
							<i class="fa fa-plus"></i> Add Blood Group
						</a>
					</div>
					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Listed Blood Groups</div>
						<div class="panel-body">
							<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
							<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Blood Groups</th>
										<th>Creation Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Blood Groups</th>
										<th>Creation Date</th>
										<th>Action</th>
									</tr>
									</tr>
								</tfoot>
								<tbody>
									<?php $sql = "SELECT * from  tblbloodgroup order by id desc";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($result->BloodGroup); ?></td>
												<td><?php echo htmlentities($result->PostingDate); ?></td>
												<td>
													<a href="manage-bloodgroup.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to delete');" class="text-danger">
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