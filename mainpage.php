<?php
session_start();
include('config/config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

$user_id = $_SESSION['user_id'];

include('./include/header.php');

$query = "SELECT name, email, profile FROM accounts WHERE id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<style>
  .bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #1e90ff);
  }

  .popup-message {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1050;
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.25);
  min-width: 400px;
  font-size: 1.2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center; /* This handles text centering */
}

.popup-message p {
  margin: 0 auto; /* Ensures the paragraph itself is centered */
  width: 100%;
}


  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  @media (max-width: 768px) {
    .popup-message {
      min-width: 90%;
    }
  }

  .popup-message.show {
    display: block;
  }
</style>

<body>

 <?php if (isset($_SESSION['display'])): ?>
    <div class="popup-message show" id="popupMessage">
      <div class="d-flex align-items-center">
        <i class="material-symbols-outlined text-success me-2">check_circle</i>
        <p class="mb-0"><?php echo htmlspecialchars($_SESSION['display']); ?></p>
      </div>
    </div>
    <?php 
    // Unset the session variable after displaying the message
    unset($_SESSION['display']); 
    ?>
<?php endif; ?>

<script>
    // Auto-hide popup after 3 seconds
    setTimeout(function () {
      const popup = document.getElementById('popupMessage');
      if (popup) {
        popup.style.display = 'none';
      }
    }, 3000);
</script>

  <?php include './include/aside3.php'; ?>

  <div class="top-bar">
    <a class="text-white" id="toggle-sidebar" href="#">
      <span class="material-symbols-outlined">menu</span>
    </a>
    <!-- Profile Picture -->
    <div class="profile-circle">
      <img id="profile-pic" src="./Profile/<?php echo htmlspecialchars($user['profile']); ?>" alt="User Profile"
        onerror="this.onerror=null; this.style.display='none'; document.getElementById('default-icon').style.display='flex';">
      <span id="default-icon" class="material-symbols-outlined" style="display: none;">person</span>
    </div>
  </div>
  </div>





  <div class="container py-5">
    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold text-primary ">
        Welcome to <span class="text-dark">KCEAP SIMS</span>
      </h1>
      <p class="lead text-secondary">Your one-stop platform for managing scholarships with ease.</p>
      <hr class="w-50 mx-auto">
    </div>





    <!-- Scholarship Information Card -->
    <div class="card mx-auto shadow rounded-4" style="max-width: 700px; margin-top: -20px;">
      <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
        <h4 class="mb-0 fw-semibold">🎓 Scholarship Information</h4>
      </div>
      <div class="card-body px-4 py-3">
        <p class="text-muted mb-4">Apply for scholarships, check your status, and stay updated on deadlines below.</p>

        <!-- Scholarship Item -->
        <div class="list-group list-group-flush">
          <div class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center py-3 gap-3">
            <div>
              <h6 class="fw-bold mb-1">High School Scholarship</h6>
              <p class="text-muted small mb-0">Renew or apply for your college scholarship.</p>
            </div>
            <div class="btn-group">
              <a href="#" class="btn btn-outline-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#collegerenew">
                <i class="material-symbols-outlined align-middle">autorenew</i> Renew
              </a>
              <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#collegeapply">
                <i class="material-symbols-outlined align-middle">add_circle</i> Apply
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 <!-- Renew Modal -->
<div class="modal fade" id="collegerenew" tabindex="-1" aria-labelledby="hsrenewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title" id="hsrenewLabel">Renew College Scholarship</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="processRenewal.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <select class="form-select" name="name" id="name" required>
                                <option value="" disabled selected>Select your name...</option>
                                <?php
                                // Fetch names from the database
                                $query = "SELECT id, name FROM records ORDER BY name ASC";
                                $result = mysqli_query($conn, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['name'] . '">' . htmlspecialchars($row['name']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No records found</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label fw-semibold">Semester</label>
                            <select class="form-select" name="semester" id="semester" required>
                                <option value="" disabled selected>Select semester...</option>
                                <option value="1ST SEMESTER">1ST SEMESTER</option>
                                <option value="2ND SEMESTER">2ND SEMESTER</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="comelec_certificate" class="form-label fw-semibold">COMELEC Certificate</label>
                            <input type="file" class="form-control" id="comelec_certificate" name="comelec_certificate" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="complete_grades" class="form-label fw-semibold">Complete Grades</label>
                            <input type="file" class="form-control" id="complete_grades" name="complete_grades" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="enrollment_certificate" class="form-label fw-semibold">Enrollment Certificate</label>
                            <input type="file" class="form-control" id="enrollment_certificate" name="enrollment_certificate" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success w-100 fw-bold">Submit Renewal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="collegeapply" tabindex="-1" aria-labelledby="hsapplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content rounded-4">
        <div class="modal-header bg-primary text-white rounded-top-4">
          <h5 class="modal-title fw-bold" id="hsapplyLabel">Apply for College Scholarship</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="px-3" method="POST" action="collegeApply.php" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo strtoupper(htmlspecialchars($user['name'])); ?>" readonly>
              </div>

                <div class="col-md-6">
                <label for="school" class="form-label fw-semibold">School</label>
                <select name="school" id="school" class="form-select" required>
                  <option disabled selected>Select your school...</option>

                  <!-- Carlos Hilado Memorial State University (CHMSU) -->
                  <option value="CHMSU-TALISAY">CHMSU – Talisay (Main Campus)</option>
                  <option value="CHMSU-ALIJIS">CHMSU – Alijis Campus</option>
                  <option value="CHMSU-FT">CHMSU – Fortune Towne Campus</option>
                  <option value="CHMSU-BINALBAGAN">CHMSU – Binalbagan Campus</option>

                  <!-- Central Philippines State University (CPSU) -->
                  <option value="CPSU-KABANKALAN">CPSU – Kabankalan (Main Campus)</option>
                  <option value="CPSU-CAUAYAN">CPSU – Cauayan Campus</option>
                  <option value="CPSU-SIPALAY">CPSU – Sipalay Campus</option>
                  <option value="CPSU-ILOG">CPSU – Ilog Campus</option>
                  <option value="CPSU-HINIGARAN">CPSU – Hinigaran Campus</option>
                  <option value="CPSU-MOISES">CPSU – Moises Padilla Campus</option>
                  <option value="CPSU-SAN-CARLOS">CPSU – San Carlos Campus</option>
                  <option value="CPSU-VALLADOLID">CPSU – Valladolid Campus</option>
                  <option value="CPSU-LA-CASTELLANA">CPSU – La Castellana Campus</option>
                  <option value="CPSU-CANDONI">CPSU – Candoni Campus</option>

                  <!-- State University of Northern Negros (SUNN) -->
                  <option value="SUNN-SAGAY">SUNN – Sagay (Main Campus)</option>
                  <option value="SUNN-CADIZ">SUNN – Cadiz Campus</option>

                  <!-- West Visayas State University (WVSU) -->
                  <option value="WVSU-HIMAMAYLAN">WVSU – Himamaylan Campus</option>

                  <!-- Negros Oriental State University (NORSU) -->
                  <option value="NORSU-DUMAGUETE">NORSU – Dumaguete (Main Campus I & II)</option>
                  <option value="NORSU-BAIS1">NORSU – Bais Campus I</option>
                  <option value="NORSU-BAIS2">NORSU – Bais Campus II</option>
                  <option value="NORSU-GUIHULNGAN">NORSU – Guihulngan Campus</option>
                  <option value="NORSU-MABINAY">NORSU – Mabinay Campus</option>
                  <option value="NORSU-SIATON">NORSU – Siaton Campus</option>
                  <option value="NORSU-BAYAWAN">NORSU – Bayawan-Sta. Catalina Campus</option>
                  <option value="NORSU-PAMPLONA">NORSU – Pamplona Campus</option>

                  <!-- Private Colleges & Universities -->
                  <option value="USLS">University of St. La Salle – Bacolod</option>
                  <option value="UNO-R">University of Negros Occidental – Recoletos</option>
                  <option value="CSA-B">Colegio San Agustin – Bacolod</option>
                  <option value="LCC-BACOLOD">La Consolacion College – Bacolod</option>
                  <option value="STI-WNU">STI West Negros University</option>
                  <option value="RIVERSIDE">Riverside College, Inc.</option>
                  <option value="VMA">VMA Global College</option>
                  <option value="FBC">Fellowship Baptist College – Kabankalan</option>
                  <option value="KCC">Kabankalan Catholic College</option>
                  <option value="BCC">Bacolod City College</option>
                  <option value="BAGO-CC">Bago City College</option>
                  <option value="BCC-BINAL">Binalbagan Catholic College</option>
                  <option value="MCCE">Mount Carmel College of Escalante</option>
                  <option value="SLC">Southland College</option>
                  <option value="JBLCF">John B. Lacson Colleges Foundation – Bacolod</option>
                  <option value="CPAC">Central Philippine Adventist College</option>
                  <option value="LCCC">La Carlota City College</option>
                  <option value="AMA-BACOLOD">AMA Computer College – Bacolod</option>
                  <option value="ABE-BACOLOD">ABE International Business College – Bacolod</option>
                  <option value="ACA-BACOLOD">Asian College of Aeronautics – Bacolod</option>
                  <option value="OLM-BACOLOD">Our Lady of Mercy College – Bacolod</option>
                  <option value="FAST">FAST Aviation Academy</option>
                  <option value="LASALTECH">LaSalTech</option>
                  <option value="SHS-BACOLOD">Sacred Heart Seminary – Bacolod</option>
                  <option value="NOLITC">Negros Occidental Language & IT Center</option>
                  <option value="CBBC">Convention Baptist Bible College</option>
                  <option value="SU">Silliman University – Dumaguete</option>
                  <option value="SPUD">St. Paul University – Dumaguete</option>
                  <option value="FU">Foundation University – Dumaguete</option>
                  <option value="COSCA">Colegio de Santa Catalina de Alejandria</option>
                  <option value="MAXINO">Maxino College – Dumaguete</option>
                  <option value="MDC">Metro Dumaguete College</option>
                  <option value="LCC-BAIS">La Consolacion College – Bais</option>
                  <option value="VC">Villaflores College</option>
                  <option value="DIAZ">Diaz College</option>
                  <option value="SFC-GUI">Saint Francis College – Guihulngan</option>
                  <option value="SJC-CAN">Saint Joseph College – Canlaon</option>
                  <option value="NMCF">Negros Maritime College Foundation</option>
                  <option value="NCI">Negros College Inc. – Ayungon</option>
                  <option value="BC">Bayawan College</option>
                  <option value="PTC">Presbyterian Theological College</option>
                  <option value="STC-BAYAWAN">Southern Tech College – Bayawan</option>
                  <option value="AMA-DUMAGUETE">AMA Computer College – Dumaguete</option>
                  <option value="ACSAT-DUMAGUETE">Asian College of Science & Tech – Dumaguete</option>
                  <option value="STI-DUMAGUETE">STI College – Dumaguete</option>
                </select>
                </div>

              <div class="row g-3 mt-3">
                <div class="col-md-6">
                  <label for="semester" class="form-label fw-semibold">Semester</label>
                  <select class="form-select" name="semester" id="semester" required>
                    <option disabled selected>Select semester...</option>
                    <option value="1ST SEMESTER">1ST SEMESTER</option>
                    <option value="2ND SEMESTER">2ND SEMESTER</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="CourseYear" class="form-label fw-semibold">Course & Year</label>
                  <input type="text" class="form-control" id="CourseYear" name="CourseYear" placeholder="e.g. BSIT 2nd Year" required>
                </div>
              </div>

              <div class="row g-3 mt-3">
                <div class="col-md-6">
                  <label for="number" class="form-label fw-semibold">Phone Number</label>
                  <input type="tel" pattern="[0-9]{11}" maxlength="11" class="form-control" id="number" name="number" placeholder="e.g. 09123456789" required>
                </div>
                <div class="col-md-6">
                  <label for="address" class="form-label fw-semibold">Address</label>
                  <select class="form-select" name="address" id="address" required>
                    <option disabled selected>Select barangay.....</option>
                    <option value="BARANGAY 1">BARANGAY 1</option>
                    <option value="BARANGAY 2">BARANGAY 2</option>
                    <option value="BARANGAY 3">BARANGAY 3</option>
                    <option value="BARANGAY 4">BARANGAY 4</option>
                    <option value="BARANGAY 5">BARANGAY 5</option>
                    <option value="BARANGAY 6">BARANGAY 6</option>
                    <option value="BARANGAY 7">BARANGAY 7</option>
                    <option value="BARANGAY 8">BARANGAY 8</option>
                    <option value="BARANGAY 9">BARANGAY 9</option>
                    <option value="BANTAYAN">BARANGAY BANTAYAN</option>
                    <option value="BINICUIL">BARANGAY BINICUIL</option>
                    <option value="CAMANSI">BARANGAY CAMANSI</option>
                    <option value="CAMINGAWAN">BARANGAY CAMINGAWAN</option>
                    <option value="CAMUGAO">BARANGAY CAMUGAO</option>
                    <option value="CAROL-AN">BARANGAY CAROL-AN</option>
                    <option value="DAAN BANUA">BARANGAY DAAN BANUA</option>
                    <option value="HILAMONAN">BARANGAY HILAMONAN</option>
                    <option value="INAPOY">BARANGAY INAPOY</option>
                    <option value="LINAO">BARANGAY LINAO</option>
                    <option value="LOCOTAN">BARANGAY LOCOTAN</option>
                    <option value="MAGBALLO">BARANGAY MAGBALLO</option>
                    <option value="ORINGAO">BARANGAY ORINGAO</option>
                    <option value="ORONG">BARANGAY ORONG</option>
                    <option value="PINAGUINPINAN">BARANGAY PINAGUINPINAN</option>
                    <option value="SALONG">BARANGAY SALONG</option>
                    <option value="TABUGON">BARANGAY TABUGON</option>
                    <option value="TAGOC">BARANGAY TAGOC</option>
                    <option value="TAGOC">BARANGAY TAGUKON</option>
                    <option value="TALUBANGI">BARANGAY TALUBANGI</option>
                    <option value="TAMPALON">BARANGAY TAMPALON</option>
                    <option value="TAN-AWAN">BARANGAY TAN-AWAN</option>
                    <option value="TAPI">BARANGAY TAPI</option>
                  </select>
                </div>
              </div>

              <div class="row g-3 mt-3">
                <div class="col-md-6">
                  <label for="income" class="form-label fw-semibold">Monthly Income Proof</label>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="income" name="income" required>
                </div>
                <div class="col-md-6">
                  <label for="birthcert" class="form-label fw-semibold">Birth Certificate</label>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="birthcert" name="birthcert" required>
                </div>
              </div>

              <div class="row g-3 mt-3">
                <div class="col-md-6">
                  <label for="comelec" class="form-label fw-semibold">COMELEC Certificate</label>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="comelec" name="comelec" required>
                </div>
                <div class="col-md-6">
                  <label for="card" class="form-label fw-semibold">Latest Report Card</label>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="card" name="card" required>
                </div>
              </div>

              <div class="row g-3 mt-3">
                <div class="col-md-6">
                  <label for="moral" class="form-label fw-semibold">Good Moral Certificate</label>
                  <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="moral" name="moral" required>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary w-100 fw-bold">Submit Application</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const toggleButton = document.getElementById("toggle-sidebar");
      const sidebar = document.getElementById("sidebar");
      const topBar = document.querySelector(".top-bar");

      toggleButton.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
        topBar.classList.toggle("collapsed");
      });
    });
  </script>

<?php include './include/logout.php'; ?>

  <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="./script/sidebarToggle.js"></script>
</body>
</html>