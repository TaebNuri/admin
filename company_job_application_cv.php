<?php
 include '_db_connection.php';
$id = $_GET['id'];

$sql = "SELECT * FROM apply WHERE id='$id'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo "<iframe src='images/".$row['cv']."' width=\"100%\" style=\"height:100%\"></iframe>";

// header("content-disposition: attacment; filename=".
//         urlencode($cv));

//         $fb = fopen($file, "r");
//         while(!feof($fb)){
//             echo fread($fb, 8192);
//         }

//         fclose($fb);

?>