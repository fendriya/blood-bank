<?php
error_reporting(0);
include_once('includes/config.php');

$pageTitle = "Blood Bank Donar Management System | Donor List";
?>

<?php include_once('includes/header.php'); ?>

<div class="inner-banner-w3ls">
   <div class="container">

   </div>
   <!-- //banner 2 -->
</div>
<div class="container py-5">
   <div class="text-center mb-5">
      <h2 class="text-danger fw-bold">Blood Donor List</h2>
      <p class="text-muted">Find life-saving heroes near you</p>
   </div>
   <!-- Search Donor UI -->
   <div class="container mt-4">
      <div class="card shadow-lg border-0 p-4 mb-4" style="background: #fff;">
         <div class="row align-items-center mb-3">
            <div class="col-auto">
               <span class="d-inline-block bg-danger bg-opacity-10 rounded-circle p-3 me-2">
                  <i class="fas fa-search fa-2x text-danger"></i>
               </span>
            </div>
            <div class="col">
               <h4 class="fw-bold mb-0 text-danger">Find a Blood Donor</h4>
               <small class="text-muted">Search by blood group and location</small>
            </div>
         </div>
         <form method="post" class="row g-3 align-items-end">
            <div class="col-md-5">
               <label class="form-label fw-semibold">Blood Group <span style="color:red">*</span></label>
               <select name="bloodgroup" class="form-select form-select-md rounded-pill shadow-sm">
                  <option value="">All Blood Groups</option>
                  <?php $sql = "SELECT * from tblbloodgroup ";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  if ($query->rowCount() > 0) {
                     foreach ($results as $result) { ?>
                        <option value="<?php echo htmlentities($result->BloodGroup); ?>" <?php if (isset($_POST['bloodgroup']) && $_POST['bloodgroup'] == $result->BloodGroup) echo 'selected'; ?>><?php echo htmlentities($result->BloodGroup); ?></option>
                  <?php }
                  } ?>
               </select>
            </div>
            <div class="col-md-5">
               <label class="form-label fw-semibold">Location</label>
               <input type="text" class="form-control form-control-md rounded-pill shadow-sm" name="location" placeholder="Enter location" value="<?php echo isset($_POST['location']) ? htmlentities($_POST['location']) : ''; ?>">
            </div>
            <div class="col-md-2 text-end">
               <button type="submit" name="sub" class="btn btn-danger btn-md px-4 py-2 fw-semibold shadow rounded-pill w-100">
                  <i class="fas fa-search me-2"></i>Search
               </button>
            </div>
         </form>
      </div>
   </div>
   <div class="row g-4">
      <?php
      $status = 1;
      if (isset($_POST['sub'])) {
         $bloodgroup = $_POST['bloodgroup'];
         $location = $_POST['location'];
         $where = [];
         $params = [':status' => $status];
         if (!empty($bloodgroup)) {
            // Only filter by blood group if not 'All' (empty string means all)
            $where[] = 'BloodGroup = :bloodgroup';
            $params[':bloodgroup'] = $bloodgroup;
         }
         if (!empty($location)) {
            $where[] = 'Address LIKE :location';
            $params[':location'] = "%$location%";
         }
         $sql = "SELECT * FROM tblblooddonars WHERE status=:status";
         if ($where) {
            $sql .= ' AND ' . implode(' AND ', $where);
         }
         $sql .= ' order by id desc';
         $query = $dbh->prepare($sql);
         foreach ($params as $key => $val) {
            $query->bindValue($key, $val);
         }
         $query->execute();
         $results = $query->fetchAll(PDO::FETCH_OBJ);
      } else {
         $sql = "SELECT * FROM tblblooddonars WHERE status=:status order by id desc";
         $query = $dbh->prepare($sql);
         $query->bindParam(':status', $status, PDO::PARAM_STR);
         $query->execute();
         $results = $query->fetchAll(PDO::FETCH_OBJ);
      }

      if ($query->rowCount() > 0) {
         foreach ($results as $result) {
      ?>
            <div class="col-lg-4 col-md-6">
               <div class="donor-card h-100">
                  <div class="donor-header">
                     <img src="images/blood-donor.jpg" alt="Donor">
                     <h5 class="mb-1"><?php echo htmlentities($result->FullName); ?></h5>
                     <span class="badge bg-light text-danger fw-bold">
                        <?php echo htmlentities($result->BloodGroup); ?>
                     </span>
                  </div>
                  <div class="donor-body">
                     <table class="table table-sm">
                        <tr>
                           <td><strong>Gender</strong></td>
                           <td><?php echo htmlentities($result->Gender); ?></td>
                        </tr>
                        <tr>
                           <td><strong>Age</strong></td>
                           <td><?php echo htmlentities($result->Age); ?></td>
                        </tr>
                        <tr>
                           <td><strong>Mobile</strong></td>
                           <td><?php echo htmlentities($result->MobileNumber); ?></td>
                        </tr>
                        <tr>
                           <td><strong>Email</strong></td>
                           <td><?php echo htmlentities($result->EmailId); ?></td>
                        </tr>
                        <tr>
                           <td><strong>Address</strong></td>
                           <td><?php echo htmlentities($result->Address); ?></td>
                        </tr>
                     </table>
                     <div class="text-center mt-3">
                        <a href="contact-blood.php?cid=<?php echo $result->id; ?>"
                           class="btn btn-danger request-btn">
                           Request Blood
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         <?php }
      } else {
         ?>
         <div class="container text-center py-5">
            <div class="alert alert-warning d-inline-block px-4 py-3 mt-4" role="alert">
               <i class="fas fa-exclamation-circle me-2"></i> No Record Found
            </div>
         </div>
      <?php } ?>
   </div>
</div>
<?php include_once('includes/footer.php'); ?>