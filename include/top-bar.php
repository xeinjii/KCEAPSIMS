<div class="top-bar">
    <span id="dateTime"></span>
    <span class="ms-auto">
        <i class="fas fa-user profile-icons"></i><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Guest'; ?>
    </span>
</div>

<script>
    function displayDateTime() {
        const now = new Date();
        const date = now.toLocaleDateString();
        const time = now.toLocaleTimeString();
        document.getElementById('dateTime').innerHTML = `Date: ${date} Time: ${time}`;
    }
    displayDateTime();
    setInterval(displayDateTime, 1000);
</script>