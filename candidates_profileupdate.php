<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: candidateslogin.php");
    exit;
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $sql = "UPDATE `candidates` SET `name` = '$name',`email` = '$email', `age` = '$age', `gender` = '$gender',`phone` ='$phone', `password` = '$password' WHERE `candidates`.`email` = '$email'";
    $result = mysqli_query($conn, $sql);

    header("location: candidates_profile.php");

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
    <link rel="stylesheet" href="css/candidates_profileupdate.css">
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
            Candidates Profile
        </h3>
            
        <div class="board">
            <div class="container">
                <form action="../campus recruitment/candidates_profileupdate.php" method="post">
                <?php
                $sql = "SELECT * FROM candidates WHERE email='$email'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <div class="row">
                        <div class="col">
                            <div class="inputBox">
                                <span>Name :</span>
                                <input type="text" value="<?php echo $row['name'];?>" name="name">
                            </div>
                            <div class="inputBox">
                                <span>Mobile Number :</span>
                                <input type="text" value="<?php echo $row['phone'];?>" name="phone">
                            </div>

                            <div class="inputBox">
                                <span>Email :</span>
                                <input type="email" value="<?php echo $row['email'];?>" name="email"  readonly>
                            </div>
                        </div>
    
                        <div class="col">
                                <div class="inputBox">
                                    <span>Gender :</span>
                                    <input type="text" value="<?php echo $row['gender'];?>" name="gender">
                                </div>
                                <div class="inputBox">
                                    <span>Age :</span>
                                    <input type="text" value="<?php echo $row['age'];?>" name="age">
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