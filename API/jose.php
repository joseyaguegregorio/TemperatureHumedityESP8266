<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if(isset($_REQUEST["cont"])){
$cont = $_REQUEST['cont'] + 1;
echo "<h1 id = 'contador'>$cont</h1>";
}
else{
    echo "Nada";
}


?>
<!-- <h1>Hola</h1> -->
<script>
// setTimeout("recarga()",3000);
// setTimeout(() => recarga(),3000);
// function recarga(){
//     location.reload();
// }
var cont = document.getElementById('contador').innerText;
console.log(cont);
window.location.replace('/TemperatureHumedityESP8266/API/jose.php?cont='+cont);


</script>
    
</body>
</html>