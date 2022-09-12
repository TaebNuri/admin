<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: candidateslogin.php");
    exit;
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
    <link rel="stylesheet" href="css/candidates_report.css">
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
                <!-- <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search">
                </div> -->
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
            Reports
        </h3>


        <div class="board">
            <form action="../campus recruitment/candidates_reports.php" method="post">
                <div class="txt_field">
                    <label for="date1">  From Date</label><br>
                    <input type="date" id="date" name="date1" required>
                </div>
                
                <div class="txt_field">
                    <label for="date2">  To Date</label><br>
                    <input type="date" id="date" name="date2" required>
                </div>

                <button type="submit" class="sign-in">
                    Submit
                </button>
            </form>
        </div>

        <div class="board1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Company Name</td>
                        <td>Job Des.</td>
                        <td>Contact</td>
                        <td>Salary</td>
                        <td>CGPA Needed</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    include '_db_connection.php';
                    $date1 = $_POST['date1'];
                    $date2 = $_POST['date2'];
                    
                    $date1 = strtotime($date1);
                    $date2 = strtotime($date2);
                
                    $sql = "SELECT * FROM company,vacancy WHERE `company`.`email` = `vacancy`.`email`";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                    $date11 = $row['dt'];
                    $date11 = strtotime($row['dt']);
                    if($date1<=$date11 && $date2>=$date11){
                    ?>
                    <tr>
                       <td class="company">
                            <div class="company_name">
                            <h5><?php echo "<img src = 'images/".$row['pic']."'>" ;
                                 echo $row['company_name'];?></h5>
                            </div>
                        </td>

                        <td class="people">
                            <div class="people-de">
                                <h5><?php echo $row['title'];?></h5>
                                <p><?php echo $row['vacancy'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['email'];?></h5>
                            <p><?php echo $row['address'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['salary'];?></p>
                        </td>

                        <td class="active">
                            <p><?php echo $row['requirement'];?></p>
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    }
                ?>
                </tbody>
            </table>
            
        </div>

    </section>
</body>
</html>