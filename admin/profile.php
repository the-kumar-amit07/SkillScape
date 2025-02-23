<?php
session_start();
include '../components/dbConnect.php';


/*For $_SESSION*/
if (isset($_SESSION['id'])) {
    $tutor_id = $_SESSION['id'];
} else {
    header('Location: logIn.php');
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
    <title>Instructor Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar_style.css">
    <link rel="stylesheet" href="../css/profile_style.css">
    <link rel="stylesheet" href="../css/footer_style.css">
</head>
</head>
<body>
    <?php include '../components/navbar.php'; ?>
    <section class="profile-section" >
        <h1 class="heading">Profile Details</h1>
        <div class="details">
            <div class="tutor-info">
                <img src="../bucket/<?=$fetchProfile['avatar'];?>" alt="user profile">
                <h3><?=$fetchProfile['name'];?></h3>
                <span><?=$fetchProfile['profession'];?></span>
                <a href="update.php" class="btn">Update Your Profile</a>
            </div>
            <div class="tutor-post">
                <div class="box">
                    <span><?=$totalPlaylist;?></span>
                    <p>Total Playlist</p>
                    <a href="playlist.php" class="btn">View Playlist</a>
                </div>
                <div class="box">
                    <span><?=$totalContent;?></span>
                    <p>Total Courses</p>
                    <a href="playlist.php" class="btn">View Courses</a>
                </div>
                <div class="box">
                    <span><?=$totalLike;?></span>
                    <p>Total Likes</p>
                    <a href="playlist.php" class="btn">View Courses</a>
                </div>
                <div class="box">
                    <span><?=$totalComment;?></span>
                    <p>Total Comments</p>
                    <a href="playlist.php" class="btn">View Comments</a>
                </div>
            </div>
        </div>
    </section>
    <?php include '../components/footer.php'; ?>
    <script type="text/javascript" src="../js/navbar.js"></script>
</body>
</html>