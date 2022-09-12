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

<?php
if(isset($_GET['email'])){
    include '_db_connection.php';
    $email = $_GET['email'];
    $delete = mysqli_query($conn,"DELETE FROM `company` WHERE `email`='$email'");
    $delete1 = mysqli_query($conn,"DELETE FROM `vacancy` WHERE `email`='$email'");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin_reports.css">
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
                <!-- <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div> -->
            </div>

            <div class="profile">
                <i class="far fa-bell"></i>
                <img src="image/company.png" alt="">
            </div>
        </div>

        <h3 class="i-name">
            Reports
        </h3>


        <div class="board">
            <form action="../campus recruitment/admin_reports.php" method="post">
                <div class="txt_field">
                    <label for="date">  From Date</label><br>
                    <input type="date" id="date" name="date1" required>
                </div>
                
                <div class="txt_field">
                    <label for="date">  To Date</label><br>
                    <input type="date" id="date" name="date2" required>
                </div>

                <button type="submit" class="sign-in">
                    Submit
                </button>
            </form>
        </div>

        <div class="board1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Conpany Name</td>
                        <td>Contact </td>
                        <td>Registration Date</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    include '_db_connection.php';
                    $date1 = $_POST['date1'];
                    $date2 = $_POST['date2'];
                    
                    $date1 = strtotime($date1);
                    $date2 = strtotime($date2);
                
                    $sql = "SELECT * FROM company";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                    $date11 = $row['dt'];
                    $date11 = strtotime($row['dt']);
                    if($date1<=$date11 && $date2>=$date11){
                    ?>
                    <tr>
                        <td class="people">
                            <!-- <img src="image/student.png" alt=""> -->
                            <div class="people-de">
                                <h5><?php echo $row['company_name'];?></h5>
                                <p><?php echo $row['type'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['email'];?></h5>
                            <p><?php echo $row['phone'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['dt'];?></p>
                        </td>

                        <td class="active">
                            <p><?php 
                                echo "<a href = 'admin_company_more.php?email=".$row['email']."' class='btn' style='text-decoration:none;color:#5c639d;'><b>Details</b></a>"; 
                                ?></p>
                        </td>

                        <td class="edit">
                           <?php echo "<a href = 'admin_company.php?email=".$row['email']."' class='btn' style='text-decoration:none;color:#5c639d;'><b>Reject</b></a>"; ?>
                        </td>
                    </tr>
                </tbody>
                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>

    </section>
</body>
</html>