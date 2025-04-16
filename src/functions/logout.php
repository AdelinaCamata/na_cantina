<?php

function logout() {
    session_start();
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['isAuthenticated']);

    header("location: login.php");
}