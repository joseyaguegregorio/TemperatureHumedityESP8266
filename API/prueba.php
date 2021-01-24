<?php
// SELECT * FROM `temperaturas` WHERE temperaturas.id % 5 = 0 ORDER BY temperaturas.fecha DESC LIMIT 2
include_once "variables.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$respuesta = array();

$sql = "SELECT * FROM `temperaturas` WHERE temperaturas.id % 5 = 0 ORDER BY temperaturas.fecha DESC LIMIT 5"; //actualmente serian 12 horas, ya que el esp mide cada dos minutos
if ($resultado = mysqli_query($conn, $sql)) {
    // printf("La selección devolvió %d filas.\n", mysqli_num_rows($resultado));

    while( $row = $resultado->fetch_assoc() ) {
     $temporal = array();
     $temporal[] = $row["temperatura"];
     $temporal[] = $row["humedad"];
     $temporal[] = $row["fecha"];
     $respuesta[] = $temporal;
  }
    mysqli_free_result($resultado);
}

mysqli_close($conn);

function mostarHtml(){
  global $respuesta;
  for ($i=0; $i < count($respuesta); $i++) { 
    echo "<h1>Temperatura:  ". $respuesta[$i][0] . " C</h1>";
    echo "<h1>Humedad:  ". $respuesta[$i][1] . " %</h1>";
    echo "<h1>Fecha:  ". $respuesta[$i][2] . "</h1>";
    echo "</br></br></br></br>";
  }
}

function mostrarJson(){
  global $respuesta;  
  echo json_encode($respuesta);
}

// mostarHtml();
mostrarJson();
?>







