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

<?php
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $target = "images/".basename($_FILES['cv']['name']);
    $email = $_SESSION['email'];
    $name = $_POST["name"];
    $title = $_POST["title"];
    $email1 = $_POST['email1'];
    $grade3 = $_POST["grade3"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $subject3 = $_POST["subject3"];
    $cv = $_FILES["cv"]['name'];
    $status = 'applied';

    $sql = "SELECT * FROM educational_form WHERE email = '$email'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $sql1 = "SELECT * FROM vacancy WHERE email = '$email1' AND title = '$title'";
    $query1 = $conn->query($sql1);
    $row1 = $query1->fetch_assoc();

    $sql2 = "SELECT * FROM candidates WHERE email='$email'";
    $query2 = $conn->query($sql2);
    $row2 = $query2->fetch_assoc();
    
    if($row2['ok']=='ok'){
        $showerror = "Your account has been diactivated.";
    }
    else{
        if($row['grade3'] < $grade3){
            $showerror = "Your grade is not matched for this job";
        }
    
        elseif($row1['subject3'] != $subject3 ){
            $showerror = "Your department is not matched for this job";
        }
    
        else{
        $sql = "INSERT INTO `apply` ( `email`,`email1`, `name`, `age`,`subject3`, `gender`, `grade3`, `title`, `cv`, `dt`,`status`) VALUES ('$email','$email1', '$name', '$age', '$subject3', '$gender','$grade3','$title','$cv', current_timestamp(), '$status' )";
        $result = mysqli_query($conn, $sql);
        move_uploaded_file($_FILES['cv']['tmp_name'],$target);
        }
    }
    

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/candidates_apply.css">
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
                <div class="search">
                <?php
                    if($showerror){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>'.$showerror.'</strong> 
                            </div>';
                        }
                    ?>
                </div>
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
            Information 
        </h3>
        <?php
        $existsql1 = "SELECT * FROM educational_form WHERE email = '$email'";
        $result1 = mysqli_query($conn, $existsql1);
        $numExistRows1 = mysqli_num_rows($result1);
        if($numExistRows1 > 0){
        ?>
        <div class="board">
            <div class="container">
                <form action="candidates_apply.php" method="post" enctype="multipart/form-data">
                <?php
                $sql = "SELECT * FROM vacancy WHERE email=`vacancy`.`email` AND title='$title'";
                $sql1 = "SELECT * FROM candidates WHERE email='$email'";
                $sql2 = "SELECT * FROM educational_form WHERE email='$email'";
                $query = $conn->query($sql);
                $query1 = $conn->query($sql1);
                $query2 = $conn->query($sql2);
                $row1 = $query1->fetch_assoc();
                $row2 = $query2->fetch_assoc();
                while($row = $query->fetch_assoc())
                {?>
                    <div class="row">
                        <div class="col">
                            <div class="inputBox">
                                <span>Name :</span>
                                <input type="text" value="<?php echo $row1['name'];?>" name="name" readonly>
                            </div>
                            <div class="inputBox">
                                <span>Job title :</span>
                                <input type="text" value="<?php echo $row['title'];?>" name="title" readonly>
                            </div>

                            <div class="inputBox">
                                <span>Email :</span>
                                <input type="email" value="<?php echo $row['email'];?>" name="email1" readonly>
                            </div>

                            <div class="inputBox">
                                <span>CGPA Needed :</span>
                                <input type="number" step=".01" value="<?php echo $row['requirement'];?>" name="grade3"  readonly>
                            </div>
                        </div>
    
                        <div class="col">
                                <div class="inputBox">
                                    <span>Gender :</span>
                                    <input type="text" value="<?php echo $row1['gender'];?>" name="gender" readonly>
                                </div>
                                <div class="inputBox">
                                    <span>Age :</span>
                                    <input type="number" value="<?php echo $row1['age'];?>" name="age" readonly>
                                </div>
                                <div class="inputBox">
                                    <span>Subject :</span>
                                    <input type="text" value="<?php echo $row2['subject3'];?>" name="subject3" readonly>
                                </div>

                                <div class="inputBox">
                                    <span>Drop your cv :</span>
                                    <input type="file" placeholder="CV" name="cv" required>
                                </div>
                        </div>
                    </div>
                 <input type="submit" value="Apply" class="submit-btn">
                 <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        <?php
        }else{
            ?>
        <div class="board">
            <div class="container">
                <p>Please fill up the educational form first</p>
            </div>
        </div>
        <?php
            }
            ?>
    </section>
</body>
</html>