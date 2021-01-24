<?php
//local
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "database";
// $respuesta = Array();
//host
// $servername = "localhost";
// $username = "id15866687_yaguegjm";
// $password = "Sofia685823610.";
// $dbname = "id15866687_database";
include_once "variables.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}



$sql = "SELECT * FROM `temperaturas` WHERE id = (SELECT MAX(id) FROM `temperaturas`)";
if ($resultado = mysqli_query($conn, $sql)) {
    // printf("La selección devolvió %d filas.\n", mysqli_num_rows($resultado));
    $valor = $resultado->fetch_assoc();
    $respuesta["temperatura"] = $valor["temperatura"];
    $respuesta["fecha"] = $valor["fecha"];
    $respuesta["humedad"] = $valor["humedad"];
    /* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
}

// while ($fila = mysql_fetch_assoc($resultado)) {
//     echo $fila['temperatura'];
    
// }
mysqli_close($conn);

function mostarHtml(){
  global $respuesta;
  echo "<h1>Temperatura:  ". $respuesta["temperatura"] . " C</h1>";
  echo "<h1>Humedad:  ". $respuesta["humedad"] . " %</h1>";
  echo "<h1>Fecha:  ". $respuesta["fecha"] . "</h1>";
}

function mostrarJson(){
  global $respuesta;
  echo json_encode($respuesta);
}

// mostarHtml();
// mostrarJson();
?>







