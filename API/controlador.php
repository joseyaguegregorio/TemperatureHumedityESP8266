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


$sql = "SELECT * FROM `temperaturas` ORDER BY temperaturas.fecha DESC LIMIT 360"; //actualmente serian 12 horas, ya que el esp mide cada dos minutos
if ($resultado = mysqli_query($conn, $sql)) {
    // printf("La selección devolvió %d filas.\n", mysqli_num_rows($resultado));
    //Como el sensor tiene un error de medicion de 0.5 grados, para que las mediciones sean mas precisas, hago una media
    $cont = 1;//Para que la primera vuelta no coja el valor, ya que sino en esta no se realizaria media.
    $contMedia = 0;
    $temperaturas = 0;
    $humedades = 0;
    while( $row = $resultado->fetch_assoc() ) {
      $contMedia++;
      $temperaturas += $row["temperatura"];
      $humedades += $row["humedad"];
      //Solo se envian una de cada 25 mediciones
      if($cont%25==0){
        $temporal = array();
        $temporal[] = round($temperaturas/$contMedia,2);
        $temporal[] = round($humedades/$contMedia,2);
        $temporal[] = $row["fecha"];
        $respuesta[] = $temporal;
        $temperaturas = 0;
        $humedades = 0;
        $contMedia = 0;
      }
      $cont++;
     
  }
    mysqli_free_result($resultado);
}

mysqli_close($conn);

// function mostarHtml(){
//   global $respuesta;
//   for ($i=0; $i < count($respuesta); $i++) { 
//     echo "<h1>Temperatura:  ". $respuesta[$i][0] . " C</h1>";
//     echo "<h1>Humedad:  ". $respuesta[$i][1] . " %</h1>";
//     echo "<h1>Fecha:  ". $respuesta[$i][2] . "</h1>";
//     echo "</br></br></br></br>";
//   }
// }

function mostrarJson(){
  global $respuesta;  
  echo json_encode($respuesta);
}

// mostarHtml();
// mostrarJson();
if(isset($_REQUEST["json"])){
  mostrarJson();
}

?>







