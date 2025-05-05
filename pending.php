<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
include './include/header2.php';

// Fetch college pending data
$query = "SELECT * FROM college_pending";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query2 = "SELECT * FROM renew_college_pending";
$result2 = mysqli_query($conn, $query2);
$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$query3 = "SELECT * FROM hspending";
$result3 = mysqli_query($conn, $query3);
$rows3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
?>

<style>
.pending-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    padding: 20px;
    margin-left: 240px;
    max-width: 950px;
}

.pending-row {
    display: flex;
    gap: 35px;
    justify-content: space-between;
}

.pending-container .card {
    background: white;
    padding: 20px;
    flex: 1;
    min-width: 300px;
    height: 130px;
    box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.4s, box-shadow 0.3s;
    cursor: pointer;
    text-decoration: none;
    color: black;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.pending-container .card .material-symbols-outlined {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 30px;
    color: black;
}

.pending-container .card:hover {
    background-color: #f5f5f5;
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

</style>

<body>
    <?php include './include/aside.php'; ?>

    <div class="top-bar">
        <h4><strong>PENDING LIST</strong></h4>
    </div><br>




    <div class="pending-container">
    <!-- College Pair -->
    <div class="pending-row">
        <a class="card" href="#" data-bs-toggle="modal" data-bs-target="#collegePendingModal">
            <span><strong>COLLEGE APPLICANTS PENDING LIST</strong></span>
            <p>TOTAL: <?php echo mysqli_num_rows($result); ?></p>
            <span class="material-symbols-outlined">pending_actions</span>
        </a>
        <a class="card" href="#" data-bs-toggle="modal" data-bs-target="#collegeRenewModal">
            <span><strong>COLLEGE APPLICANTS RENEW LIST</strong></span>
            <p>TOTAL: <?php echo mysqli_num_rows($result2); ?></p>
            <span class="material-symbols-outlined">pending_actions</span>
        </a>
    </div>

    <!-- Highschool Pair -->
    <div class="pending-row">
        <a class="card" href="#" data-bs-toggle="modal" data-bs-target="#highschoolPendingModal">
            <span><strong>HIGHSCHOOL APPLICANTS PENDING LIST</strong></span>
            <p>TOTAL: <?php echo mysqli_num_rows($result3); ?></p>
            <span class="material-symbols-outlined">pending_actions</span>
        </a>
        <a class="card" href="#" data-bs-toggle="modal" data-bs-target="#highschoolRenewModal">
            <span><strong>HIGHSCHOOL APPLICANTS RENEW LIST</strong></span>
            <p>TOTAL: 5</p>
            <span class="material-symbols-outlined">pending_actions</span>
        </a>
    </div>
</div>
   

<!-- Reminder Design -->
<?php if (isset($_SESSION['reminder'])): ?>
    <div class="reminder-overlay">
        <div class="reminder-box">
            <p><?php echo htmlspecialchars($_SESSION['reminder']); ?></p>
            <button class="btn btn-primary" onclick="closeReminder()">OK</button>
        </div>
    </div>
    <script>
        function closeReminder() {
            document.querySelector('.reminder-overlay').style.display = 'none';
        }
    </script>
    <?php unset($_SESSION['reminder']); ?>
<?php endif; ?>

<style>
    .reminder-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .reminder-box {
        background: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 90%;
    }

    .reminder-box p {
        margin-bottom: 20px;
        font-size: 16px;
        color: #333;
    }

    .reminder-box button {
        padding: 10px 20px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .reminder-box button:hover {
        background: #0056b3;
    }
</style>





    <!-- College Pending Modal -->
    <div class="modal fade" id="collegePendingModal" tabindex="-1" aria-labelledby="collegePendingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="collegePendingModalLabel">College Pending Applications</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>School</th>
                                    <th>Course & Year</th>
                                    <th>Submitted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['school']); ?></td>
                                        <td><?php echo htmlspecialchars($row['courseYear']); ?></td>
                                        <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                                        <td>
                                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#capplyviewDetailsModal<?php echo $row['id']; ?>">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modals (outside of table for correct rendering) -->
    <?php foreach ($rows as $row): ?>
        <div class="modal fade" id="capplyviewDetailsModal<?php echo $row['id']; ?>" tabindex="-1"
            aria-labelledby="viewDetailsModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="viewDetailsModalLabel<?php echo $row['id']; ?>">Application Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                                <p><strong>School:</strong> <?php echo htmlspecialchars($row['school']); ?></p>
                                <p><strong>Course & Year:</strong> <?php echo htmlspecialchars($row['courseYear']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['number']); ?></p>
                                <p><strong>Semester:</strong> <?php echo htmlspecialchars($row['semester']); ?></p>
                                <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($row['submitted_at']); ?></p>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Documents:</strong></p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="./College_documents/<?php echo htmlspecialchars($row['income']); ?>" target="_blank">
                                    Income Proof
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="./College_documents/<?php echo htmlspecialchars($row['birthcert']); ?>" target="_blank">
                                    Birth Certificate
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="./College_documents/<?php echo htmlspecialchars($row['comelec']); ?>" target="_blank">
                                    COMELEC Certificate
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="./College_documents/<?php echo htmlspecialchars($row['card']); ?>" target="_blank">
                                    Report Card
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="./College_documents/<?php echo htmlspecialchars($row['moral']); ?>" target="_blank">
                                    Good Moral Certificate
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <form method="POST" action="processApplication.php" class="w-100 d-flex gap-2">
                            <input type="hidden" name="application_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="accept" class="btn btn-success flex-grow-1">Accept</button>
                            <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal" 
                                data-bs-target="#rejectModal<?php echo $row['id']; ?>">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal<?php echo $row['id']; ?>" tabindex="-1" 
            aria-labelledby="rejectModalLabel<?php echo $row['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="rejectModalLabel<?php echo $row['id']; ?>">
                            <i class="bi bi-x-circle-fill"></i> Reject Application
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form method="POST" action="processApplication.php">
                        <div class="modal-body">
                            <input type="hidden" name="application_id" value="<?php echo $row['id']; ?>">
                            <div class="mb-3">
                                <label for="rejection_message<?php echo $row['id']; ?>" class="form-label">
                                    <strong>Rejection Message</strong>
                                </label>
                                <textarea class="form-control border-danger" id="rejection_message<?php echo $row['id']; ?>"
                                    name="rejection_message" rows="4" placeholder="Provide a reason for rejection..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-arrow-left-circle"></i> Cancel
                            </button>
                            <button type="submit" name="reject" class="btn btn-danger">
                                <i class="bi bi-send-fill"></i> Send Rejection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <!-- College Renew Pending Modal -->
<div class="modal fade" id="collegeRenewModal" tabindex="-1" aria-labelledby="collegeRenewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="collegeRenewModalLabel">College Renew Pending Applications</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Id</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch college renew pending data
                            $renewQuery = "SELECT * FROM renew_college_pending";
                            $renewResult = mysqli_query($conn, $renewQuery);
                            $renewRows = mysqli_fetch_all($renewResult, MYSQLI_ASSOC);

                            foreach ($renewRows as $renewRow): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($renewRow['name']); ?></td>
                                    <td><?php echo htmlspecialchars($renewRow['submitted_at']); ?></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewRenewDetailsModal<?php echo $renewRow['id']; ?>">View</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Renew Details Modals -->
<?php foreach ($renewRows as $renewRow): ?>
    <div class="modal fade" id="viewRenewDetailsModal<?php echo $renewRow['id']; ?>" tabindex="-1"
        aria-labelledby="viewRenewDetailsModalLabel<?php echo $renewRow['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewRenewDetailsModalLabel<?php echo $renewRow['id']; ?>">Renewal Application Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            // Fetch the name from the records table using the id in the name field of renew_college_pending
                            $recordId = $renewRow['name'];
                            $recordQuery = "SELECT name FROM records WHERE id = ?";
                            $stmt = $conn->prepare($recordQuery);
                            $stmt->bind_param("i", $recordId);
                            $stmt->execute();
                            $recordResult = $stmt->get_result();
                            $record = $recordResult->fetch_assoc();
                            ?>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($record['name']); ?></p>
                            <p><strong>Semester:</strong> <?php echo htmlspecialchars($renewRow['semester']); ?></p>
                            <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($renewRow['submitted_at']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Renewal ID:</strong> <?php echo htmlspecialchars($renewRow['id']); ?></p>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Documents:</strong></p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="./College_documents/<?php echo htmlspecialchars($renewRow['comelec_certificate']); ?>" target="_blank">
                                COMELEC Certificate
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./College_documents/<?php echo htmlspecialchars($renewRow['grades']); ?>" target="_blank">
                                Complete Grades
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./College_documents/<?php echo htmlspecialchars($renewRow['enrollment_certificate']); ?>" target="_blank">
                                Enrollment Certificate
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form method="POST" action="processRenewApplication.php" class="w-100 d-flex gap-2">
                        <input type="hidden" name="renew_application_id" value="<?php echo $renewRow['id']; ?>">
                        <button type="submit" name="accept" class="btn btn-success flex-grow-1">Accept</button>
                        <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal"
                            data-bs-target="#rejectRenewModal<?php echo $renewRow['id']; ?>">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Renew Modal -->
    <div class="modal fade" id="rejectRenewModal<?php echo $renewRow['id']; ?>" tabindex="-1"
        aria-labelledby="rejectRenewModalLabel<?php echo $renewRow['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectRenewModalLabel<?php echo $renewRow['id']; ?>">
                        <i class="bi bi-x-circle-fill"></i> Reject Renewal Application
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" action="processRenewApplication.php">
                    <div class="modal-body">
                        <input type="hidden" name="renew_application_id" value="<?php echo $renewRow['id']; ?>">
                        <div class="mb-3">
                            <label for="rejection_message<?php echo $renewRow['id']; ?>" class="form-label">
                                <strong>Rejection Message</strong>
                            </label>
                            <textarea class="form-control border-danger" id="rejection_message<?php echo $renewRow['id']; ?>"
                                name="rejection_message" rows="4" placeholder="Provide a reason for rejection..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-arrow-left-circle"></i> Cancel
                        </button>
                        <button type="submit" name="reject" class="btn btn-danger">
                            <i class="bi bi-send-fill"></i> Send Rejection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Highschool Pending Modal -->
<div class="modal fade" id="highschoolPendingModal" tabindex="-1" aria-labelledby="highschoolPendingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="highschoolPendingModalLabel">Highschool Pending Applications</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Name</th>
                                <th>School</th>
                                <th>Grade Level</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch highschool pending data
                            $hsQuery = "SELECT * FROM hspending";
                            $hsResult = mysqli_query($conn, $hsQuery);
                            $hsRows = mysqli_fetch_all($hsResult, MYSQLI_ASSOC);

                            foreach ($hsRows as $hsRow): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($hsRow['name']); ?></td>
                                    <td><?php echo htmlspecialchars($hsRow['school']); ?></td>
                                    <td><?php echo htmlspecialchars($hsRow['gradelvl']); ?></td>
                                    <td><?php echo htmlspecialchars($hsRow['submitted_at']); ?></td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewHSDetailsModal<?php echo $hsRow['id']; ?>">View</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View HS Details Modals -->
<?php foreach ($hsRows as $hsRow): ?>
    <div class="modal fade" id="viewHSDetailsModal<?php echo $hsRow['id']; ?>" tabindex="-1"
        aria-labelledby="viewHSDetailsModalLabel<?php echo $hsRow['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewHSDetailsModalLabel<?php echo $hsRow['id']; ?>">Application Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($hsRow['name']); ?></p>
                            <p><strong>School:</strong> <?php echo htmlspecialchars($hsRow['school']); ?></p>
                            <p><strong>Grade Level:</strong> <?php echo htmlspecialchars($hsRow['gradelvl']); ?></p>
                            <p><strong>Strand:</strong> <?php echo htmlspecialchars($hsRow['strand']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($hsRow['number']); ?></p>
                            <p><strong>Semester:</strong> <?php echo htmlspecialchars($hsRow['semester']); ?></p>
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($hsRow['address']); ?></p>
                            <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($hsRow['submitted_at']); ?></p>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Documents:</strong></p>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="./HS_documents/<?php echo htmlspecialchars($hsRow['income']); ?>" target="_blank">
                                Income Proof
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./HS_documents/<?php echo htmlspecialchars($hsRow['birthcert']); ?>" target="_blank">
                                Birth Certificate
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./HS_documents/<?php echo htmlspecialchars($hsRow['comelec']); ?>" target="_blank">
                                COMELEC Certificate
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./HS_documents/<?php echo htmlspecialchars($hsRow['card']); ?>" target="_blank">
                                Report Card
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="./HS_documents/<?php echo htmlspecialchars($hsRow['moral']); ?>" target="_blank">
                                Good Moral Certificate
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form method="POST" action="hsprocessapplication.php" class="w-100 d-flex gap-2">
                        <input type="hidden" name="application_id" value="<?php echo $hsRow['id']; ?>">
                        <input type="hidden" name="application_type" value="highschool">
                        <button type="submit" name="accept" class="btn btn-success flex-grow-1">Accept</button>
                        <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal"
                            data-bs-target="#rejectHSModal<?php echo $hsRow['id']; ?>">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject HS Modal -->
    <div class="modal fade" id="rejectHSModal<?php echo $hsRow['id']; ?>" tabindex="-1"
        aria-labelledby="rejectHSModalLabel<?php echo $hsRow['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectHSModalLabel<?php echo $hsRow['id']; ?>">
                        <i class="bi bi-x-circle-fill"></i> Reject Application
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="hsprocessapplication.php">
                    <div class="modal-body">
                        <input type="hidden" name="application_id" value="<?php echo $hsRow['id']; ?>">
                        <input type="hidden" name="application_type" value="highschool">
                        <div class="mb-3">
                            <label for="rejection_message<?php echo $hsRow['id']; ?>" class="form-label">
                                <strong>Rejection Message</strong>
                            </label>
                            <textarea class="form-control border-danger" id="rejection_message<?php echo $hsRow['id']; ?>"
                                name="rejection_message" rows="4" placeholder="Provide a reason for rejection..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-arrow-left-circle"></i> Cancel
                        </button>
                        <button type="submit" name="reject" class="btn btn-danger">
                            <i class="bi bi-send-fill"></i> Send Rejection
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



    <?php include './include/logout.php'; ?>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>