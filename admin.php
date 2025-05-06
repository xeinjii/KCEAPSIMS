<?php
session_start();
include 'config/config.php';
include './include/displaydata.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];

include './include/header2.php';
?>

<style>

    .main-content {
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .container-fluid {
        padding-right: 10px;
        padding-left: 30px;
    }

    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15);
    }

    
</style>

<body>
    <?php include './include/aside.php'; ?>

    <!-- Header -->
    <div class="top-bar fixed-top">
        <h4><strong>TOTAL SCHOLAR</strong></h4>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Cards -->
        <div class="container-fluid mt-5">
            <div class="row">
                <!-- Total Schools Card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="material-symbols-outlined text-primary" style="font-size: 48px;">school</span>
                                <div class="ms-3">
                                    <h5 class="card-title">Total Schools</h5>
                                    <?php
                                    // Get unique schools from both records and hsrecords
                                    $school_query = "SELECT COUNT(DISTINCT school) as total FROM 
                                        (SELECT school FROM records 
                                         UNION 
                                         SELECT school FROM hsrecords) as combined_schools";
                                    $school_result = mysqli_query($conn, $school_query);
                                    $school_count = mysqli_fetch_assoc($school_result)['total'];
                                    ?>
                                    <h2 class="mb-0"><?php echo $school_count; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total College Scholars Card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="material-symbols-outlined text-success" style="font-size: 48px;">school</span>
                                <div class="ms-3">
                                    <h5 class="card-title">College Scholars</h5>
                                    <?php
                                    $college_query = "SELECT COUNT(*) as total FROM records";
                                    $college_result = mysqli_query($conn, $college_query);
                                    $college_count = mysqli_fetch_assoc($college_result)['total'];
                                    ?>
                                    <h2 class="mb-0"><?php echo $college_count; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total High School Scholars Card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="material-symbols-outlined text-warning" style="font-size: 48px;">school</span>
                                <div class="ms-3">
                                    <h5 class="card-title">HS Scholars</h5>
                                    <?php
                                    $hs_query = "SELECT COUNT(*) as total FROM hsrecords";
                                    $hs_result = mysqli_query($conn, $hs_query);
                                    $hs_count = mysqli_fetch_assoc($hs_result)['total'];
                                    ?>
                                    <h2 class="mb-0"><?php echo $hs_count; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <!-- Schools Table -->
                <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Schools and Records</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>School</th>
                                            <th class="text-center">College Students</th>
                                            <th class="text-center">High School Students</th>
                                            <th class="text-center">Total Students</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Get schools that have actual records
                                        $schools_query = "SELECT DISTINCT school FROM 
                                            (SELECT school FROM records 
                                             UNION 
                                             SELECT school FROM hsrecords 
                                             WHERE school IS NOT NULL AND school != '') as schools 
                                        ORDER BY school ASC";
                                        $schools_result = mysqli_query($conn, $schools_query);
                                        
                                        while ($school = mysqli_fetch_assoc($schools_result)) {
                                            $school_name = $school['school'];
                                            
                                            // Get college students count
                                            $college_query = "SELECT COUNT(*) as count FROM records 
                                                            WHERE school = '" . mysqli_real_escape_string($conn, $school_name) . "'";
                                            $college_result = mysqli_query($conn, $college_query);
                                            $college_count = mysqli_fetch_assoc($college_result)['count'];
                                            
                                            // Get high school students count
                                            $hs_query = "SELECT COUNT(*) as count FROM hsrecords 
                                                        WHERE school = '" . mysqli_real_escape_string($conn, $school_name) . "'";
                                            $hs_result = mysqli_query($conn, $hs_query);
                                            $hs_count = mysqli_fetch_assoc($hs_result)['count'];
                                            
                                            $total_students = $college_count + $hs_count;
                                            
                                            // Only display schools with at least one student
                                            if ($total_students > 0) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($school_name); ?></td>
                                                <td class="text-center"><?php echo $college_count; ?></td>
                                                <td class="text-center"><?php echo $hs_count; ?></td>
                                                <td class="text-center"><strong><?php echo $total_students; ?></strong></td>
                                            </tr>
                                        <?php 
                                            }
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Data holder -->
    <?php include './include/data.php' ?>

    <!-- log out modal-->
    <?php include './include/logout.php'; ?>

    <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
</body>
</html>