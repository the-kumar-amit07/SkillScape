<?php
include '../components/dbConnect.php';

if(isset($_POST['register'])) {
    $id = uniqueId();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $profession= $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_POST['password'];
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $confirmPassword = $_POST['confirm_password'];
    $confirmPassword = filter_var($confirmPassword, FILTER_SANITIZE_STRING);

    if ($password != $confirmPassword) {
        $message[] = 'Password does not match';
    } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] != UPLOAD_ERR_OK) {
            $message[] = 'Please select an image';
        }else {
            $image = $_FILES['avatar']['name'];
            $image = filter_var($image, FILTER_SANITIZE_STRING);
            $fileExtension = pathinfo($image, PATHINFO_EXTENSION);
            $rename = uniqueId().'.'.$fileExtension;
            $imgSize = $_FILES['avatar']['size'];
            $imgTempName = $_FILES['avatar']['tmp_name'];
            $imgFolderPath = '../bucket/'.$rename;

            $selectTutor = $connectDB->prepare("SELECT * FROM `instructor` WHERE `email` = ? ");
            $selectTutor->execute([$email]);

            if ($selectTutor->rowCount() > 0) {
                $message[] = 'Email already exists';
            } else {
                $insertTutor = $connectDB->prepare(("INSERT INTO `instructor` (id, name, profession, email, password, avatar ) VALUES (?,?,?,?,?,?)"));
                if ($insertTutor->execute([$id,$name,$profession,$email,$hashPassword,$rename])) {
                    if (move_uploaded_file($imgTempName, $imgFolderPath)) {
                        $message[] = 'Registration Successful, Please Login';
                    } else {
                        $message[] = 'Failed to upload avatar';
                    }
                } else{
                    $message[] = 'Registration Failed';
                }
            }
        }
    }
}

?>

<style>
    <?php include '../css/register_style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>
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

    <div class="container">
    <div class="form-logo">
            <img src="../images/skillscape-high-resolution-logo-transparent.png" alt="SkillScape Logo" width="100">
    </div>
    
        <main class="signup-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>register now</h3>
                <section>
                    <p>Your Name <span>*</span></p>
                    <input type="text" name="name" class="box" placeholder="Enter your name" maxlength="50" required>
                    <p>Your Profession <span>*</span></p>
                    <select name="profession" class="box" required >
                        <option value="Select Profession" disabled selected>Select Profession</option>
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
                    <input type="email" name="email" class="box" placeholder="Enter your email" maxlength="50" required>
                </section>
                <section>
                    <p>Your Password <span>*</span></p>
                    <input type="password" name="password" class="box" placeholder="Enter your password" maxlength="50" required>
                    <p>Confirm Password <span>*</span></p>
                    <input type="password" name="confirm_password" class="box" placeholder="Confirm your password" maxlength="50" required>
                    <p>Select Your Avatar <span>*</span></p>
                    <input type="file" name="avatar" class="box" accept="image/*" required>
                </section>
                <p>Already have an account? <a href="logIn.php">Log In</a></p>
                <input type="submit" name="register" class="btn" value="Register">
            </form>
        </main>
    </div>
</body>
</html>