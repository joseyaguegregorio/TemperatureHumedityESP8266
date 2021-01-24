
#include <ESP8266WiFi.h>
#include "DHT.h"
/*
 * IMPORTANTE, sino no carga el codigo en el esp8266
 * * IMPORTANTE, sino no carga el codigo en el esp8266
 * * IMPORTANTE, sino no carga el codigo en el esp8266
 * * IMPORTANTE, sino no carga el codigo en el esp8266
Nota importante: si usas el pin D8 (como lo recomiendo)
  recuerda desconectar el lector del mismo cada vez que reinicies
  o quieras subir el código, pues el mismo "interfiere" con el
  monitor serial
*/

#define PIN_CONEXION 4// A cuál pin está conectado el lector, es el D8 que en int equivale al 15, el D2 equivale al 4
#define TIPO_SENSOR DHT22 // Puede ser DHT11 también
DHT sensor(PIN_CONEXION, TIPO_SENSOR);

const char *ssid = "vodafone5378";
const char *password = "DZ4ETZ32NXUZM3";
//direccion del localhost del mac 
//const char* host = "192.168.0.15";
const char* host = "joseyague.000webhostapp.com";

int t = 1000;


void setup()
{
    Serial.begin(9600);
    sensor.begin();
    delay(10);

  // Conecta a la red wifi.
  Serial.println();
  Serial.print("Conectando con ");
  Serial.println(ssid);
 
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("Conectado con WiFi.");

  // Esta es tu IP
  Serial.print("Esta es tu IP: ");
  Serial.println(WiFi.localIP());
}

void loop()
{
  t += 1;
    Serial.print("Conectando con ");
    Serial.println(host);

    // Clase cliente
    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
        Serial.println("Fallo en la conexión.");
        return;
    }

    // Linea de petición
    //String url = "/TemperatureHumedityESP8266/API/anadirMedicion.php";
    String url = "/anadirMedicion.php";
    url += "?temperatura=";
    url += medirTemperatura();
    url += "&humedad=";
    url += medirHumedad();

    Serial.println(url);

    // Esto es lo que se enviará al servidor.
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
                 
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 10000) {
            Serial.println(">>> Rebasado 10 segundos.");
            client.stop();
            return;
        }
    }

    // Lee todas las líneas que ha enviado el servidor.
  /*  while(client.available()) {
        String lineas = client.readStringUntil('\r');
        Serial.print(lineas);
    }
*/
    Serial.println();
    Serial.println("Conexión cerrada.");
    delay(120000);
}



float medirTemperatura(){
  float temperaturaEnGradosCelsius = 0;
        temperaturaEnGradosCelsius = sensor.readTemperature();
        // En ocasiones puede devolver datos erróneos; por eso lo comprobamos
        if (isnan(temperaturaEnGradosCelsius)) {
          Serial.println("Error leyendo valores");
          return -1;
        }
        else{
          return temperaturaEnGradosCelsius;
        }
}

float medirHumedad(){
      float humedad = 0;
      humedad= sensor.readHumidity();
        // En ocasiones puede devolver datos erróneos; por eso lo comprobamos
        if (isnan(humedad)) {
          //Serial.println("Error leyendo valores");
          return -1;
        }
        else{
          return humedad;
        }
}












 /*
 void lecturaTemperaturaHumedadDHT22Serial(){
    float humedad, temperaturaEnGradosCelsius = 0;
    while (true){
        humedad = sensor.readHumidity();
        temperaturaEnGradosCelsius = sensor.readTemperature();
        // En ocasiones puede devolver datos erróneos; por eso lo comprobamos
        if (isnan(temperaturaEnGradosCelsius) || isnan(humedad)) {
          Serial.println("Error leyendo valores");
        }
        else{
          // En caso de que todo esté correcto, imprimimos los valores
          Serial.print("Humedad: ");
          Serial.print(humedad);
          Serial.print(" %\t");
          Serial.print("Temperatura: ");
          Serial.print(temperaturaEnGradosCelsius);
          Serial.println(" *C");
            
        }
        delay(2000);
    }
}
*/
