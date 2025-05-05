<?php
session_start();
include '../config/config.php';
include '../include/header3.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$select_accounts = mysqli_query($conn, "SELECT * FROM accounts WHERE user_type = 'admin' OR user_type = 'staff' ORDER BY name ASC");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM accounts WHERE id = $id");
    header('location: adminaccounts.php');
    exit();
}
?>

<body>
    <?php
    include '../include/aside2.php';
    include '../include/top-bar.php';
    ?><br>

    <div class="container managetable mt-0 center-table">
        <div class="table-container col-10">
            <!-- Navbar/Header for Table -->
            <div class="header-bar">
                <div class="header-left">
                    <h2><strong>ADMIN ACCOUNTS</strong></h2>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by Name..." />
                    </div>
                </div>
                <div class="header-right">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSC">+ Add new
                        user</button>
                </div>
            </div>

            <div class="col-md-12 scroll-data">
                <table class="table table-bordered table-light table-hover" id="scholarTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">User_type</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      while ($row = mysqli_fetch_assoc($select_accounts)) {
                    ?>
                        <tr data-id="<?php echo $row['id']; ?>">
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['user_type']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td class="action-btns">
                                <a class="delete-btn" data-bs-toggle="modal" href="#deleteModal" data-id="<?php echo $row['id']; ?>">
                                    <i class='bx bxs-trash-alt bx-sm' style="color: red;"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                Are you sure you want to delete this account?
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-link me-5" data-bs-dismiss="modal"
                    style="text-decoration: none;">No</button>
                <a id="confirmDelete" href="#" class="btn btn-link ms-5" style="text-decoration: none;">Yes</a>
            </div>
        </div>
    </div>
</div>

    <?php include '../script/college.php'; ?>
    <?php include '../include/adminlogout.php'; ?>

    <script type="text/javascript" src="../script/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal');
            var confirmDelete = document.getElementById('confirmDelete');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                confirmDelete.href = 'accounts.php?delete=' + id;
            });
        });
    </script>
</body>

</html>