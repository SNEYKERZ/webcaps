<?php
require '../vendor/autoload.php';

session_destroy();
header("location: ../index.php");

?>