<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>



 
    <title>Document</title>
</head>
<body>
<h2 id = "idTemperatura"></h2>
<h2 id = "idHumedad"></h2>
<h2 id = "idFecha"></h2>
</br></br></br>
<h2>Temperaturas</h2>
<canvas id="myChartTemperatura" width="300" height="200"></canvas>
<h2>Humedades</h2>
<canvas id="myChartHumedad" width="300" height="200"></canvas>
<script>
    var temperaturas = [];
    var humedaddes = [];
    var fechas = [];
    var request = new XMLHttpRequest();
    request.open('GET', 'prueba.php', false);  // `false` makes the request synchronous
    request.send(null);

    if (request.status === 200) {
    // console.log(request.responseText);
    myParseo(JSON.parse(request.responseText));
    }

    function myParseo(json) {
       for (let i = 0; i< json.length; i++) {
        //    if(i%10 == 0){ //Divisiones consideradas de la curva
            // console.log(json[i][2]);
                temperaturas.push(json[i][0]);
                humedaddes.push(json[i][1]);
                var fechasAcortadas = json[i][2].slice(11,16);
                fechas.push(fechasAcortadas);  
        //    }
                
        }
    }

document.getElementById('idTemperatura').innerText = "Temperatura: "+temperaturas[0] + " °C";
document.getElementById('idHumedad').innerText = "Humedad: "+temperaturas[0] + " %";
document.getElementById('idFecha').innerText = "Hora: "+fechas[0];



    
console.log(fechas);
//temperatura
    
    var ctx = document.getElementById('myChartTemperatura').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas.reverse(),
            datasets: [{
                label: 'Temperatura',
                data: temperaturas.reverse(),
                // backgroundColor: [
                //     'rgba(255, 99, 132, 0.2)',
                //     'rgba(54, 162, 235, 0.2)',
                //     'rgba(255, 206, 86, 0.2)',
                //     'rgba(75, 192, 192, 0.2)',
                //     'rgba(153, 102, 255, 0.2)',
                //     'rgba(255, 159, 64, 0.2)'
                // ],
                borderColor: 
                    'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            elements: {
                    point:{
                        radius: 2
                    }
                },
                legend: {
                    display: false
                },
                
        }
    });


//Humedad
var ctx = document.getElementById('myChartHumedad').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas.reverse(),
            datasets: [{
                label: 'Temperatura',
                data: humedaddes.reverse(),
                // backgroundColor: [
                //     'rgba(255, 99, 132, 0.2)',
                //     'rgba(54, 162, 235, 0.2)',
                //     'rgba(255, 206, 86, 0.2)',
                //     'rgba(75, 192, 192, 0.2)',
                //     'rgba(153, 102, 255, 0.2)',
                //     'rgba(255, 159, 64, 0.2)'
                // ],
                borderColor: 
                    'rgba(51, 185, 255, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            elements: {
                    point:{
                        radius: 2
                    }
                },
                legend: {
                    display: false
                },
                
        }
    });

</script>
        <!-- <script>
        var xhr = new XMLHttpRequest();
        xhr.open('GET','prueba.php');
        xhr.onload = function(){
            if(xhr.status == 200){
                var json = JSON.parse(xhr.responseText);
                for (let i = 0; i< json.length; i++) {
                    console.log(json[i][2]);
                }
            }else{
                console.log("Algo salio mal")
            }
        }
        xhr.send();
        
        
        </script> -->
</body>
</html>