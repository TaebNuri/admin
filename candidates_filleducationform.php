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

<?php
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_db_connection.php';
    $email = $_SESSION['email'];
    $subject1 = $_POST["subject1"];
    $subject2 = $_POST["subject2"];
    $subject3 = $_POST["subject3"];
    $year1 = $_POST["year1"];
    $year2 = $_POST["year2"];
    $year3 = $_POST["year3"];
    $grade1 = $_POST["grade1"];
    $grade2 = $_POST["grade2"];
    $grade3 = $_POST["grade3"];
    
    $existsql = "SELECT * FROM educational_form WHERE email = '$email'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);

    if($numExistRows > 0){
        $showerror = "Your information has been already stored";
    }

    else{
    $sql = "INSERT INTO `educational_form` ( `subject1`,`year1`, `grade1`, `subject2`,`year2`, `grade2`, `subject3`, `year3`, `grade3`, `email`) VALUES ('$subject1','$year1', '$grade1', '$subject2', '$year2', '$grade2','$subject3','$year3','$grade3','$email' )";
    $result = mysqli_query($conn, $sql);
    }

    //header("location: candidates_filleducationform.php");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8656ada1c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/candidates_filleducationalform.css">
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
            Educational Details
        </h3>
        
        <div class="board">
        <form action="../campus recruitment/candidates_filleducationform.php" method="post">
            <div class="detaits">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Level</td>
                        <td>Subject</td>
                        <td>Year</td>
                        <td>Grade</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="level">
                            <h5>Secondary School Certificate</h5>
                        </td>

                        <td class="subject">
                            <label for="subject"></label>
                                <!-- <input type="text" id="subject" name="subject" required> -->
                                <select id="subject" name="subject1" required>
                                    <option value="Science">Science</option>
                                    <option value="Arts">Arts</option>
                                    <option value="Commerce">Commerce</option>
                                  </select>
                        </td>

                        <td class="Year">
                            <label for="Year"></label>
                                <input type="number" id="Year" name="year1" min="2000" max="2022" required>
                        </td>

                        <td class="Grade">
                            <label for="Grade"></label>
                            <input type="number" id="Grade" step=".01" name="grade1" min="1" max="5" required>
                        </td>

                        <!-- <td class="edit">
                            <a href="#">Update</a>
                        </td> -->
                    </tr>

                    <tr>
                        <td class="level">
                            <h5>Higher Secondary School Certificate</h5>
                        </td>

                        <td class="subject">
                            <label for="subject"></label>
                            <select id="subject" name="subject2"required>
                                <option value="Science">Science</option>
                                <option value="Arts">Arts</option>
                                <option value="Commerce">Commerce</option>
                              </select>
                        </td>

                        <td class="Year">
                            <label for="Year"></label>
                                <input type="number" id="Year" name="year2" min="2000" max="2022" required>
                        </td>

                        <td class="Grade">
                            <label for="Grade"></label>
                            <input type="number" id="Grade" name="grade2" step=".01" min="1" max="5" required>
                        </td>

                        <!-- <td class="edit">
                            <a href="#">Update</a>
                        </td> -->
                    </tr>

                    <tr>
                        <td class="level">
                            <h5>Undergraduate</h5>
                        </td>

                        <td class="subject">
                            <label for="subject"></label>
                            <select id="subject" name="subject3" required>
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
                        </td>

                        <td class="Year">
                            <label for="Year"></label>
                                <input type="number" id="Year" name="year3" min="2000" max="2022" required>
                        </td>

                        <td class="Grade">
                            <label for="Grade"></label>
                            <input type="number" id="Grade" name="grade3" step=".01" min="1" max="4" required>
                        </td>

                        <!-- <td class="edit">
                            <a href="#">Update</a>
                        </td> -->
                    </tr>

                     <!-- <tr>
                        <td class="level">
                            <h5>Graduate</h5>
                        </td>

                        <td class="subject">
                            <label for="subject"></label>
                            <select id="subject" name="subject">
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
                        </td>

                        <td class="Year">
                            <label for="Year"></label>
                                <input type="number" id="Year" name="Year" min="2000" max="2022" required>
                        </td>

                        <td class="Grade">
                            <label for="Grade"></label>
                            <input type="number" id="Grade" name="Grade" step=".01" min="1" max="4" required>
                        </td>
                    </tr> -->
                </tbody>
                
            </table>
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
                        <td>Level</td>
                        <td>Subject</td>
                        <td>Year</td>
                        <td>Grade</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM educational_form WHERE email='$email'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {?>
                    <tr>
                        <td class="people">
                            <h5>Secondary School Cirtificate</h5>
                        </td>

                        <td class="people-des">
                            <p><?php echo $row['subject1'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['year1'];?></p>
                        </td>

                        <td class="active">
                            <p><?php echo $row['grade1'];?></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="people">
                            <h5>Higher Secondary School Cirtificate</h5>
                        </td>

                        <td class="people-des">
                            <p><?php echo $row['subject2'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['year2'];?></p>
                        </td>

                        <td class="active">
                            <p><?php echo $row['grade2'];?></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="people">
                            <h5>Undergraduate</h5>
                        </td>

                        <td class="people-des">
                            <p><?php echo $row['subject3'];?></p>
                        </td>

                        <td class="age">
                            <p><?php echo $row['year3'];?></p>
                        </td>

                        <td class="active">
                            <p><?php echo $row['grade3'];?></p>
                        </td>
                    </tr>
                    <?php
                    }
                 ?>
                </tbody>
            </table>
            <a href="candidates_filleducationform_edit.php" class="sign-in">Edit information</a>
        </div>
            
    </section>
</body>
</html>