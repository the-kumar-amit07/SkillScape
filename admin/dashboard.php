<?php
session_start();
include '../components/dbConnect.php';

/*For $_COOKIE*/
// if (isset($_COOKIE['tutor_id'])) {
//     $tutor_id = $_COOKIE['tutor_id'];
// } else {
    
//     $tutor_id = '';
//     header('Location: logIn.php');
// }

/*For $_SESSION*/
if (isset($_SESSION['id'])) {
    $tutor_id = $_SESSION['id'];
} else {
    header('Location: logIn.php');
    // $tutor_id = '';
}
?>

<style>
    <?php include '../css/admin_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>
    <?php include '../components/navbar.php'; ?>
</body>
</html>