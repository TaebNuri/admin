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
    $ok = 'ok';
    $value = NULL;

    $sql = "UPDATE `company` SET `ok` = '$ok',`date` = current_timestamp() WHERE `company`.`email` = '$email' ";
    $result = mysqli_query($conn, $sql);

    // $delete = mysqli_query($conn,"DELETE FROM `company` WHERE `email`='$email'");
    // $delete1 = mysqli_query($conn,"DELETE FROM `vacancy` WHERE `email`='$email'");
}
?>

<?php
if(isset($_GET['email1'])){
    include '_db_connection.php';
    $email = $_GET['email1'];
    $ok = 'ok';
    $value = NULL;

    $sql = "UPDATE `company` SET  `ok` = '$value',`date` = '$value' WHERE `company`.`email` = '$email' ";
    $result = mysqli_query($conn, $sql);

    // $delete = mysqli_query($conn,"DELETE FROM `company` WHERE `email`='$email'");
    // $delete1 = mysqli_query($conn,"DELETE FROM `vacancy` WHERE `email`='$email'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_company.css">
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
                <img src="image/admin.jfif" alt="">
            </div>
        </div>

        <h3 class="i-name">
            Total Company
        </h3>

        <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Phone with type</td>
                        <td>Registration Date</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include '_db_connection.php';
                    $sql = "SELECT * FROM company";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {?>
                    <tr>
                        <td class="people">
                            <!-- <img src="image/company.png" alt=""> -->
                            <div class="people-de">
                                <h5><?php echo $row['company_name'];?></h5>
                                <p><?php echo $row['email'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['phone'];?></h5>
                            <p><?php echo $row['type'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['dt'];?></p>
                        </td>

                        <td class="active">
                            <p><?php 
                                echo "<a href = 'admin_company_more.php?email=".$row['email']."' class='btn''><b>Details</b></a>"; 
                                ?></p>
                        </td>

                        <td class="edit">
                        <?php 
                            if($row['ok']=='ok')
                            {
                                echo "<a href = 'admin_company.php?email1=".$row['email']."' class='btn btn-outline-success'>Activate</a>"; 
                            }
                            else
                            {
                                echo "<a href = 'admin_company.php?email=".$row['email']."' class='btn btn-outline-danger'>Deactivate</a>";
                            }
                            ?>
                        </td>
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