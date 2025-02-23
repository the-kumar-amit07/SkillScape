<div class="newsletter">
    <div class="container">
        <div class="box">
            <h3>Subscribe to our Newsletter</h3>
            <p>Get the latest news and updates from SkillScape</p>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Enter your email">
                <button type="submit" name="submit">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="container" >
                <div class="box-counter">
                    <div class="counter-box">
                        <h3 class="counter" speed="1000">1000</h3>
                        <h3>+</h3>
                    </div>
                    <p>Subscribers</p>
                </div>

                <div class="box-counter">
                    <div class="counter-box">
                        <h3 class="counter" speed="1000">500</h3>
                        <h3>+</h3>
                        </div>
                    <p>Online Courses</p>
                </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="box">
            <h3>about us</h3>
            <p>Our mission is to provide the best online learning platform for students and professionals. We provide the best courses and tutorials for web development, graphic design, digital marketing, and more.</p>
        </div>
        <div class="box">
            <h3>quick links</h3>
            <ul>
                <li><a href="index.php">home</a></li>
                <li><a href="about.php">about us</a></li>
                <li><a href="courses.php">courses</a></li>
                <li><a href="contact.php">contact us</a></li>
            </ul>
        </div>
        <div class="box">
            <h3>contact us</h3>
            <p>Address: 123 SkillScape Street, SkillScape City, SkillScape Country</p>
            <p>Email:
                <a href="mailto:"></a>
            </p>
            <p>Phone: <a href="tel:"></a></p>
        </div>
    </div>
    <div class="social">
        <a href="#"><i class="material-symbols-outlined">facebook</i></a>
        <a href="#"><i class="material-symbols-outlined">twitter</i></a>
        <a href="#"><i class="material-symbols-outlined">instagram</i></a>
        <a href="#"><i class="material-symbols-outlined">youtube</i></a>
    </div>
    <div class="copy">
        <p>&copy; 2021 SkillScape. All Rights Reserved.</p>
    </div>
</footer>
                


<script>
    (() => {
        const counter = document.querySelectorAll('.counter');
        
        const counterArray = Array.from(counter);
        counterArray.map((element) => {
            let counterText = parseInt(element.textContent);
            element.textContent = 0; //---> set the initial value to 0
            let count = 1;
            let speed = element.getAttribute("speed") / counterText;

            function startCounter () {
                element.textContent = count++;
                

                if (counterText < count) {
                    clearInterval( stopCounter );
                }
            }
            const stopCounter = setInterval(() => {
                startCounter();
            }, speed);
        })
    }) ();
</script>