
<?php
    if (isset($message)) {
        foreach ($message as $msg) { // Avoid overwriting variable
            echo '
            <div class="message">
                <span>' . htmlspecialchars($msg) . '</span>
                <i class="material-symbols-outlined" onclick="this.parentElement.remove()">close</i>
            </div>
            ';
        }
    }
?>

<div class="nav-header">
    <div class="nav-section" >
        <a href="dashboard.php">
            <img src="../images/skillscape-high-resolution-logo-transparent.png" alt="SkillScape Logo" width="100">
        </a>

        <form action="search_page.php" method="POST" class="search-form">
            <input type="text" name="search" id="search" placeholder="Search here..." required maxlength="50">
            <button type="submit" name="search-btn">Search</button>
        </form>

        <div class="icons">
            <div id="menu_btn" class="material-symbols-outlined">menu</div>
            <div id="search_btn" class="material-symbols-outlined">search</div>
            <div id="user_btn" class="material-symbols-outlined">person</div>
        </div>

        <div class="profile" >  
            <?php
            $selectProfile = $connectDB->prepare("SELECT * FROM `instructor` WHERE id = ?");
            $selectProfile->execute([$tutor_id]);

            if ($selectProfile->rowCount() > 0) {
                $fetchProfile = $selectProfile->fetch(PDO::FETCH_ASSOC);
            ?>

            <img src="../bucket/<?= htmlspecialchars($fetchProfile['avatar']) ?>" alt="User Avatar">
            <h3><?= htmlspecialchars($fetchProfile['name']) ?></h3>
            <span><?= htmlspecialchars($fetchProfile['profession']) ?></span>

            <div id="profile-btn">
                <a href="profile.php" class="btn">View Profile</a>
                <a href="../components/logout.php" onclick="return confirm('Logout from this website?');" class="btn">Logout</a>
            </div>

            <?php } else { ?>
            <div>
                <!-- <div class="close-btn material-symbols-outlined" id="close_toggle">close</div> -->
                <h3>Please Login or Register</h3>
                <div id="profile-btn">
                    <a href="login.php" class="btn">Log In</a>
                    <a href="register.php" class="btn">Register</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="aside">
    <div class="sidebar">
        <div class="close-btn material-symbols-outlined" id="close_sidebar">close</div>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="playlist.php">Playlist</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>
</div>

