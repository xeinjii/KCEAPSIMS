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
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 35px;
        padding: 20px;
        margin-left: auto;
        margin-right: 50px;
        max-width: 1200px;
    }

    .card {
        background: white;
        padding: 20px;
        box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s, box-shadow 0.3s;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
        color: black;
        height: 130px;
        position: relative;
    }

    .card .material-symbols-outlined{
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        color: #555;
        color: black
    }

    .card:hover {
        background-color: #f5f5f5;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }



    .modal-body {
        max-height: 500px;
        overflow-y: auto;
    }

    .college-scholar {
        margin-left: 300px;
    }

    .college-card h3 {
        font-size: 24px;
        font-weight: bold;
    }
</style>

<body>
    <?php include './include/aside.php'; ?>

    <!-- Header -->
    <div class="top-bar fixed-top">
        <h4><strong>TOTAL SCHOLAR</strong></h4>
    </div><br><br><br><br>

    <div class="college-scholar">
        <h3><strong>COLLEGE SCHOLAR</strong></h3>
    </div>
    <div class="college-card">
        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <a href="#" class="card cpsu" data-bs-toggle="modal" data-bs-target="#cpsu-main">
                <span style="padding-bottom:5px;"><strong>CPSU-MAIN</strong></span>
                <p>TOTAL: <?php echo $total_students_cpsu; ?></p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="#" class="card cpsu" data-bs-toggle="modal" data-bs-target="#cpsu-ilog">
                <span style="padding-bottom:5px;"><strong>CPSU-ILOG</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px">person</span>
            </a>
            <a href="#" class="card sc" data-bs-toggle="modal" data-bs-target="#sc">
                <span style="padding-bottom:5px;"><strong>SOUTHLAND COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="#" class="card fbc" data-bs-toggle="modal" data-bs-target="#fbc">
                <span style="padding-bottom:5px;"><strong>FELLOWSHIP BAPTIST COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="#" class="card kcc" data-bs-toggle="modal" data-bs-target="#kcc">
                <span style="padding-bottom:5px;"><strong>KABANKALAN CITY COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card bcc" data-bs-toggle="modal" data-bs-target="#bacolod-cc">
                <span style="padding-bottom:5px;"><strong>BACOLOD CITY COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card bagocc" data-bs-toggle="modal" data-bs-target="#bago-cc">
                <span style="padding-bottom:5px;"><strong>BAGO CITY COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card chmsu-bil" data-bs-toggle="modal" data-bs-target="#chmsu-bil">
                <span style="padding-bottom:5px;"><strong>CHMSU-BINALBAGAN</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>

            <a href="" class="card chmsu" data-bs-toggle="modal" data-bs-target="#chmsu-main">
                <span style="padding-bottom:5px;"><strong>CHMSU-TALISAY</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card tup-v" data-bs-toggle="modal" data-bs-target="#tup-v">
                <span style="padding-bottom:5px;"><strong>TUP-V</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card norsu-main" data-bs-toggle="modal" data-bs-target="#norsu-main">
                <span style="padding-bottom:5px;"><strong>NORSU-MAIN</strong></span>
                <p>TOTAL: 21></p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card lcc" data-bs-toggle="modal" data-bs-target="#lcc">
                <span style="padding-bottom:5px;"><strong>LA CARLOTA CITY COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
            <a href="" class="card sunn" data-bs-toggle="modal" data-bs-target="#sunn">
                <span style="padding-bottom:5px;"><strong>SUNN</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 30px;">person</span>
            </a>
        </div>
    </div><br>

    <div class="college-scholar">
        <h3><strong>SENIOR HIGHSCHOOL SCHOLAR</strong></h3>
    </div>
    <div class="college-card">
        <div class="dashboard-cards">
            <a href="#" class="card sc-hs" data-bs-toggle="modal" data-bs-target="#sc-hs">
                <span style="padding-bottom:5px;"><strong>SOUTHLAND-HIGHSCHOOL</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
            <a href="#" class="card fbc-hs" data-bs-toggle="modal" data-bs-target="#fbc-hs">
                <span style="padding-bottom:5px;"><strong>FBC-HIGHSCHOOL</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
            <a href="#" class="card kcc-hs" data-bs-toggle="modal" data-bs-target="#kcc-hs">
                <span style="padding-bottom:5px;"><strong>KCC-HIGHSCHOOL</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
            <a href="#" class="card mchs" data-bs-toggle="modal" data-bs-target="#mchs">
                <span style="padding-bottom:5px;"><strong>MAGBALLO CATHOLIC HIGHSCHOOL</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
            <a href="#" class="card snaa" data-bs-toggle="modal" data-bs-target="#snaa">
                <span style="padding-bottom:5px;"><strong>SNAA</strong></span>
                <p>TOTAL: 21></p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
            <a href="#" class="card fc" data-bs-toggle="modal" data-bs-target="#fc">
                <span style="padding-bottom:5px;"><strong>FORTRESS COLLEGE</strong></span>
                <p>TOTAL: 21</p>
                <span class="material-symbols-outlined" style="font-size: 40px;">person</span>
            </a>
        </div>
    </div>


    <!-- Data holder -->
    <?php include './include/data.php' ?>

    <!-- log out modal-->
    <?php include './include/logout.php'; ?>

    <script type="text/javascript" src="./script/bootstrap.bundle.min.js"></script>
</body>

</html>