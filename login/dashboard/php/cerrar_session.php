<meta charset="UTF-8">
<?php

session_start();
session_destroy();
header("Location:/PROYECTO/index.html");
error_reporting(0);
?>