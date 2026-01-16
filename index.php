<?php
error_reporting(0);
include_once "includes/config.php";

$pageTitle = "Blood Bank Donar Management System | Home";
?>
<?php include_once "includes/header.php"; ?>
<!-- Carousel Section -->
<div class="container-fluid px-0">
   <div id="mainCarousel" class="carousel slide mb-4 w-100" data-bs-ride="carousel">
      <div class="carousel-indicators">
         <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img src="images/carousel-1.jpg" class="d-block w-100" alt="Banner 1" style="height:700px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
               <h5>Donate Blood, Save Lives</h5>
               <p>Your donation can make a difference.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/banner2.jpg" class="d-block w-100" alt="Banner 2" style="height:700px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
               <h5>Be a Hero</h5>
               <p>One donation can save up to three lives.</p>
            </div>
         </div>
         <div class="carousel-item">
            <img src="images/carousel-3.png" class="d-block w-100" alt="Banner 3" style="height:700px;object-fit:cover;">
            <div class="carousel-caption d-none d-md-block">
               <h5>Join Our Mission</h5>
               <p>Help us build a healthier community.</p>
            </div>
         </div>
      </div>
   </div>
   <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
   </button>
   <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
   </button>
</div>
<!-- Donor Highlights -->
<section class="container mb-5">
   <h2 class="text-center mb-4">Featured Donors</h2>
   <div class="row g-3">
      <?php
      $status = 1;
      $sql =
         "SELECT * from tblblooddonars where status=:status order by id desc limit 6";
      $query = $dbh->prepare($sql);
      $query->bindParam(":status", $status, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      if ($query->rowCount() > 0) {
         foreach ($results as $result) { ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
               <div class="card donor-card shadow-lg h-100 w-100 border border-danger border-3 rounded-4" style="background:#fff;">
                  <div class="text-center pt-3 pb-2">
                     <span class="d-inline-block bg-danger bg-opacity-10 rounded-circle p-3 mb-2">
                        <i class="fas fa-user fa-2x text-danger"></i>
                     </span><br>
                     <span class="badge bg-danger text-light fw-bold px-3 py-1" style="font-size:0.95rem;"><?php echo htmlentities($result->BloodGroup); ?></span>
                  </div>
                  <div class="card-body p-2 text-center">
                     <h6 class="card-title text-danger fw-bold mb-1" style="font-size:1.1rem;"><?php echo htmlentities($result->FullName); ?></h6>
                     <div class="mb-1 text-muted" style="font-size:0.95rem;"><strong>Gender:</strong> <?php echo htmlentities($result->Gender); ?></div>
                     <div class="mb-2 text-muted" style="font-size:0.95rem;"><strong>Blood Group:</strong> <?php echo htmlentities($result->BloodGroup); ?></div>
                     <a href="contact-blood.php?cid=<?php echo $result->id; ?>" class="btn btn-danger btn-sm w-100 rounded-pill shadow-sm">Request Blood</a>
                  </div>
               </div>
            </div>
      <?php }
      }
      ?>
   </div>
</section>
<!-- Blood Groups Section -->
<section class="container mb-5">
   <div class="row align-items-center bg-light rounded-4 shadow-sm py-5 px-3 mx-0">
      <div class="col-md-7">
         <h2 class="mb-4 text-danger fw-bold d-flex align-items-center">
            <i class="fas fa-tint me-2"></i>Blood Groups
         </h2>
         <div class="d-flex flex-wrap gap-3 mb-3">
            <div class="d-flex align-items-center bg-white rounded-3 shadow-sm px-3 py-2 flex-grow-1" style="min-width:180px;">
               <span class="badge bg-danger bg-gradient me-3 p-2"><i class="fas fa-tint"></i> A</span>
               <span class="fw-semibold">A positive or A negative</span>
            </div>
            <div class="d-flex align-items-center bg-white rounded-3 shadow-sm px-3 py-2 flex-grow-1" style="min-width:180px;">
               <span class="badge bg-danger bg-gradient me-3 p-2"><i class="fas fa-tint"></i> B</span>
               <span class="fw-semibold">B positive or B negative</span>
            </div>
            <div class="d-flex align-items-center bg-white rounded-3 shadow-sm px-3 py-2 flex-grow-1" style="min-width:180px;">
               <span class="badge bg-danger bg-gradient me-3 p-2"><i class="fas fa-tint"></i> O</span>
               <span class="fw-semibold">O positive or O negative</span>
            </div>
            <div class="d-flex align-items-center bg-white rounded-3 shadow-sm px-3 py-2 flex-grow-1" style="min-width:180px;">
               <span class="badge bg-danger bg-gradient me-3 p-2"><i class="fas fa-tint"></i> AB</span>
               <span class="fw-semibold">AB positive or AB negative</span>
            </div>
         </div>
         <p class="text-dark mb-0 mt-3"><i class="fas fa-apple-alt me-2 text-success"></i>
            <li>A healthy diet plays an important role in making your blood donation safe and successful, while also helping you feel your best.</li><br>
            <li>Eating the right foods before donating helps maintain good energy levels, supports healthy iron levels, and reduces the chances of dizziness or fatigue.</li><br>
            <li>Take a look at the recommended foods to eat before your donation to ensure a smooth, comfortable experience and a quicker recovery.</li>
         </p>

      </div>
      <div class="col-md-5 text-center">
         <img src="images/blood-donor111.jpg" class="img-fluid rounded-4 shadow" alt="Blood Donor" style="max-height:260px;object-fit:cover;">
      </div>
   </div>
</section>

<?php include_once "includes/footer.php"; ?>