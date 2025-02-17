<?php
session_start();
include '../components/dbConnect.php';

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_POST['password'];
    // $password = filter_var($password, FILTER_SANITIZE_STRING);

    $selectTutor = $connectDB->prepare("SELECT * FROM `instructor` WHERE `email` = ? LIMIT 1");
    $selectTutor->execute([$email]);

    if($selectTutor->rowCount() > 0) {
        $row = $selectTutor->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password,$row['password']) ){

            /*For $_SESSION*/
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            /*For $_COOKIE*/
            // setcookie('tutor_id', $row['id'], time() + 86400, '/');
            header('location:dashboard.php');
            exit;
        } else {
            $message[] = 'Invalid Password';
        }
    } else {
        $message[] = 'Email not found';
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
    <title>Admin Login</title>

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

    <header>
            <img src="../images/skillscape-high-resolution-logo-transparent.png" alt="SkillScape Logo" width="100">
    </header>
    
        <main class="login-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>Log In to your account</h3>
                <section>
                    <p>Your Email <span>*</span></p>
                    <input type="email" name="email" class="box" placeholder="Enter your email" maxlength="50" required>
                    <p>Your Password <span>*</span></p>
                    <input type="password" name="password" class="box" placeholder="Enter your password" maxlength="50" required>
                </section>
                <p>
                    Don't have an account? <a href="register.php">Register</a></p>
                <input type="submit" name="login" class="btn" value="Log In">
            </form>
        </main>
</body>
</html>