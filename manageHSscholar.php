<?php
session_start();

include("config/config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

$select_name = mysqli_query($conn, "SELECT * FROM hsrecords ORDER by name ASC");

$select_name = mysqli_query($conn, "SELECT * FROM hsrecords");


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM hsrecords WHERE id = $id");
    header('location: manageHSscholar.php');
}
include './include/header2.php';
?>

<body>

    <style>
        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #2845d6;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .header-bar h2 {
            margin: 0;
            font-size: 20px;
        }

        .search-box {
            width: 250px;
            padding: 5px;
            border-radius: 5px;
            border: none;
            outline: none;
        }

        .action-btns a {
            text-decoration: none;
            margin-right: 5px;
        }

        .scroll-data {
            max-height: 500px;
            overflow-y: auto;
        }

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
    </style>

    <?php include './include/aside.php'; ?>

    <div class="top-bar">
        <h3><strong>SENIOR HIGHSCHOOL BENEFIACIARY</strong></h3>
        <a href="manageCollegeScholar.php"><strong>OPEN COLLEGE SCHOLAR</strong></a>
    </div>

    <div class="container managetable mt-4">
        <div class="table-container col-10">
            <!-- Navbar/Header for Table -->
            <div class="header-bar">
                <div class="header-left">
                    <h2><strong>MANAGE SENIOR HIGHSCHOOL SCHOLAR</strong></h2>
                    <div class="search-container">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by Name..." />
                    </div>
                </div>
                <div class="header-right">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addhs">+ Add
                        Beneficiary</button>
                </div>
            </div>

            <div class="scroll-data col-md-12">
                <table class="table table-bordered table-light table-hover" id="scholarTable">
                    <thead class="table-light">

                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">School</th>
                            <th scope="col">Grade level</th>
                            <th scope="col">Strand</th>
                            <th scope="col">Barangay</th>
                            <th scope="col">PhoneNumber</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        while ($row = mysqli_fetch_assoc($select_name)) {
                            ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['school']; ?></td>
                                <td class="text-center"><?php echo $row['gradelvl']; ?></td>
                                <td><?php echo $row['strand']; ?></td>
                                <td><?php echo $row['brgy']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td class="action-btns">
                                    <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>"
                                        data-school="<?php echo $row['school']; ?>"
                                        data-gradelvl="<?php echo $row['gradelvl']; ?>"
                                        data-strand="<?php echo $row['strand']; ?>"
                                        data-brgy="<?php echo $row['brgy']; ?>" data-phone="<?php echo $row['phone']; ?>">
                                        <i class='bx bx-edit bx-sm' style="color: yellow;"></i>
                                    </a>
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



    <!-- add modal-->
    <div class="modal fade" id="addhs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Highschool Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBeneficiaryForm" action="addhsbeneficiary.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="school" class="form-label">School</label>
                            <select class="form-select" id="school" name="school" required>
                                <option disabled selected>Select school...</option>
                                <option value="TABUGON-NHS">FBC-HIGHSCHOOL</option>
                                <Option value="SC-HIGHSCHOOL" >SOUTHLAND-HIGHSCHOOL</Option>
                                <Option value="KCC-HIGHSCHOOL">KCC-HIGHSCHOOL</Option>
                                <Option value="MCHS">MCHS</Option>
                                <Option value="SNAA">SNAA</Option>
                                <Option value="FC">FORTRESS COLLEGE</Option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="gradelvl" class="form-label">Grade lvl</label>
                            <select class="form-select" id="gradelvl" name="gradelvl" required>
                                <option disabled selected>Select grade lvl...</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-strand" class="form-label">Strand</label>
                            <select class="form-select" id="strand" name="strand" required>
                                <option disabled selected>Select strand...</option>
                                <option value="HUMMS">HUMMS</option>
                                <option value="STEM">STEM</option>
                                <option value="GAS">GAS</option>
                                <option value="ICT">ICT</option>
                                
                            </select>
                        </div>

                        <div class="mb-3">
                        <label for="brgy" class="form-label">Barangay</label>
                        <select class="form-select" name="brgy" id="brgy" required>
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
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary" form="addBeneficiaryForm">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="hsedit.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-school" class="form-label">School</label>
                            <select class="form-select" id="edit-school" name="school" required>
                                <option disabled selected>Select school...</option>
                                <option value="FBC-HIGHSCHOOL">FBC-HIGHSCHOOL</option>
                                <Option value="SC-HIGHSCHOOL" >SOUTHLAND-HIGHSCHOOL</Option>
                                <Option value="KCC-HIGHSCHOOL">KCC-HIGHSCHOOL</Option>
                                <Option value="MCHS">MCHS</Option>
                                <Option value="SNAA">SNAA</Option>
                                <Option value="FC">FORTRESS COLLEGE</Option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-gradelvl" class="form-label">Grade lvl</label>
                            <select class="form-select" id="edit-gradelvl" name="gradelvl" required>
                                <option disabled selected>Select grade lvl...</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-strand" class="form-label">Strand</label>
                            <select class="form-select" id="edit-strand" name="strand" required>
                                <option disabled selected>Select strand...</option>
                                <option value="HUMMS">HUMMS</option>
                                <option value="STEM">STEM</option>
                                <option value="GAS">GAS</option>
                                <option value="ICT">ICT</option>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label for="brgy" class="form-label">Barangay</label>
                        <select class="form-select" name="brgy" id="edit-brgy" required>
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

                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Phone Number</label>
                            <input type="tel" pattern="[0-9]*" inputmode="numeric" maxlength="11" pattern="\d{11}"
                                class="form-control" id="edit-phone" name="phone" required>
                        </div>
                        <div class="modal-footer">
                            <button name="submit" type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Delete Modal -->
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
                <a id="confirmDelete" href="#" class="btn btn-link ms-5" style="text-decoration: none;">Yes</a>
            </div>
        </div>
    </div>
</div>
 

<?php
if (isset($_SESSION['sss'])) {
?>
    <div class="alert-box">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Success! <!-- Removed the <strong> tag -->
            <?php echo $_SESSION['sss']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php
    unset($_SESSION['sss']); // Clear the session after displaying the message
}
?>



 
    <?php include './script/highschool.php';?>
   

    <!-- log out moda'-->
    <?php include './include/logout.php'; ?>

     <!-- Script -->
    <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script/function.js"></script>
</body>

</html>