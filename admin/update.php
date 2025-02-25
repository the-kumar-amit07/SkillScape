<?php
session_start();
include '../components/dbConnect.php';

if (isset($_SESSION['id'])) {
    $tutor_id = $_SESSION['id'];
} else {
    $tutor_id = '';
    header('Location: logIn.php');
}

if (isset($_POST['update'])) {
    $selectTutor = $connectDB->prepare("SELECT * FROM `instructor` WHERE `id` = ? LIMIT 1");
    $selectTutor->execute([$tutor_id]);
    $fetchTutor = $selectTutor->fetch(PDO :: FETCH_ASSOC);

    $prevPassword = $fetchTutor['password'];
    $oldAvatar = $fetchTutor['avatar'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!empty($name)) {
        $updateName = $connectDB->prepare("UPDATE `instructor` SET `name` = ? WHERE `id` = ? ");
        $updateName->execute([$name, $tutor_id]);
        $message[] = 'Name Updated';
    }
    if (!empty($email)) {
        $selectEmail = $connectDB->prepare("SELECT * FROM `instructor` WHERE `email` = ? AND `id` != ? ");
        $selectEmail->execute([$email, $tutor_id]);
        
        if ($selectEmail->rowCount() > 0) {
            $message[] = 'Email already exists';
        } else {
            $updateEmail = $connectDB->prepare("UPDATE `instructor` SET `email` = ? WHERE `id` = ? ");
            $updateEmail->execute([$email, $tutor_id]);
            $message[] = 'Email Updated';
        }
    }
    if (!empty($profession)) {
        $updateProfession = $connectDB->prepare("UPDATE `instructor` SET `profession` = ? WHERE `id` = ? ");
        $updateProfession->execute([$profession, $tutor_id]);
        $message[] = 'Profession Updated';
    }

    $avatar = $_FILES['avatar']['name'];
    $avatar = filter_var($avatar, FILTER_SANITIZE_STRING);
    $fileExtension = pathinfo($avatar, PATHINFO_EXTENSION);
    $rename = uniqueId().'.'.$fileExtension;
    $imgSize = $_FILES['avatar']['size'];
    $imgTempName = $_FILES['avatar']['tmp_name'];
    $imgFolderPath = '../bucket/'.$rename;

    if (!empty($avatar)) {
        if ($imgSize > 2000000) {
            $message[] = 'Image size is too large';
        } else {
            if (move_uploaded_file($imgTempName, $imgFolderPath)) {
                $updateAvatar = $connectDB->prepare("UPDATE `instructor` SET `avatar` = ? WHERE `id` = ? ");
                $updateAvatar->execute([$rename, $tutor_id]);
                $message[] = 'Avatar Updated';
                if ($oldAvatar != '' &&  $oldAvatar != $rename) {
                    unlink('../bucket/'.$oldAvatar);
                }
            } else {
                $message[] = 'Failed to upload avatar';
            }
        }
    }

    $oldPass = $_POST['old_password'];
    $oldPass = filter_var($oldPass, FILTER_SANITIZE_STRING);
    $newPass = $_POST['new_password'];
    $oldPass = filter_var($oldPass, FILTER_SANITIZE_STRING);
    $confirmPass = $_POST['confirm_password'];
    $oldPass = filter_var($oldPass, FILTER_SANITIZE_STRING);

    if(!empty($oldPass) && !empty($newPass) && !empty($confirmPass)){
        if (!password_verify($oldPass,$prevPassword)) {
            $message[] = "Old password is incorrect!";
        } elseif ($newPass != $confirmPass) {
            $message[] = "New password and Confirm password do not match!";
        } else {
            $hashPassword = password_hash($newPass,PASSWORD_DEFAULT);
            $updatePass = $connectDB->prepare("UPDATE `instructor` SET `password` = ? WHERE `id` = ? ");
            $updatePass->execute([$hashPassword, $tutor_id]);
            $message[] = 'Password Updated';
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar_style.css">
    <link rel="stylesheet" href="../css/update_style.css">
</head>
<body>
    <?php include '../components/navbar.php'; ?>

    <?php
        if (isset($message)) {
            foreach ($message as $message) { 
                echo '
                <div class="message">
                    <span>' . $message . '</span>
                    <i class="material-symbols-outlined" onclick="this.parentElement.remove()">close</i>
                </div>
                ';
            }
        }
    ?>

    <div class="main-container">
        <div class="update-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>Update Your Profile</h3>
                <section>
                    <p>Your Name <span>*</span></p>
                    <input type="text" name="name" class="box" placeholder="<?= $fetchProfile['name']; ?>" maxlength="50" required>
                    <p>Your Profession <span>*</span></p>
                    <select name="profession" class="box" required >
                        <option value="Select Profession" disabled selected><?= $fetchProfile['profession']; ?></option>
                        <option value="Web Developer">Web Developer</option>
                        <option value="Graphic Designer">Graphic Designer</option>
                        <option value="UI/UX Designer">UI/UX Designer</option>
                        <option value="Digital Marketer">Digital Marketer</option>
                        <option value="Content Writer">Content Writer</option>
                        <option value="SEO Expert">SEO Expert</option>
                        <option value="Video Editor">Video Editor</option>
                        <option value="Photographer">Photographer</option>
                    </select>
                    <p>Your Email <span>*</span></p>
                    <input type="email" name="email" class="box" placeholder="<?= $fetchProfile['email']; ?>" maxlength="50" required>
                </section>
                <section>
                    <p>Old Password (leave empty if not changing)</p>
                    <input type="password" name="old_password" class="box" placeholder="Enter your old password" maxlength="50" required>
                    <p>New Password (leave empty if not changing)</p>
                    <input type="password" name="new_password" class="box" placeholder="Enter your new password" maxlength="50" required>
                    <p>Confirm Password <span>*</span></p>
                    <input type="password" name="confirm_password" class="box" placeholder="Confirm your password" maxlength="50" required>
                    <p>Select Your Avatar <span>*</span></p>
                    <input type="file" name="avatar" class="box" accept="image/*" required>
                </section>
                <input type="submit" name="update" class="btn" value="Update">
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../js/navbar.js"></script>

</body>
</html>