<?php
// logout.php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head><title>Logging out...</title></head>
<body>
<script>
    localStorage.removeItem('userLoggedIn');
    localStorage.removeItem('userEmail');
    window.location.href = 'login.php';
</script>
</body>
</html>