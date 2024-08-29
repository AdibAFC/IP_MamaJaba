<?php
session_start();
session_unset();
session_destroy();
header('Location: ../IP_MamaJaba/Landing_Page/index.php');
exit;
?>
