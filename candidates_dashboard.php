<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: candidateslogin.php");
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
    <link rel="stylesheet" href="css/candidates_dashboard.css">
    <link rel="stylesheet" href="css1/all.css">
    <title>Campus Recruitment</title>
</head>
<body>
    <section id="menu">
        <div class="logo">
            <a  class="logo-cta" href="#">Campus<span>Recruitment</span></a>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-table-columns"></i><a href="candidates_dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-user"></i><a href="candidates_profile.php">Profile</a></li>
            <li><i class="fa-solid fa-fill"></i><a href="candidates_filleducationform.php">Fill Education Form</a></li>
            <li><i class="fa-solid fa-envelopes-bulk"></i><a href="candidates_vacancy.php">View vacancy</a></li>
            <li><i class="fa-brands fa-readme"></i><a href="candidates_reports.php">Reports</a></li>
            <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="logout.php">Logout</a></li>
        </div>
    </section>

    <section id="interface">
        <div class="navigation">
            <div class="n1">

            </div>

            <div class="profile">
                <i class="far fa-bell"></i>
                <div class="image">
                <?php
                $sql = "SELECT * FROM candidates WHERE email='$email'";
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
            Student Name
        </h3>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-signs-post"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM vacancy";
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
                     $sql = "SELECT id FROM apply WHERE email='$email'";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total No. of Applied Job</span>
                 </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-square-plus"></i>
                 <div>
                     <h3><?php 
                     $sql = "SELECT id FROM company";
                     $query = $conn->query($sql);
                     $row = mysqli_num_rows($query);
                     echo $row;?></h3>
                     <span>Total company</span>
                 </div>
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