<?php
session_start();
if ($_SESSION['authenticatedUser']) {
    header('Location: pages/home.php');
} else {
    header('Location: pages/login.php');
    session_unset();
}