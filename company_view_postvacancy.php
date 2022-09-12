<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    include '_db_connection.php';

    $sql = "SELECT * FROM `vacancy` WHERE `id`='$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $title = $row['title'];
    $delete1 = mysqli_query($conn,"DELETE FROM `apply` WHERE `email1`='$email' AND `title`='$title'");
    $delete = mysqli_query($conn,"DELETE FROM `vacancy` WHERE `id`='$id'");
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
    <link rel="stylesheet" href="css/company_view_postvacancy.css">
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
            Total Vacancy Posted
        </h3>


        <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Job title</td>
                        <td>Vacancy</td>
                        <td>Details</td>
                        <td>Edit</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $sql = "SELECT * FROM vacancy WHERE email='$email'";
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc())
                        {?>
                        <!-- <?php $_SESSION['title'] = $row['title']; ?> -->
                    <tr>
                        <td class="ads">
                            <div class="ads-de">
                                <h5><?php echo $row['title'];?></h5>
                            </div>
                        </td>

                        <td class="ads-des">
                            <h5><?php echo $row['vacancy'];?></h5>
                        </td>
                        
                        <td class="active">
                            <p><?php 
                                echo "<a href = 'company_postvacancy_more.php?title=".$row['title']."' class='btn' style='text-decoration:none;color:#5c639d;'><b>More</b></a>"; 
                                ?>
                            </p>
                        </td>
                        
                        <td class="edit">
                        <?php 
                                echo "<a href = 'company_postvacancy_update.php?title=".$row['title']."' class='btn''><b>Update</b></a>"; 
                                ?>
                        </td>

                        <td class="edit">
                        <?php 
                                echo "<a href = 'company_view_postvacancy.php?id=".$row['id']."' class='btn'style='text-decoration:none;color:red;'><b>Delete</b></a>"; 
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