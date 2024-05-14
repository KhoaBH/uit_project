<?php
session_start();

if (isset($_POST["data"])) {
    $_SESSION['class_id'] = $_POST["data"];
}
?>