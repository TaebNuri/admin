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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/company_report.css">
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
            Reports
        </h3>


        <div class="board">
            <form action="../campus recruitment/company_reports.php" method="post">
                <div class="txt_field">
                    <label for="date1">  From Date</label><br>
                    <input type="date" id="date" name="date1" required>
                </div>
                
                <div class="txt_field">
                    <label for="date1">  To Date</label><br>
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
                        <td>Applicant Name</td>
                        <td>Phone </td>
                        <td>Educational background</td>
                        <td>Application date</td>
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
                
                    $sql = "SELECT * FROM apply WHERE email1='$email'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                    $date11 = $row['dt'];
                    $date11 = strtotime($row['dt']);
                    if($date1<=$date11 && $date2>=$date11){
                    ?>
                    <tr>
                        <td class="people">
                            <img src="image/student.png" alt="">
                            <div class="people-de">
                                <h5><?php echo $row['name'];?></h5>
                                <p><?php echo $row['gender'];?></p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5><?php echo $row['email'];?></h5>
                            <p><?php echo $row['age'];?></p>
                        </td>

                        <td class="age">
                            <p>CGPA <?php echo $row['grade3'];?></p>
                            <p><?php echo $row['subject3'];?></p>
                        </td>

                        <td class="active">
                            <p><?php echo $row['dt'];?></p>
                        </td>

                        <!-- <td class="edit">
                            <a href="#">Edit</a>
                        </td> -->
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