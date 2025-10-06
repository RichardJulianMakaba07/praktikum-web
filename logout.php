<?php
session_start();
$_SESSION['welcome_message'] = "Anda telah logout. Sampai jumpa lagi!";
session_unset();
session_destroy();
header("Location: login.php");
exit;
?>