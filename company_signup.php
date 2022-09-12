<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $company_name = $_POST["company_name"];
    $email = $_POST["email"];
    $type = $_POST["type"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    

    // $exists = false;
    $existsql = "SELECT * FROM company WHERE password = '$password'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);
    
    $existsql1 = "SELECT * FROM company WHERE email = '$email'";
    $result1 = mysqli_query($conn, $existsql1);
    $numExistRows1 = mysqli_num_rows($result1);


    
    if($numExistRows1 > 0){
        $showerror = "Email has been already used";
    }
    elseif($numExistRows > 0){
        $showerror = "Password has been already used";
    }
    elseif(($password == $cpassword)){
        $sql = "INSERT INTO `company` ( `company_name`,`email`, `type`, `address`,`phone`, `password`, `dt`) VALUES ('$company_name','$email', '$type', '$address', '$phone', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showalert = true;
        }
    }
    else{
        $showerror = "Please provide same password";
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
    <link rel="stylesheet" href="css/company_signup.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css1/all.css">

    <title>Campus Recruitment</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a class="logo" href="#">Campus<span>Recruitment</span></a>
      
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <!-- <li><a href="#">About</a></li> -->
                    <li><a href="company_login.php">Employer</a></li>
                    <li><a href="candidateslogin.php">Candidate</a></li>
                </ul>
            </nav>
      
            <a class="admin" href="adminlogin.php">Admin</a>
        </div>

        <div class="content">
        <?php
            if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account has been created.
                </div>';
            }
            if($showerror){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> '.$showerror.'
                    </div>';
                }
        ?>
        <section class="login">
        <h2>Create an account</h2>
            <form action="../campus recruitment/company_signup.php" method = "post">
                <div class="txt_field">
                    <input type="text" id="company_name" name="company_name" required>
                    <label for="company_name"><i class="fa-solid fa-user"></i>  Company name</label>
                </div>
                
                <div class="txt_field">
                    <input type="email" id="email" name="email" required>
                    <label for="email"><i class="fa-solid fa-envelope"></i>  Email</label>
                </div>

                <div class="txt_field">
                    <input type="text" id="type" name="type" required>
                    <label for="type"><i class="fa-solid fa-image"></i>  Type</label>
                </div>

                <div class="txt_field">
                    <input type="text" id="address" name="address" required>
                    <label for="address"><i class="fa-solid fa-location-dot"></i>  Address</label>
                </div>

                <div class="txt_field">
                    <input type="text" id="phone" name="phone" required>
                    <label for="phone"><i class="fa-solid fa-phone"></i>  Phone</label>
                </div>

                <div class="txt_field">
                    <input type="password" id="password" name="password" required>
                    <label for="password"><i class="fa-solid fa-unlock"></i>  Password</label>
                </div>

                <div class="txt_field">
                    <input type="password" id="cpassword" name="cpassword" required>
                    <label for="cpassword"><i class="fa-solid fa-unlock"></i>  Confirm Password</label>
                </div>

                <div class="signup">
                <p>Already have an account.<a href="company_login.php"> Login </a></p>
                </div>

                <button type="submit" class="sign-in">
                    Sign up
                </button>
            </form>
        </section>
        </div>
    </div>
</body>
</html>