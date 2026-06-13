<?php
include 'config/auth.php';

logoutUser();
header('Location: index.php');
exit();
?>