<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = false;
    $name = $_POST["name"];
    $password = $_POST["password"];

    if( $name == 'admin' && $password == '123456'){
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $name;
        header("location: admin_dashboard.php");
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
    <link rel="stylesheet" href="css/adminlogin.css">
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
        <h2>Login</h2>
            <form action="../Campus Recruitment/adminlogin.php" method="post">
                <div class="txt_field">
                    <input type="text" id="name" name="name" required>
                    <label for="name"><i class="fa-solid fa-user"></i>  Username</label>
                </div>
                
                <div class="txt_field">
                    <input type="password" id="password" name="password" required>
                    <label for="password"><i class="fa-solid fa-unlock"></i>  Password</label>
                </div>

                <!-- <div class="signup">
                <p>Don't have an account?<a href="#"> Sign up </a>here.</p>
                </div> -->

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