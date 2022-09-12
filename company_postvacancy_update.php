<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
    include '_db_connection.php';
?>

<?php
if(isset($_GET['title'])){
    $title = $_GET['title'];
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $email = $_SESSION['email'];
    $title = $_POST['title'];
    $vacancy = $_POST["vacancy"];
    $salary = $_POST["salary"];
    $address = $_POST["address"];
    $expire_date = $_POST["expire_date"];
    $requirement = $_POST["requirement"];

    $sql = "UPDATE `vacancy` SET `title` = '$title',`email` = '$email',`vacancy` = '$vacancy',`salary` = '$salary', `address` = '$address', `expire_date` = '$expire_date',`requirement` ='$requirement' WHERE `vacancy`.`email` = '$email' AND `vacancy`.`title` = '$title'";
    $result = mysqli_query($conn, $sql);

    header("location: company_postvacancy.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/company_postvacancy_update.css">
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
                <form action="../campus recruitment/company_postvacancy_update.php" method="post">
                <?php
                $sql = "SELECT * FROM vacancy WHERE email='$email' AND title='$title'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <div class="row">
                        <div class="col">
                            <div class="inputBox">
                                <span>Job Title :</span>
                                <input type="text" value="<?php echo $row['title'];?>" name="title" readonly>
                            </div>
                            <div class="inputBox">
                                <span>Vacancy :</span>
                                <input type="number" value="<?php echo $row['vacancy'];?>" name="vacancy">
                            </div>

                            <div class="inputBox">
                                <span>Salary :</span>
                                <input type="text" value="<?php echo $row['salary'];?>" name="salary" >
                            </div>
                        </div>
    
                        <div class="col">
                                <div class="inputBox">
                                    <span>Address :</span>
                                    <input type="text" value="<?php echo $row['address'];?>" name="address">
                                </div>
                                <div class="inputBox">
                                    <span>Expire date :</span>
                                    <input type="date" value="<?php echo $row['expire_date'];?>" name="expire_date">
                                </div>
                                <div class="inputBox">
                                    <span>CGPA at least :</span>
                                    <input type="float" value="<?php echo $row['requirement'];?>" name="requirement">
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