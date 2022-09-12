<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_SESSION['email'];
    $target = "images/".basename($_FILES['pic']['name']);

    include '_db_connection.php';

    $pic = $_FILES["pic"]['name'];

    // $sql = "INSERT INTO `company` ( `pic`) VALUES ('$pic') WHERE email='$email'";
    // mysqli_query($conn, $sql);
    // move_uploaded_file($_FILES['imagefile']['tmp_name'],$target);

    // $pic = addslashes(file_get_contents($_FILES["pic"]["tmp_name"]));
    $sql = "UPDATE `company` SET  `pic` = '$pic' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    move_uploaded_file($_FILES['pic']['tmp_name'],$target);

    header("location: company_profile.php");

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
    <link rel="stylesheet" href="css/company_profile.css">
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
            Company Profile
        </h3>
            
        <div class="board">
            <div class="col">
            <div class="row">
                    <?php
                    $sql = "SELECT * FROM company WHERE email='$email'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {?>
                    <div class="name">
                            <h3>Company Name:</h3>
                            <p><?php echo $row['company_name'];?></p>
                    </div>  

                    <div class="name">
                        <h3>Type:</h3>
                        <p><?php echo $row['type'];?></p>
                    </div>

                    <div class="name">
                        <h3>Email:</h3>
                        <p><?php echo $row['email'];?></p>
                    </div>

                    <div class="name">
                        <h3>Address:</h3>
                        <p><?php echo $row['address'];?></p>
                    </div>

                    <div class="name">
                        <h3>Phone:</h3>
                        <p><?php echo $row['phone'];?></p>
                    </div>
                    <?php
                        }
                    ?>
            </div>

            <div class="row">
                        <div class="profile-pic">
                        <form action="../campus recruitment/company_profile.php" method="post" enctype="multipart/form-data">   
                        <div class="profile">
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
                            <input type="file" name="pic"><br>
                            <button type="submit" class="submit-btn">
                                Upload a photo
                            </button>
                        </form> 
                        </div>
                </div>

            </div>
            <button type="submit" class="update" >
                <a href="company_profileupdate.php">Change Information</a> 
            </button>
        </div>
    </section>
</body>
</html>