<?php
session_start();
$email = $_SESSION['email'];
// $title = $_SESSION['title'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
if(isset($_GET['title'])){
    $title = $_GET['title'];
}
?>

<?php
    include '_db_connection.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/company_postvacancy_more.css">
    <link rel="stylesheet" href="css1/all.css">
    <title>Campus Recruitment</title>
</head>
<body>
    <section id="menu">
            <div class="logo">
                <a  class="logo-cta" href="#">Campus<span>Recruitment</span></a>
            </div>

            <div class="items">
            <li><i class="fa-solid fa-table-columns"></i><a href="company_dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-user"></i><a href="company_profile.php">Profile</a></li>
            <li><i class="fa-solid fa-signs-post"></i><a href="company_postvacancy.php">Post Vacancy</a></li>
            <li><i class="fa-solid fa-envelopes-bulk"></i><a href="company_job_application.php">Job Application</a></li>
            <li><i class="fa-brands fa-readme"></i><a href="company_reports.php">Reports</a></li>
            <li><i class="fa-solid fa-list"></i><a href="company_view_postvacancy.php">Vacancy List</a></li>
            <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="logout.php">Logout</a></li>
        </div>
    </section>


    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>

            <div class="profile">
                <i class="far fa-bell"></i>
                <div class="image">
                <?php
                $sql = "SELECT * FROM company WHERE email='$email'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {
                     echo "<img src = 'images/".$row['pic']."'>";
                }
                ?>
                </div>
            </div>
        </div>

        <div class="hero">
            <?php
                $sql = "SELECT * FROM vacancy WHERE email='$email' AND title='$title'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <div class="detail">
                        <div class="title">
                            <h3>Job Title:</h3>
                            <p><?php echo $row['title'];?></p>
                        </div>

                        <div class="vacancy">
                            <h3>Vacancy:</h3>
                            <p><?php echo $row['vacancy'];?></p>
                        </div>

                        <div class="salary">
                            <h3>Salary:</h3>
                            <p><?php echo $row['salary'];?></p>
                        </div>

                        <div class="address">   
                            <h3>Address:</h3>
                            <p><?php echo $row['address'];?></p>
                        </div>

                        <div class="requirement">
                            <h3>CGPA at least:</h3>
                            <p><?php echo $row['requirement'];?></p>
                        </div>

                        <div class="description">
                            <h3>Job Responsibility:</h3>
                            <p><?php echo $row['message'];?></p>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
    </section>
</body>
</html>