<?php

$fichero = fopen("temperaturas.txt","a+");
$temperaturaRecibida = date("H:i:s")."    Temperatura: ".$_REQUEST["temperatura"] . "\n";
fwrite($fichero, $temperaturaRecibida);
fclose($fichero);


?>




