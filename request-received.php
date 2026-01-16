<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if (strlen($_SESSION['bbdmsdid'] == 0)) {
    header('location:logout.php');
    exit();
}

$pageTitle = "Blood Bank Donar Management System | Request Received";

include_once('includes/header.php'); ?>

<!-- banner 2 -->
<div class="inner-banner-w3ls">
    <div class="container">

    </div>
    <!-- //banner 2 -->
</div>

<!-- contact -->
<div class="appointment py-5">
    <div class="py-xl-5 py-lg-3">
        <div class="w3ls-titles text-center mb-5">
            <span>
                <div class="d-flex justify-content-center">
                    <div class="col-lg-11">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-danger bg-gradient text-white text-center py-3 border-0 rounded-top-4">
                                <h5 class="mb-1 fw-bold"><i class="fas fa-envelope-open-text me-2"></i>Blood Requests Received</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table border="1" class="table table-bordered table-hover table-striped align-middle mb-0 rounded-4 shadow overflow-hidden">
                                        <thead class="bg-primary text-white align-middle">
                                            <tr style="font-weight:600; font-size:1.05em;">
                                                <th class="py-3">S.No</th>
                                                <th class="py-3">Name</th>
                                                <th class="py-3">Mobile Number</th>
                                                <th class="py-3">Email</th>
                                                <th class="py-3">Blood Require For</th>
                                                <th class="py-3">Message</th>
                                                <th class="py-3">Apply Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid = $_SESSION['bbdmsdid'];
                                            $sql = "SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblbloodrequirer.BloodDonarID=:uid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->name); ?></td>
                                                        <td><?php echo htmlentities($row->ContactNumber); ?></td>
                                                        <td><?php echo htmlentities($row->EmailId); ?></td>
                                                        <td><?php echo htmlentities($row->BloodRequirefor); ?></td>
                                                        <td><?php echo htmlentities($row->Message); ?></td>
                                                        <td><?php echo htmlentities($row->ApplyDate); ?></td>
                                                    </tr>
                                                <?php $cnt = $cnt + 1;
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger">No Record found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="clerafix"></div>
    </div>
</div>
</div>
<!-- //contact -->

<?php include_once('includes/footer.php'); ?>