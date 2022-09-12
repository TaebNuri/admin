<?php
    include '_db_connection.php';
    $sql = "SELECT * FROM vacancy";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){

    $exp_date = $row['expire_date'];
    $today = date('Y/m/d');
    $exp = strtotime($exp_date);
    $td = strtotime($today);
    $title = $row['title'];
    $email = $row['email'];

    if($td>$exp){
        $delete = mysqli_query($conn,"DELETE FROM `vacancy` WHERE `expire_date`='$exp'");
        $delete = mysqli_query($conn,"DELETE FROM `apply` WHERE `title`='$title' AND `email1`='$email'");
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
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
            <p>Get your dream job</p>
            <h1>You should always <br> fell confident</h1>
            <p>Job that are sure to make your life smoother</p>
        </div>

        <img src="image/pngegg.png" alt="" class="feature-img">
    </div>
</body>
</html>