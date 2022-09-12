<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
if(isset($_GET['id1'])){
    $id1 = $_GET['id1'];
    $ok = 'ok';
    include '_db_connection.php';

    $sql = "UPDATE `apply` SET `ok` ='$ok' WHERE  `id` = '$id1'";
    $result = mysqli_query($conn, $sql);
}

if(isset($_GET['id2'])){
    $id2 = $_GET['id2'];

    include '_db_connection.php';

    $delete = mysqli_query($conn,"DELETE FROM `apply` WHERE `id`='$id2'");
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
    <link rel="stylesheet" href="css/company_job_application.css">
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
            Total Application
        </h3>

        <!-- <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-building"></i>
                 <div>
                     <h3>8,268</h3>
                     <span>Total Company</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fas fa-users"></i>
                 <div>
                     <h3>10,258</h3>
                     <span>Total Candidates</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-briefcase"></i>
                 <div>
                     <h3>1,50,585</h3>
                     <span>Total Vacancy</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-city"></i>
                 <div>
                     <h3>256</h3>
                     <span>Total Domain</span>
                 </div>
            </div>
        </div> -->

        <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Applicant details</td>
                        <td>Contact </td>
                        <td>Title</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM apply WHERE email1='$email' ORDER BY id DESC";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <tr>
                        <td class="people">
                        <img src="image/student.png" alt="">
                            <div class="people-de">
                                <h5><?php echo $row['name'];?></h5>
                                <p><?php echo $row['gender'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['email'];?></h5>
                            <p><?php echo $row['subject3'];?></p>
                        </td>

                        <td class="age">
                            <h5><?php echo $row['title'];?></h5>
                            <p><?php echo $row['age'];?></p>
                        </td>

                        <td class="active">
                            <p><?php 
                                echo "<a href = 'company_job_application_details.php?id=".$row['id']."' class='btn''><b>Details</b></a>"; 
                                ?></p>
                        </td>

                        <?php
                        if($row['ok'] == 'ok'){
                        ?> 
                        <td class="edit">
                            <p>Request accepted</p>
                        </td>
                        <?php
                        }else{
                        ?>
                        <td class="edit">
                            <?php 
                                echo "<a href = 'company_job_application.php?id1=".$row['id']."' class='btn' style='text-decoration:none;color:#5c639d;'><b>Accept </b></a>|"; 
                            ?>
                            <?php 
                                echo "<a href = 'company_job_application.php?id2=".$row['id']."' class='btn' style='text-decoration:none;color:red;'><b> Remove</b></a>"; 
                            ?>
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
            ?>
                </tbody>
            </table>
            
        </div>
    </section>
</body>
</html>