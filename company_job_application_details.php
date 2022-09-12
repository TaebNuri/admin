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
if(isset($_GET['id'])){
    $id = $_GET['id'];
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
    <link rel="stylesheet" href="css/company_job_application_details.css">
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
                <!-- <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div> -->
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

        <h3 class="i-name">
            Applicant Profile
        </h3>

        <div class="board">
            <?php
                $sql = "SELECT * FROM apply WHERE id='$id'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <div class="col">
                    <div class="row">
                        <div class="name">
                            <h3>Applicant name:</h3>
                            <p><?php echo $row['name'];?></p>
                        </div>

                        <div class="name">
                            <h3>Email:</h3>
                            <p><?php echo $row['email'];?></p>
                        </div>

                        <div class="name">
                            <h3>Programe:</h3>
                            <p><?php echo $row['subject3'];?></p>
                        </div>

                        <div class="name">   
                            <h3>CGPA:</h3>
                            <p><?php echo $row['grade3'];?></p>
                        </div>

                        <div class="name">
                            <h3>Age:</h3>
                            <p><?php echo $row['age'];?></p>
                        </div>

                        <div class="name">
                            <h3>CV:</h3>
                            <p><?php
                            echo "<a href = 'company_job_application_cv.php?id=".$row['id']."' class='btn' style='text-decoration:none;color:black;' target='_blank'><b> See the CV</b></a>";
                            ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="profile-pic">
                        <form action="">
                        <div class="profile">
                        <div class="image">
                            <?php
                                $email2 =$row['email'];
                                $sql1 = "SELECT * FROM candidates WHERE email= '$email2'";
                                $query1 = $conn->query($sql1);
                                while($row1 = $query1->fetch_assoc()){
                                echo "<img src = 'images/".$row1['pic']."'>";
                                }
                            ?>
                        </div> 
                        </div>
                            </from>
                    </div>
                    </div>
                </div>
                <?php
                            }
                        ?>
        </div>
    </section>
</body>
</html>