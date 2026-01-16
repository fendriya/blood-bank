<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}
$pageTitle = "Admin Blood Requests";

include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="panel-body">
				<form method="post" name="search" class="form-horizontal" onSubmit="return valid();">
					<div class="form-group">
						<label class="col-sm-4 control-label">Search by Donor or Requirer Name / Phone Number</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="searchdata" id="searchdata" required>
						</div>
					</div>
					<div class="hr-dashed"></div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">

							<button class="btn btn-primary" name="search" type="submit">Search</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-12">
				<?php
				if (isset($_POST['search'])) {

					$sdata = $_POST['searchdata'];
				?>
					<h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>
					<!-- Zero Configuration Table -->
					<div class="panel panel-default">
						<div class="panel-heading">Blood Info</div>
						<div class="panel-body">
							<table border="1" class="table table-responsive">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Name of Donar</th>
										<th>Conatact Number of Donar</th>
										<th>Name of Requirer</th>
										<th>Mobile Number of Requirer</th>
										<th>Email of Requirer</th>
										<th>Blood Require For</th>
										<th>Message of Requirer</th>
										<th>Apply Date</th>
									</tr>
								</thead>
								<tbody>
									<tr><?php
										$sql = "SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid,tblblooddonars.FullName,tblblooddonars.MobileNumber from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblblooddonars.FullName like '%$sdata%' || tblblooddonars.MobileNumber like '%$sdata%' || tblbloodrequirer.name like '%$sdata%' || tblbloodrequirer.ContactNumber like '%$sdata%'";
										$query = $dbh->prepare($sql);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);
										$cnt = 1;
										if ($query->rowCount() > 0) {
											foreach ($results as $row) {               ?>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($row->FullName); ?></td>
												<td><?php echo htmlentities($row->MobileNumber); ?></td>
												<td><?php echo htmlentities($row->name); ?></td>
												<td><?php echo htmlentities($row->ContactNumber); ?></td>
												<td><?php echo htmlentities($row->EmailId); ?></td>
												<td><?php echo htmlentities($row->BloodRequirefor); ?></td>
												<td><?php echo htmlentities($row->Message); ?>
												</td>
												<td>
													<?php echo htmlentities($row->ApplyDate); ?>
												</td>
									</tr>
								<?php $cnt = $cnt + 1;
											}
										} else { ?>
								<tr>
									<th colspan="8" style="color:red;"> No Record found</th>
								</tr>
						<?php }
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
