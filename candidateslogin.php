<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = false;
    include '_db_connection.php';
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "Select * from candidates where email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("location: candidates_dashboard.php");
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
    <link rel="stylesheet" href="css/candidateslogin.css">
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
        <section class="login">
        <h2>Candidates Login</h2>
            <form action="../campus recruitment/candidateslogin.php" method="post">
                <div class="txt_field">
                    <input type="email" id="email" name="email" required>
                    <label for="email"><i class="fa-solid fa-user"></i>  Email</label>
                </div>
                
                <div class="txt_field">
                    <input type="password" id="password" name="password" required>
                    <label for="password"><i class="fa-solid fa-unlock"></i>  Password</label>
                </div>

                <div class="signup">
                <p>Don't have an account?<a href="candidatessignup.php"> Sign up </a>here.</p>
                </div>

                <button type="submit" class="sign-in">
                    Sign in
                </button>
            </form>
        </section>
        </div>

        <img src="image/pngegg.png" alt="" class="feature-img">
    </div>
     
</body>
</html>