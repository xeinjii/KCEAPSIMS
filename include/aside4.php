<?php
// Fetch the number of unread notifications for the logged-in user
$user_id = $_SESSION['user_id'];
$notif_query = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = ? AND is_read = 0";
$stmt = $conn->prepare($notif_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$notif_count = $result->fetch_assoc()['unread_count'];
?>
<!-- Aside -->
<aside id="sidebar">
<div style="justify-content: center; display: flex; align-items: center; flex-direction: column;">
        <img src="img/logo.png" alt="logo" width="70" height="auto">
    </div><br>
    <h4 class="text-center"><strong>KCEAP</strong></h4>
  <div class="side-bar">
    <ul>
      <li><a href="hsprofile.php"><span class="material-symbols-outlined icons">person</span>Profile</a></li>
      <hr>
      <li><a href="hsmainpage.php"><span class="material-symbols-outlined icons">description</span>Form</a></li>
      <hr>
      <li>
      <a href="hsnotification.php">
          <span class="material-symbols-outlined icons">notifications</span>Notification
          <?php if ($notif_count > 0): ?>
            <span class="badge bg-danger ms-2"><?php echo $notif_count; ?></span>
          <?php endif; ?>
        </a>
      </li>
      <hr>
      <li><a href="#"  data-bs-toggle="modal" data-bs-target="#logout"><span class="material-symbols-outlined icons">logout</span>Logout</a></li>
    </ul>
  </div>
</aside>

<!-- log out -->
<div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Log out?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <form action="logout.php" method="post">
            <button type="button" class="btn btn-link me-5" data-bs-dismiss="modal"
              style="text-decoration: none;">No</button>
            <button type="submit" name="submit" class="btn btn-link ms-5" style="text-decoration: none;">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div> 