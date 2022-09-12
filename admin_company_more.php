<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: adminlogin.php");
    exit;
}
?>

<?php
if(isset($_GET['email'])){
    $email = $_GET['email'];
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
    <link rel="stylesheet" href="css/admin_company_more.css">
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
                <img src="image/company.png" alt="">
            </div>
        </div>
        <div class="hero">
        <?php
                $sql = "SELECT * FROM company WHERE email='$email'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
            <div class="detail">
                        <div class="title">
                            <h3>Company Name:</h3>
                            <p><?php echo $row['company_name'];?></p>
                        </div>

                        <div class="vacancy">
                            <h3>Email:</h3>
                            <p><?php echo $row['email'];?></p>
                        </div>

                        <div class="salary">
                            <h3>Phone number:</h3>
                            <p><?php echo $row['phone'];?></p>
                        </div>

                        <div class="address">   
                            <h3>Address:</h3>
                            <p><?php echo $row['address'];?></p>
                        </div>

                        <div class="requirement">
                            <h3>Type:</h3>
                            <p><?php echo $row['type'];?></p>
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