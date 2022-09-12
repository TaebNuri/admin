<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
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
    <link rel="stylesheet" href="css/company_dashboard.css">
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
            Company Name
        </h3>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-signs-post"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM vacancy WHERE email = '$email'";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total Vacancy Posted</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-envelopes-bulk"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM apply WHERE email1 = '$email'";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total No. of Application</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-square-plus"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM candidates";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total No. of Candidates</span>
                 </div>
            </div>

            <!-- <div class="val-box">
                <i class="fa-solid fa-eject"></i>
                 <div>
                     <h3>1,50,585</h3>
                     <span>Total No. of Rejected Application</span>
                 </div>
            </div> -->
        </div>

        <!-- <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Title</td>
                        <td>Age</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="people">
                            <img src="image/1.jpg" alt="">
                            <div class="people-de">
                                <h5>Marzia</h5>
                                <p>marzia@sister.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Software Engineer</h5>
                            <p>Web dev</p>
                        </td>

                        <td class="age">
                            <p>42</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="edit">
                            <a href="#">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->
    </section>
</body>
</html>