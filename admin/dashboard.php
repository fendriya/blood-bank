<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
	exit();
}

$pageTitle = "Admin Dashboard";

include_once('includes/header.php'); ?>

<div class="ts-main-content">
	<?php include_once('includes/leftbar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h2 class="page-title">Dashboard</h2>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-primary text-light">
											<div class="stat-panel text-center">
												<?php
												$sql = "SELECT id from tblbloodgroup ";
												$query = $dbh->prepare($sql);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$bg = $query->rowCount();
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($bg); ?></div>
												<div class="stat-panel-title text-uppercase">Listed Blood Groups</div>
											</div>
										</div>
										<a href="manage-bloodgroup.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-success text-light">
											<div class="stat-panel text-center">
												<?php
												$sql1 = "SELECT id from tblblooddonars ";
												$query1 = $dbh->prepare($sql1);;
												$query1->execute();
												$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
												$regbd = $query1->rowCount();
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($regbd); ?></div>
												<div class="stat-panel-title text-uppercase">Registered Blood Group</div>
											</div>
										</div>
										<a href="donor-list.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-default">
										<div class="panel-body bk-info text-light">
											<div class="stat-panel text-center">
												<?php
												$sql6 = "SELECT id from tblcontactusquery ";
												$query6 = $dbh->prepare($sql6);;
												$query6->execute();
												$results6 = $query6->fetchAll(PDO::FETCH_OBJ);
												$query = $query6->rowCount();
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($query); ?></div>
												<div class="stat-panel-title text-uppercase">Total Quries</div>
											</div>
										</div>
										<a href="manage-conactusquery.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
								<!------------------------>
								<div class="col-md-4">
									<div class="panel panel-danger">
										<div class="panel-body bk-info text-light">
											<div class="stat-panel text-center">
												<?php
												$sql6 = "SELECT ID  from tblbloodrequirer ";
												$query6 = $dbh->prepare($sql6);;
												$query6->execute();
												$results6 = $query6->fetchAll(PDO::FETCH_OBJ);
												$totalreuqests = $query6->rowCount();
												?>
												<div class="stat-panel-number h1 "><?php echo htmlentities($totalreuqests); ?></div>
												<div class="stat-panel-title text-uppercase">Total Blood Request Received</div>
											</div>
										</div>
										<a href="blood-requests.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.onload = function() {

		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero: true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
			responsive: true
		});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
			responsive: true
		});

	}
</script>
<?php include_once('includes/footer.php'); ?>