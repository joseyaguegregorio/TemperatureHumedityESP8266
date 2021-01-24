<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>



 
    <title>Document</title>
</head>
<body>
<h1>Prueba2</h1>
<canvas id="myChart" width="400" height="400"></canvas>
<script>
    var temperaturas = [];
    var fechas = [];
    var request = new XMLHttpRequest();
    request.open('GET', 'prueba.php', false);  // `false` makes the request synchronous
    request.send(null);

    if (request.status === 200) {
    console.log(request.responseText);
    myParseo(JSON.parse(request.responseText));
    }

    function myParseo(json) {
       for (let i = 0; i< json.length; i++) {
                // console.log(json[i][2]);
                temperaturas.push(json[i][0]);
                var fechasAcortadas = json[i][2].slice(11,16);
                fechas.push(fechasAcortadas);
            }
    }

    

    var jose = ["1","2"]
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
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