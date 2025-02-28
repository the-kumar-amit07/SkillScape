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

if (isset($_POST['submit'])) {
    $id = uniqueId();
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $thumbnail = $_FILES['thumbnail']['name'];
    $thumbnail = filter_var($thumbnail, FILTER_SANITIZE_STRING);
    $thumbnailExt = pathinfo($thumbnail,PATHINFO_EXTENSION);
    $rename = uniqueId().".".$thumbnailExt;
    $thumbnailFileSize = $_FILES['thumbnail']['size'];
    $thumbnailTmpName = $_FILES['thumbnail']['tmp_name'];
    $imageFolder = "../bucket/".$rename;

    $addPlaylist = $connectDB->prepare(("INSERT INTO `playlist`(id,tutor_id,title,description,thumbnail,status) VALUES (?,?,?,?,?,?)"));
    if ($addPlaylist->execute([$id,$tutor_id,$title,$description,$rename,$status])) {
        if(move_uploaded_file($thumbnailTmpName,$imageFolder)) {
            $message[] = 'Playlist Created Successfully';
        } else {
            $message[] = 'Failed to upload thumbnail';
        }
    } else {
        $message[] = 'Failed to create playlist';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course Playlist</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar_style.css">
    <link rel="stylesheet" href="../css/addCoursePlaylist_style.css">
    <link rel="stylesheet" href="../css/footer_style.css">
</head>
<body>
    <?php include '../components/navbar.php'; ?>
    <div class="playlistForm-container">
        <section class="playlist-form">
            <h1 class="heading">Create Playlist</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <p>Playlist Status <span>*</span></p>
                <select name="status">
                    <option value="" selected disabled>Status</option>
                    <option value="active">Active</option>
                    <option value="deactive">Deactive</option>
                </select>
                <p>Playlist Name <span>*</span></p>
                <input type="text" name="title" maxlength="50" required placeholder="Enter Playlist Name">

                <p>Playlist Description <span>*</span></p>
                <textarea name="description" maxlength="255" required placeholder="Enter Playlist Description" cols="30" rows="10"></textarea>

                <p>Playlist Image <span>*</span></p>
                <input type="file" name="thumbnail" accept="image/*" required>

                <input type="submit" name="submit" value="Create Playlist"> 
            </form>
        </section>
    </div>
    <?php include '../components/footer.php'; ?>
    <script type="text/javascript" src="../js/navbar.js"></script>
</body>
</html>