
#include <ESP8266WiFi.h>


const char *ssid = "vodafone5378";
const char *password = "DZ4ETZ32NXUZM3";
//direccion del localhost del mac 
const char* host = "192.168.0.15";

int t = 1000;


void setup()
{
    Serial.begin(9600);
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
    String url = "/TemperaturaArduino/pruebas.php";
    url += "?temperatura=";
    url += medir();
    

    Serial.println(url);

    // Esto es lo que se enviará al servidor.
    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
                 
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 5000) {
            Serial.println(">>> Rebasado 5 segundos.");
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
    delay(3000);
}

float medir(){
  const int sensorPin= A0;
  int value = analogRead(sensorPin);
  //int value = 10;
  float data = (5.0*value*100.0)/1023.0;
  //Serial.print(data);
  return data;
  //Serial.println(" C");
  //delay(1000);
 } 
