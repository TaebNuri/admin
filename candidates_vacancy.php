<?php
session_start();
$email = $_SESSION['email'];
$ok = 'ok';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: candidateslogin.php");
    exit;
}
?>

<?php
if(isset($_GET['id'])){
    include '_db_connection.php';
    $id = $_GET['id'];

    $delete = mysqli_query($conn,"DELETE FROM `apply` WHERE `id`='$id'");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/candidates_vacancy.css">
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
                <!-- <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div> -->
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
            Vacancy posted
        </h3>

        <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Position with vacancy</td>
                        <td>Application Deadline</td>
                        <td>Details</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include '_db_connection.php';
                    $sql = "SELECT * FROM company,vacancy WHERE `company`.`email` = `vacancy`.`email`";
                    // $sql1 = "SELECT * FROM apply";
                    $query = $conn->query($sql);
                    // $query1 = $conn->query($sql1);
                    // $row1 = $query1->fetch_assoc();
                    while($row = $query->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td class="people">
                            <?php echo "<img src = 'images/".$row['pic']."'>";?>
                            <div class="people-de">
                                <h5><?php echo $row['company_name'];?></h5>
                                <p><?php echo $row['address'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['title'];?></h5>
                            <p><?php echo $row['vacancy'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['expire_date'];?></p>
                        </td>

                        <?php
                        $sql1 = "SELECT * FROM apply";
                        $query1 = $conn->query($sql1);
                        while($row1 = $query1->fetch_assoc())
                        {
                        if($row1['email'] == $email && $row['email'] == $row1['email1'] && $row['title'] == $row1['title']){
                        ?>
                        <td class="active">
                            <p class="apply">
                                <?php 
                                if($row1['ok'] == $ok){
                                    echo "Request accepted"; 
                                }
                                else{
                                    echo "Request pending"; 
                                }
                                ?></p>
                        </td>
                        <td class="edit1">
                        <?php 
                                if($row1['ok'] == $ok){
                                    echo "<a href = 'candidates_vacancy_after.php?title=".$row['title']."' class='btn btn-success' style='text-decoration:none;'><b>Info</b></a>";  
                                }
                                else{
                                    echo "<a href = 'candidates_vacancy.php?id=".$row1['id']."' class='btn btn-success' style='text-decoration:none;'><b>Cancel</b></a>"; 
                                }
                                ?></p>
                        </td>
                        <?php
                        goto Start;
                            } 
                        }
                            
                        ?>

                        <td class="active">
                            <p class="apply">
                                <?php 
                                    echo "<a href = 'candidates_vacancy_details.php?title=".$row['title']."' class='btn' style='text-decoration:none;'><b>Details</b></a>"; 
                                ?></p>
                        </td>
                        <td class="edit">
                                <?php 
                                    echo "<a href = 'candidates_apply.php?title=".$row['title']."' class='btn btn-info' style='text-decoration:none;'><b>Apply</b></a>"; 
                                ?>
                        </td>
                    </tr>
                    <?php
                    Start:
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>