<?php
session_start();
$email = $_SESSION['email'];

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: company_login.php");
    exit;
}
?>

<?php
$showalert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $email = $_SESSION['email'];
    $title = $_POST["title"];
    $vacancy = $_POST["vacancy"];
    $salary = $_POST["salary"];
    $address = $_POST["address"];
    $requirement = $_POST["requirement"];
    $message = $_POST["message"];
    $expire_date = $_POST["expire_date"];
    $interview_date = $_POST["interview_date"];
    $subject3 = $_POST["subject3"];

    $existsql = "SELECT * FROM vacancy WHERE email = '$email' AND title = '$title'";
    $result1 = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result1);

    $sql1 = "SELECT * FROM company WHERE email='$email'";
    $query1 = $conn->query($sql1);
    $row1 = $query1->fetch_assoc();

    if($row1['ok']=='ok'){
        $showalert = "Your account has been diactivated.";
    }

    else{
        if($numExistRows > 0){
            $showalert = "You already posted for this position";
        }
        else{
            $sql = "INSERT INTO `vacancy` ( `email`,`title`, `vacancy`, `salary`,`address`, `requirement`, `message`, `expire_date`, `dt`, `subject3`, `interview_date`) VALUES ('$email','$title', '$vacancy', '$salary', '$address', '$requirement','$message','$expire_date', current_timestamp(),'$subject3','$interview_date')";
            $result = mysqli_query($conn, $sql);

            if($result){
                $showalert = "Your post uploded successfuly";
            }
        }
    }
    

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script >
        $(document).ready(function(){
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month<10){
                month='0' + month.toString();
            }
            if(day<10){
                day='0' + day.toString();
            }
            var maxDate = year + '-' + month + '-' + day;
            $('#dateControl').attr('min',maxDate);
            $('#dateControl1').attr('min',maxDate);
        })
    </script>
    <link rel="stylesheet" href="css/company_postvacancy.css">
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
            <?php
                    if($showalert){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>'.$showalert.'</strong> 
                            </div>';
                        }
                    ?>
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
        <div class="hero">
            <form action="../campus recruitment/company_postvacancy.php" method="post">
                <div class="row">
                    <div class="input-group">
                        <input type="text" id="title"  name="title" required>
                        <label for="title"><i class="fa-brands fa-cuttlefish"></i>  Job Title</label>
                    </div>
                    <div class="input-group">
                        <input type="number" id="vacancy" name="vacancy" required>
                        <label for="vacancy"><i class="fa-solid fa-file"></i>  Vacancy</label>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="input-group">
                        <input type="text" id="salary" name="salary" required>
                        <label for="salary"><i class="fa-solid fa-money-check-dollar"></i>  Salary</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" id="address" name="address" required>
                        <label for="address"><i class="fa-solid fa-address-book"></i>  Address</label>
                    </div>
                </div>

                <div class="row">
                <div class="input-group">
                    <p>Expire date</p>
                    <input type="date" id="dateControl" name="expire_date" style="color:#fff;" required>
                    <!-- <label for="expire_date"><i class="fa-solid fa-book"></i>  Application deadline</label> -->
                </div>

                <div class="input-group">
                    <p>Interview date</p>
                    <input type="date" id="dateControl1" name="interview_date" style="color:#fff;" required>
                    <!-- <label for="interview_date"><i class="fa-solid fa-book"></i>  Interview date</label> -->
                </div>
                </div>

                <div class="input-group">
                    <input type="number" id="requirement" step=".01" name="requirement" min="1" max="4" required>
                    <label for="requirement"><i class="fa-solid fa-book"></i>  CGPA at least</label>
                </div>

                <div class="input-group">
                    <select class="multiple-select" id="subject3" name="subject3" style="color:#fff;" required>
                                <option value="BBA">BBA</option>
                                <option value="BCSE">BCSE</option>
                                <option value="BSCE">BSCE</option>
                                <option value="BSME">BSME</option>
                                <option value="BSEEE">BSEEE</option>
                                <option value="BSN">BSN</option>
                                <option value="BATHM">BATHM</option>
                                <option value="BSAg">BSAg</option>
                                <option value="BAEcon">BAEcon</option>
                    </select>   
                </div>

                <div class="input-group">
                    <textarea id="message" rows="6" name="message" required></textarea>
                    <label for="message"><i class="fa-solid fa-circle-info"></i>  Job Responsibility</label>
                </div>
                <button type="submit">SUBMIT<i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>

    </section>
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>$(".multiple-select").select2({
  });</script> -->

</body>
</html>

