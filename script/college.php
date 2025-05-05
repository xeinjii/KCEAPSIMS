<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");

        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("edit-id").value = this.getAttribute("data-id");
                document.getElementById("edit-name").value = this.getAttribute("data-name");
                document.getElementById("edit-school").value = this.getAttribute("data-school");
                document.getElementById("edit-semester").value = this.getAttribute("data-semester");
                document.getElementById("edit-courseYear").value = this.getAttribute("data-courseyear");
                document.getElementById("edit-brgy").value = this.getAttribute("data-brgy");
                document.getElementById("edit-phone").value = this.getAttribute("data-phone");
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn2");

        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("edit-id2").value = this.getAttribute("data-id2");
                document.getElementById("edit-name2").value = this.getAttribute("data-name2");
                document.getElementById("edit-school2").value = this.getAttribute("data-school2");
                document.getElementById("edit-semester2").value = this.getAttribute("data-semester2");
                document.getElementById("edit-gradelvl2").value = this.getAttribute("data-gradelvl2");
                document.getElementById("edit-strand2").value = this.getAttribute("data-strand2");
                document.getElementById("edit-brgy2").value = this.getAttribute("data-brgy2");
                document.getElementById("edit-phone2").value = this.getAttribute("data-phone2");
            });
        });
    });

    // Make sure this script runs after DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const confirmDeleteLink = document.getElementById('confirmDelete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id').trim();
                confirmDeleteLink.href = `manageCollegeScholar.php?delete=${id}`;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const clearSearchButton = document.getElementById("clearSearchButton");
        if (clearSearchButton) {
            clearSearchButton.addEventListener("click", function(e) {
                e.preventDefault();
                const searchInput = document.getElementById("searchInput");
                searchInput.value = ""; // Clear the input field
                window.location.href = "manageCollegeScholar.php"; // Redirect to reset the table
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal2');
        var confirmDelete = document.getElementById('confirmDelete2');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            confirmDelete.href = 'manageCollegeScholar.php?delete_hs=' + id + '&table=highschool';
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const collegeSearchContainer = document.getElementById('collegeSearchContainer');
        const hsSearchContainer = document.getElementById('highschoolSearchContainer');
        const collegeTable = document.getElementById('collegeTable');
        const highschoolTable = document.getElementById('highschoolTable');
        const collegePagination = document.getElementById('collegePagination');
        const highschoolPagination = document.getElementById('highschoolPagination');
        const radios = document.querySelectorAll('input[name="tableToggle"]');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'college') {
                    collegeSearchContainer.style.display = 'block';
                    hsSearchContainer.style.display = 'none';
                    collegeTable.style.display = 'block';
                    highschoolTable.style.display = 'none';
                    collegePagination.style.display = 'block';
                    highschoolPagination.style.display = 'none';
                } else {
                    collegeSearchContainer.style.display = 'none';
                    hsSearchContainer.style.display = 'block';
                    collegeTable.style.display = 'none';
                    highschoolTable.style.display = 'block';
                    collegePagination.style.display = 'none';
                    highschoolPagination.style.display = 'block';
                }

                // Update the URL to reflect the selected table
                const url = new URL(window.location.href);
                url.searchParams.set('table', this.value);
                window.history.replaceState({}, '', url);
            });
        });

        // Load correct view based on URL param
        const urlParams = new URLSearchParams(window.location.search);
        const table = urlParams.get('table');
        if (table === 'highschool') {
            document.querySelector('input[value="highschool"]').checked = true;
            collegeSearchContainer.style.display = 'none';
            hsSearchContainer.style.display = 'block';
            collegeTable.style.display = 'none';
            highschoolTable.style.display = 'block';
            collegePagination.style.display = 'none';
            highschoolPagination.style.display = 'block';
        } else {
            document.querySelector('input[value="college"]').checked = true;
            collegeSearchContainer.style.display = 'block';
            hsSearchContainer.style.display = 'none';
            collegeTable.style.display = 'block';
            highschoolTable.style.display = 'none';
            collegePagination.style.display = 'block';
            highschoolPagination.style.display = 'none';
        }
    });
</script>

<!-- Add Modal -->
<div class="modal fade" id="addSC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add College Beneficiary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBeneficiaryForm" action="addcollegebeneficiary.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="school" class="form-label">School</label>
                        <select class="form-select" id="school" name="school" required>
                            <option disabled selected>Select school...</option>
                            <option value="CPSU-MAIN">CPSU-MAIN</option>
                            <option value="CPSU-ILOG">CPSU-ILOG</option>
                            <option value="FBC">FELLOWSHIP BAPTIST COLLEGE</option>
                            <option value="KCC">KABANKALAN CITY COLLEGE</option>
                            <option value="BACOLOD-CC">BACOLOD CITY COLLEGE</option>
                            <option value="BAGO-CC">BAGO CITY COLLEGE</option>
                            <option value="CHMSU-TALISAY">CHMSU-TALISAY</option>
                            <option value="CHMSU-BINALGAN">CHMSU-BINALBAGAN</option>
                            <option value="WVSU">WEST VISAYAS STATE UNIVERSITY</option>
                            <option value="TUP-V">TUP-V</option>
                            <option value="NORSU-MAIN">NORSU-MAIN</option>
                            <option value="LCC">LA-CARLOTA CITY COLLEGE</option>
                            <option value="SUNN">SUNN</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="courseYear" class="form-label">Course/Year</label>
                        <input type="text" class="form-control" id="courseYear" name="courseYear" required>
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
                        <input type="tel" pattern="[0-9]*" inputmode="numeric" maxlength="11" pattern="\d{11}"
                            class="form-control" id="phone" name="phone" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary" form="addBeneficiaryForm">Add
                    Beneficiary</button>
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
                <form action="editcollege.php" method="POST">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-school" class="form-label">School</label>
                        <select class="form-select" id="edit-school" name="school" required>
                            <option disabled selected>Select school...</option>
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

                    <div class="mb-3">
                        <label for="edit-school" class="form-label">Semester</label>
                        <select class="form-select" id="edit-semester" name="semester" required>
                            <option disabled selected>Select school...</option>
                            <option value="1ST SEMESTER">1ST SEMESTER</option>
                            <option value="2ND SEMESTER">2ND SEMESTER</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-courseYear" class="form-label">Course/Year</label>
                        <input type="text" class="form-control" id="edit-courseYear" name="courseYear" required>
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

<!-- Edit Modal for High School -->
<div class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="hsedit.php" method="POST">
                    <input type="hidden" id="edit-id2" name="id">

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name2" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-school" class="form-label">School</label>
                        <select class="form-select" id="edit-school2" name="school" required>
                            <option disabled selected>Select school...</option>
                            <option value="FBC-HIGHSCHOOL">FBC-HIGHSCHOOL</option>
                            <Option value="SC-HIGHSCHOOL">SOUTHLAND-HIGHSCHOOL</Option>
                            <Option value="KCC-HIGHSCHOOL">KCC-HIGHSCHOOL</Option>
                            <Option value="MCHS">MCHS</Option>
                            <Option value="SNAA">SNAA</Option>
                            <Option value="FC">FORTRESS COLLEGE</Option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-school" class="form-label">Semester</label>
                        <select class="form-select" id="edit-semester2" name="semester" required>
                            <option disabled selected>Select semester...</option>
                            <option value="1ST SEMESTER">1ST SEMESTER</option>
                            <Option value="2ND SEMESTER">2ND SEMESTER</Option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-gradelvl" class="form-label">Grade lvl</label>
                        <select class="form-select" id="edit-gradelvl2" name="gradelvl" required>
                            <option disabled selected>Select grade lvl...</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-strand" class="form-label">Strand</label>
                        <select class="form-select" id="edit-strand2" name="strand" required>
                            <option disabled selected>Select strand...</option>
                            <option value="HUMMS">HUMMS</option>
                            <option value="STEM">STEM</option>
                            <option value="GAS">GAS</option>
                            <option value="HE">TVL</option>
                            <option value="ICT">ICT</option>
                            <option value="ABM">ABM</option>
                            <option value="AFA">AFA</option>
                            <option value="IA">IA</option>
                            <option value="OTHERS">OTHERS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brgy" class="form-label">Barangay</label>
                        <select class="form-select" name="brgy" id="edit-brgy2" required>
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
                        <label for="edit-phone2" class="form-label">Phone Number</label>
                        <input type="tel" pattern="[0-9]*" inputmode="numeric" maxlength="11" pattern="\d{11}"
                            class="form-control" id="edit-phone2" name="phone" required>
                    </div>
                    <div class="modal-footer">
                        <button name="submit" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>