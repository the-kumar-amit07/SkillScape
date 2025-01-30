<?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="" onclick="this.parentElement.remove()"></i>
            </div>
            ';
        }
    }
?>

<header>
    <section class="">
        <a href="dashboard.php">
            <img src="../images/skillscape-high-resolution-logo-transparent.png" alt="" width="100">
        </a>
        <form action="search_page.php" method="POST" class="search-form">
            <input type="text" name="search" id="search" placeholder="Search here..." required maxlength="50">
            <button type="submit" name="search_btn">Search</button>
        </form>
        <div class="icons">
            <div id="menu_btn" class="material-symbols-outlined">menu</div>
            <div id="search_btn" class="material-symbols-outlined">search</div>
            <div id="user_btn" class="material-symbols-outlined">person</div>
        </div>
        <div class="profile">
            
            <?php
            $selectProfile = $connectDB->prepare("SELECT * FROM `tutor` WHERE id = ?");
            $selectProfile->execute([$id]);
            if ($selectProfile->rowCount() > 0) {
                $fetchProfile = $selectProfile->fetch(PDO::FETCH_ASSOC);
            ?>

            <img src="../uploadFiles/<?php$fetchProfile['image'];?>" alt="avatar">
            <h3><?php $fetchProfile['name'];?></h3>
            <span><?php $fetchProfile['profession'];?></span>

            <div id="profile-btn">
                <a href="profile.php" class="btn">View Profile</a>
                <a href="../components/adminLogout.php" onclick = "return confirm('Logout from this website?');" class="btn" >Logout</a>
            </div>
            <?php
            } else {
            ?>
            <h3>Please Login or Register</h3>
            <div id="profile-btn">
                <a href="login.php" class="btn">LogIn</a>
                <a href="register.php"class="btn" >Register</a>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
</header>

