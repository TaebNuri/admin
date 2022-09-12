<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: candidateslogin.php");
    exit;
}
?>

<?php
if(isset($_GET['title'])){
    $title = $_GET['title'];
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
    <link rel="stylesheet" href="css/candidates_vacancy_details.css">
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
        <div class="hero">
        <?php
                $sql = "SELECT * FROM vacancy WHERE email=`vacancy`.`email` AND title='$title'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
            <div class="detail">
                        <div class="title">
                            <h3>Job Title:</h3>
                            <p><?php echo $row['title'];?></p>
                        </div>

                        <div class="salary">
                            <h3>Salary:</h3>
                            <p><?php echo $row['salary'];?></p>
                        </div>

                        <div class="address">   
                            <h3>Address:</h3>
                            <p><?php echo $row['address'];?></p>
                        </div>

                        <div class="description">
                            <h3>Job Responsibility:</h3>
                            <p><?php echo $row['message'];?></p>
                        </div>
                        <br>
                        <div class="vacancy">
                            <h3>Interview information</h3>
                            <p>Please come to our address or contact via email for more info.</p>
                            <p><?php echo "Your interview will be held on " .$row['interview_date'].".";?></p>
                        </div>
                    </div>
                </div>
        </div>
        <?php
                }
        ?>
    </section>
</body>
</html>