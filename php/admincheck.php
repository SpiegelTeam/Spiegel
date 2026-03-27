<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    echo "<script>
            alert('You have not been given access to the admin dashboards');
            window.location.href = '../index.php';
          </script>";
    exit();
}
