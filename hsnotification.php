<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
include('./include/header.php');

// Mark all notifications as read
$mark_read_query = "UPDATE notifications SET is_read = 1 WHERE user_id = ?";
$stmt = $conn->prepare($mark_read_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Fetch user details
$query = "SELECT name, email, profile FROM accounts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch notifications
$notifications_query = "SELECT message, created_at FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$notifications_stmt = $conn->prepare($notifications_query);
$notifications_stmt->bind_param("i", $user_id);
$notifications_stmt->execute();
$notifications_result = $notifications_stmt->get_result();
?>

<body>
<?php include './include/aside4.php'; ?>

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

<div class="container py-3 ">
  <h1 class="text-center mb-4">Notifications</h1>
  <div class="list-group" style="max-height: 500px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px; padding: 10px;">
    <?php if ($notifications_result->num_rows > 0): ?>
      <?php while ($notification = $notifications_result->fetch_assoc()): ?>
        <div class="list-group-item mb-2" style="border: 1px solid #ddd; border-radius: 5px; padding: 10px;">
          <p class="mb-1" style="font-weight: bold;"><?php echo htmlspecialchars($notification['message']); ?></p>
          <small class="text-muted"><?php echo date('F j, Y, g:i a', strtotime($notification['created_at'])); ?></small>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="list-group-item text-center text-muted">No notifications found.</div>
    <?php endif; ?>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.getElementById("toggle-sidebar");
        const sidebar = document.getElementById("sidebar");
        const topBar = document.querySelector(".top-bar");

        toggleButton.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
            topBar.classList.toggle("collapsed");
        });
    });
</script>

<?php include './include/logout.php'; ?>
<script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
</body>
</html>