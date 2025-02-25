<?php
session_start();
include '../components/dbConnect.php';

/*For $_SESSION*/
if (isset($_SESSION['id'])) {
    $tutor_id = $_SESSION['id'];
} else {
    header('Location: logIn.php');
    // $tutor_id = '';
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar_style.css">
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <link rel="stylesheet" href="../css/footer_style.css">
</head>
<body>
    <?php include '../components/navbar.php'; ?>
    <section class="dashboard">
        <h1 class="heading">Dashboard</h1>
        
    </section>
    <?php include '../components/footer.php'; ?>
    <script type="text/javascript" src="../js/navbar.js"></script>
</body>
</html>