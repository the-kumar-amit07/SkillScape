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

$selectContent = $connectDB->prepare(("SELECT * FROM `content` WHERE `tutor_id` = ? "));
$selectContent->execute([$tutor_id]);
$totalContent = $selectContent->rowCount();

$selectPlaylist = $connectDB->prepare(("SELECT * FROM `playlist` WHERE `tutor_id` = ? "));
$selectPlaylist->execute([$tutor_id]);
$totalPlaylist = $selectPlaylist->rowCount();

$selectComment = $connectDB->prepare(("SELECT * FROM `comments` WHERE `tutor_id` = ? "));
$selectComment->execute([$tutor_id]);
$totalComment = $selectComment->rowCount();

$selectLike = $connectDB->prepare(("SELECT * FROM `likes` WHERE `tutor_id` = ? "));
$selectLike->execute([$tutor_id]);
$totalLike = $selectLike->rowCount();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar_style.css">
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <link rel="stylesheet" href="../css/footer_style.css">
</head>
<body>
    <?php include '../components/navbar.php'; ?>
    <section class="dashboard">
        <h1 class="heading">Dashboard</h1>
        <div class="container">
            <div class="box">
                <h3>Welcome</h3>
                <p><?= $fetchProfile['name'];?></p>
                <a href="profile.php" class="btn">view profile</a>
            </div>
            <div class="box">
                <h3><?= $totalContent;?></h3>
                <p>Total Courses</p>
                <a href="addCourse.php" class="btn">add new course</a>
            </div>
            <div class="box">
                <h3><?= $totalPlaylist;?></h3>
                <p>Total Playlist</p>
                <a href="addCoursePlaylist.php" class="btn">add new playlist</a>
            </div>
            <div class="box">
                <h3><?= $totalLike;?></h3>
                <p>Total Likes</p>
                <a href="course.php" class="btn">view courses</a>
            </div>
            <div class="box">
                <h3><?= $totalComment;?></h3>
                <p>Total Comments</p>
                <a href="comments.php" class="btn">view comments</a>
            </div>
            <div class="box">
                <h3>Quick Start</h3>
                <div class="auth-btn">
                <a href="logIn.php" class="btn">Login Now</a>
                <a href="register.php" class="btn">Register Now</a>
                </div>
            </div>
        </div>
    </section>
    <?php include '../components/footer.php'; ?>
    <script type="text/javascript" src="../js/navbar.js"></script>
</body>
</html>