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
    include '_db_connection.php';
    $email = $_SESSION['email'];
    $company_name = $_POST["company_name"];

    // $pic = addslashes(file_get_contents($_FILES["pic"]["tmp_name"]));

    $type = $_POST["type"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $sql = "UPDATE `company` SET `company_name` = '$company_name',`email` = '$email', `type` = '$type', `address` = '$address',`phone` ='$phone', `password` = '$password' WHERE `company`.`email` = '$email'";
    $result = mysqli_query($conn, $sql);

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
    <link rel="stylesheet" href="css/company_profileupdate.css">
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
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div>
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
            <div class="container">
                <form action="../campus recruitment/company_profileupdate.php" method="post" >
                <?php
                $sql = "SELECT * FROM company WHERE email='$email'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <div class="row">
                        <div class="col">
                            <div class="inputBox">
                                <span>Company Name :</span>
                                <input type="text" value="<?php echo $row['company_name'];?>" name="company_name" >
                            </div>
                            <div class="inputBox">
                                <span>Mobile Number :</span>
                                <input type="text" value="<?php echo $row['phone'];?>" name="phone">
                            </div>

                            <div class="inputBox">
                                <span>Profile pic :</span>
                                <input type="text" value="<?php echo $row['email'];?>" name="email" readonly>
                            </div>
                        </div>
    
                        <div class="col">
                                <div class="inputBox">
                                    <span>Address :</span>
                                    <input type="text" value="<?php echo $row['address'];?>" name="address">
                                </div>
                                <div class="inputBox">
                                    <span>Type :</span>
                                    <input type="text" value="<?php echo $row['type'];?>" name="type">
                                </div>
                                <div class="inputBox">
                                    <span>Password :</span>
                                    <input type="password" value="<?php echo $row['password'];?>" name="password">
                            </div>
                        </div>
                    </div>
                   <button type="submit" class="submit-btn">
                    Update Profile
                    </button>
                 <?php
                    }
                 ?>
                </form>
            </div>
        </div>
    </section>
</body>
</html>