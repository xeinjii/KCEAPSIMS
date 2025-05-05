<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];


$select_name = mysqli_query($conn, "SELECT * FROM records ORDER BY name ASC");

include './include/header2.php';

// Pagination logic
$limit = 10; // Number of rows per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// Check if a search query is provided
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Modify the query to include search functionality
if (!empty($search)) {
    $select_name = mysqli_query($conn, "SELECT * FROM records WHERE name LIKE '%$search%' OR school LIKE '%$search%' OR brgy LIKE '%$search%' ORDER BY name ASC LIMIT $limit OFFSET $offset");
    $total_rows_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM records WHERE name LIKE '%$search%' OR school LIKE '%$search%' OR brgy LIKE '%$search%'");
} else {
    $select_name = mysqli_query($conn, "SELECT * FROM records ORDER BY name ASC LIMIT $limit OFFSET $offset");
    $total_rows_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM records");
}


$total_rows = mysqli_fetch_assoc($total_rows_query)['total'];
$total_pages = ceil($total_rows / $limit);

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM records WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['add'] = "Record deleted successfully.";
    } else {
        $_SESSION['add'] = "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    header('Location: manageCollegeScholar.php');
    exit();
}

if (isset($_GET['delete_hs'])) {
    $id = intval($_GET['delete_hs']);
    $stmt = $conn->prepare("DELETE FROM hsrecords WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['add'] = "Record deleted successfully.";
    } else {
        $_SESSION['add'] = "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    header('Location: manageCollegeScholar.php?table=highschool');
    exit();
}

$hs_limit = 10;
$hs_page = isset($_GET['hs_page']) ? intval($_GET['hs_page']) : 1;
$hs_offset = ($hs_page - 1) * $hs_limit;


$select_highschool = mysqli_query($conn, "SELECT * FROM hsrecords ORDER BY name ASC LIMIT $hs_limit OFFSET $hs_offset");


$total_hs_rows_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM hsrecords");
$total_hs_rows = mysqli_fetch_assoc($total_hs_rows_query)['total'];
$total_hs_pages = ceil($total_hs_rows / $hs_limit);

// Check if a search query is provided for high school
$hs_search = isset($_GET['hs_search']) ? mysqli_real_escape_string($conn, $_GET['hs_search']) : '';

if (!empty($hs_search)) {
    $select_highschool = mysqli_query($conn, "SELECT * FROM hsrecords WHERE name LIKE '%$hs_search%' OR school LIKE '%$hs_search%' OR brgy LIKE '%$hs_search%' ORDER BY name ASC LIMIT $hs_limit OFFSET $hs_offset");
    $total_hs_rows_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM hsrecords WHERE name LIKE '%$hs_search%' OR school LIKE '%$hs_search%' OR brgy LIKE '%$hs_search%'");
} else {
    $select_highschool = mysqli_query($conn, "SELECT * FROM hsrecords ORDER BY name ASC LIMIT $hs_limit OFFSET $hs_offset");
    $total_hs_rows_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM hsrecords");
}

$total_hs_rows = mysqli_fetch_assoc($total_hs_rows_query)['total'];
$total_hs_pages = ceil($total_hs_rows / $hs_limit);

?>

<body>
    <style>
        .alert-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            width: 500px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .alert {
            margin: 0;
            padding: 20px;
            border-radius: 10px;
            font-size: 20px;
            min-height: 100px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* Responsive Table Styling */
.table-container {
    width: 99%;
    margin-top: 10px;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

table {
    margin-left: 225px;
    width: 85%;
    font-size: 16px;
    text-align: center;
    min-width: 700px; 
}

thead th {
    top: 0;
    background-color: #2845d6;
    color: white;
    z-index: 2;
    text-transform: uppercase;
    font-weight: bold;
    padding: 8px 10px;
    border: 1px solid #ddd;
}

tbody td {
    padding: 5px 6px;
    font-size: 9px;
    border: 1px solid #ddd;
    color: #333;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

/* Add padding for smaller screens */
@media (max-width: 768px) {
    .table-container {
        padding: 10px;
    }

    table {
        font-size: 14px; /* Adjust font size for smaller screens */
    }
}
    </style>

    <?php include './include/aside.php'; ?>

    <div class="top-bar">
        <h4><strong>BENEFICIARY MANAGEMENT</strong></h4>
    </div>


<!-- SEARCH BAR SECTION -->
<div class="d-flex justify-content-end align-items-center gap-3" style="margin: 20px;">
    <!-- Radio Toggle -->
    <div class="radio-group d-flex align-items-center me-3">
        <label class="me-3 mb-0">
            <input type="radio" name="tableToggle" value="college" checked> College
        </label>
        <label class="mb-0">
            <input type="radio" name="tableToggle" value="highschool"> High School
        </label>
    </div>

    <!-- College Search Form -->
    <div id="collegeSearchContainer" style="width: auto;">
        <form method="GET" action="manageCollegeScholar.php" class="d-flex align-items-center gap-2">
            <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search by Name..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                <a href="manageCollegeScholar.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- High School Search Form -->
    <div id="highschoolSearchContainer" style="width: auto; display: none;">
        <form method="GET" action="manageCollegeScholar.php" class="d-flex align-items-center gap-2">
            <input type="hidden" name="table" value="highschool">
            <input type="text" id="hsSearchInput" name="hs_search" class="form-control" placeholder="Search by Name..." value="<?php echo isset($_GET['hs_search']) ? htmlspecialchars($_GET['hs_search']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if (isset($_GET['hs_search']) && !empty($_GET['hs_search'])): ?>
                <a href="manageCollegeScholar.php?table=highschool" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>
    </div>
</div>



    <div id="collegeTable" class="table-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">School</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Course/Year</th>
                    <th scope="col">Barangay</th>
                    <th scope="col">PhoneNumber</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($select_name)) {
                ?>
                    <tr data-id="<?php echo $row['id']; ?> ">
                        <td style="font-size: 12px;"><?php echo $row['name']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['school']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['semester']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['courseYear']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['brgy']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['phone']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['status']; ?></td>
                        <td>
                            <a class="edit-btn btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="<?php echo $row['id']; ?>"
                                data-name="<?php echo $row['name']; ?>"
                                data-school="<?php echo $row['school']; ?>"
                                data-semester="<?php echo $row['semester']; ?>"
                                data-courseyear="<?php echo $row['courseYear']; ?>"
                                data-brgy="<?php echo $row['brgy']; ?>"
                                data-phone="<?php echo $row['phone']; ?>">
                                Edit
                            </a>
                            <a class="delete-btn btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?php echo $row['id']; ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="collegePagination" class="pagination-container" style="text-align: center;">
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?table=college&page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?table=college&page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <div id="highschoolTable" class="table-container" style="display: none;">
        <table>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">School</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Grade/Level</th>
                    <th scope="col">Strand</th>
                    <th scope="col">Barangay</th>
                    <th scope="col">PhoneNumber</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($select_highschool)) {
                ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td style="font-size: 12px;"><?php echo $row['name']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['school']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['semester']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['gradelvl']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['strand']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['brgy']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['phone']; ?></td>
                        <td style="font-size: 12px;"><?php echo $row['status']; ?></td>
                        <td>
                            <a class="edit-btn2 btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal2"
                                data-id2="<?php echo $row['id']; ?>"
                                data-name2="<?php echo $row['name']; ?>"
                                data-school2="<?php echo $row['school']; ?>"
                                data-semester2="<?php echo $row['semester']; ?>"
                                data-gradelvl2="<?php echo $row['gradelvl']; ?>"
                                data-strand2="<?php echo $row['strand']; ?>"
                                data-brgy2="<?php echo $row['brgy']; ?>"
                                data-phone2="<?php echo $row['phone']; ?>">
                                Edit
                            </a>
                            <a class="delete-btn btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal2"
                                data-id="<?php echo $row['id']; ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- High School Pagination -->
    <div id="highschoolPagination" class="pagination-container" style="text-align: center;">
        <?php if ($total_hs_pages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($hs_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?table=highschool&hs_page=<?php echo $hs_page - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_hs_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $hs_page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?table=highschool&hs_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($hs_page < $total_hs_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?table=highschool&hs_page=<?php echo $hs_page + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>





    <?php
    if (isset($_SESSION['add'])) {
    ?>
        <div class="alert-box">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Success!
                <?php echo $_SESSION['add']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
        unset($_SESSION['add']);
    }
    ?>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-link me-5" data-bs-dismiss="modal"
                        style="text-decoration: none;">No</button>
                    <a id="confirmDelete" href="#" class="btn btn-link ms-5" style="text-decoration: none;">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal2 -->
    <div class="modal fade" id="deleteModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-link me-5" data-bs-dismiss="modal"
                        style="text-decoration: none;">No</button>
                    <a id="confirmDelete2" href="#" class="btn btn-link ms-5" style="text-decoration: none;">Yes</a>
                </div>
            </div>
        </div>
    </div>


    <?php include './script/college.php'; ?>

    <!-- log out moda'-->
    <?php include './include/logout.php'; ?>

    <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
    <script src="./script/function.js"></script>
</body>

</html>