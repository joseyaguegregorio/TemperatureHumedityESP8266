<?php
include_once "variables.php";
// if(isset($_REQUEST["temperatura"])&& isset($_REQUEST["humedad"])){
  if(isset($_REQUEST["temperatura"])&& isset($_REQUEST["humedad"])){
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "database";
// $servername = "localhost";
// $username = "id15866687_yaguegjm";
// $password = "Sofia685823610.";
// $dbname = "id15866687_database";



// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// mysqli_close($conn);
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// // sql to create table
// $sql = "CREATE TABLE temperaturas (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// temperatura VARCHAR(30) NOT NULL
// )";

$temperaturaRecibida = $_REQUEST["temperatura"];
$humedadRecibida = $_REQUEST["humedad"];


$sql = "INSERT INTO temperaturas (temperatura, humedad)
VALUES ('$temperaturaRecibida','$humedadRecibida')";

if (mysqli_query($conn, $sql)) {
  echo "Query salio bien ";
} else {
  echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

}
else{
    echo"Debes de mandar una temperatura y humedad ?temperatura=&humedad";
}

?>




