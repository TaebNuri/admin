<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: adminlogin.php");
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
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="css1/all.css">
    <title>Campus Recruitment</title>
</head>
<body>
    <section id="menu">
        <div class="logo">
            <a  class="logo-cta" href="#">Campus<span>Recruitment</span></a>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-table-columns"></i><a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-building"></i><a href="admin_company.php">Total Reg. Company</a></li>
            <li><i class="fa-solid fa-graduation-cap"></i><a href="admin_student.php">Total Reg. Student</a></li>
            <li><i class="fa-solid fa-briefcase"></i><a href="admin_vacancy.php">Total vacancy</a></li>
            <li><i class="fa-brands fa-readme"></i><a href="admin_reports.php">Reports</a></li>
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
                <img src="image/admin.jfif" alt="">
            </div>
        </div>

        <h3 class="i-name">
            Admin
        </h3>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-building"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM company ORDER BY id";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total Company</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fas fa-users"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM candidates ORDER BY id";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total Candidates</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-briefcase"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM vacancy ORDER BY id";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total Vacancy</span>
                 </div>
            </div>

            <!-- <div class="val-box">
                <i class="fa-solid fa-city"></i>
                 <div>
                     <h3>256</h3>
                     <span>Total Domain</span>
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