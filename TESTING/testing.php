<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="barangay" class="form-label">ADDRESS</label>
        <select class="form-control select2" name="barangay" id="barangay">
            <option disabled selected>SELECT BARANGAY.....</option>
            <option value="BARANGAY 1">BARANGAY 1</option>
            <option value="BARANGAY 2">BARANGAY 2</option>
            <option value="BARANGAY 3">BARANGAY 3</option>
            <option value="BARANGAY 4">BARANGAY 4</option>
            <option value="BARANGAY 5">BARANGAY 5</option>
            <option value="BARANGAY 6">BARANGAY 6</option>
            <option value="BARANGAY 7">BARANGAY 7</option>
            <option value="BARANGAY 8">BARANGAY 8</option>
            <option value="BARANGAY 9">BARANGAY 9</option>
            <option value="BARANGAY BANTAYAN">BARANGAY BANTAYAN</option>
            <option value="BARANGAY BINICUIL">BARANGAY BINICUIL</option>
            <option value="BARANGAY CAMANSI">BARANGAY CAMANSI</option>
            <option value="BARANGAY CAMINGAWAN">BARANGAY CAMINGAWAN</option>
            <option value="BARANGAY CAMUGAO">BARANGAY CAMUGAO</option>
            <option value="BARANGAY CAROL-AN">BARANGAY CAROL-AN</option>
            <option value="BARANGAY DAAN BANUA">BARANGAY DAAN BANUA</option>
            <option value="BARANGAY HILAMONAN">BARANGAY HILAMONAN</option>
            <option value="BARANGAY INAPOY">BARANGAY INAPOY</option>
            <option value="BARANGAY LINAO">BARANGAY LINAO</option>
            <option value="BARANGAY LOCOTAN">BARANGAY LOCOTAN</option>
            <option value="BARANGAY MAGBALLO">BARANGAY MAGBALLO</option>
            <option value="BARANGAY ORINGAO">BARANGAY ORINGAO</option>
            <option value="BARANGAY ORONG">BARANGAY ORONG</option>
            <option value="BARANGAY PINAGUINPINAN">BARANGAY PINAGUINPINAN</option>
            <option value="BARANGAY SALONG">BARANGAY SALONG</option>
            <option value="BARANGAY TABUGON">BARANGAY TABUGON</option>
            <option value="BARANGAY TAGOC">BARANGAY TAGOC</option>
            <option value="BARANGAY TAGUKON">BARANGAY TAGUKON</option>
            <option value="BARANGAY TALUBANGI">BARANGAY TALUBANGI</option>
            <option value="BARANGAY TAMPALON">BARANGAY TAMPALON</option>
            <option value="TAN-AWAN">BARANGAY TAN-AWAN</option>
            <option value="TAPI">BARANGAY TAPI</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="monthly-income" class="form-label">MONTHLY INCOME</label>
        <input type="file" class="form-control" id="monthly-income" name="monthly_income" required>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap Bundle -->
<script src="../script/bootstrap.bundle.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "SELECT BARANGAY.....",
            allowClear: true
        });
    });
</script>
</body>
</html>