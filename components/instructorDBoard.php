<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="instructorDBoard.css">

</head>

<body>
    <main>
        <header>
            <div class="header-title">
                <span>Dashboard</span>
                <h2>Hi,Instructor</h2>
            </div>
            <div class="user-profile">
                <button id="themeSwitch" class="theme-toggle">
                    <span class="material-symbols-outlined">dark_mode</span>
                </button>

                <div class="search-bar">
                    <i class="material-symbols-outlined">search</i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="" alt="profile-picture">
            </div>
        </header>

        <section class="card-container">
            <h3 class="main-title">Todays data</h3>
            <div class="card-wrapper">
                <a href="courses.html" class="data-card lightBlue ">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Courses Published</span>
                            <span class="amount-value">6</span>
                        </div>
                        <i class="material-symbols-outlined deepBlue">library_books</i>
                    </div>
                    <span class="card-detail">New this month: 2</span>
                </a>
                <a href="courses.html" class="data-card lightGreen ">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Students Enrolled</span>
                            <span class="amount-value">800</span>
                        </div>
                        <i class="material-symbols-outlined deepGreen">group</i>
                    </div>
                    <span class="card-detail">Active this month: 300</span>
                </a>
                <a href="courses.html" class="data-card lightRed ">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Earnings</span>
                            <span class="amount-value">$80000</span>
                        </div>
                        <i class="material-symbols-outlined deepRed">money_bag</i>
                    </div>
                    <span class="card-detail">Last 30 days: $3,500</span>
                </a>
                <a href="courses.html" class="data-card lightYellow">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Quizzes</span>
                            <span class="amount-value">80</span>
                        </div>
                        <i class="material-symbols-outlined deepYellow">quiz</i>
                    </div>
                    <span class="card-detail">Avg. Score: 85%</span>
                </a>
            </div>
        </section>

        <section class="table-section">
            <h3 class="table-title">Course Ordered</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Course Name</th>
                            <th>Student Email</th>
                            <th>Student Name</th>
                            <th>Progress</th>
                            <th>Total Earnings</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>0001</td>
                            <td>ReactJs</td>
                            <td>abc@gmail.com</td>
                            <td>Amit Kumar</td>
                            <td>In Progress</td>
                            <td>$60</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>0001</td>
                            <td>ReactJs</td>
                            <td>abc@gmail.com</td>
                            <td>Amit Kumar</td>
                            <td>In Progress</td>
                            <td>$60</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>0001</td>
                            <td>ReactJs</td>
                            <td>abc@gmail.com</td>
                            <td>Amit Kumar</td>
                            <td>In Progress</td>
                            <td>$60</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>0001</td>
                            <td>ReactJs</td>
                            <td>abc@gmail.com</td>
                            <td>Amit Kumar</td>
                            <td>In Progress</td>
                            <td>$60</td>
                            <td>Active</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">Total :$2400</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </main>

</body>

<script src="themeScript.js"></script>

</html>


