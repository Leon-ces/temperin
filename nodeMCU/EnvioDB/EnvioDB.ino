#include <WiFiManager.h> // https://github.com/tzapu/WiFiManager
#include <ESP8266WiFi.h>
#include <strings_en.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include "DHTesp.h"

#ifdef ESP32
#pragma message(THIS EXAMPLE IS FOR ESP8266 ONLY!)
#error Select ESP8266 board.
#endif


//Para armar el URL verificar el IP del servidor web local con el comando IPCONFIG
String url="http://192.168.10.176/Paginas/temperin/php/recibir.php"; //Indicamos el archivo .php al que vamos a enviar los datos

//DATOS A ENVIAR
String device="node1";//Nombre de la placa
int temp; //Variable a enviar
int humedad;//Variable a enviar

#ifndef STASSID
#define STASSID "WiFi Libre"
#define STAPSK  ""
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

DHTesp dht;

void setup() {
    Serial.begin(115200);

    dht.setup(D1, DHTesp::DHT11);
    
    WiFi.mode(WIFI_STA); // explicitly set mode, esp defaults to STA+AP
    WiFi.begin(ssid, password);

    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);
    
    
    
    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());


    
    // WiFi.mode(WiFi_STA); // it is a good practice to make sure your code sets wifi mode how you want it.

    //WiFiManager, Local intialization. Once its business is done, there is no need to keep it around
    //WiFiManager wm;

    //reset settings - wipe credentials for testing
    //wm.resetSettings();

    // Automatically connect using saved credentials,
    // if connection fails, it starts an access point with the specified name ( "AutoConnectAP"),
    // if empty will auto generate SSID, if password is blank it will be anonymous AP (wm.autoConnect())
    // then goes into a blocking loop awaiting configuration and will return success result

    bool res;
    // res = wm.autoConnect(); // auto generated AP name from chipid
    // res = wm.autoConnect("AutoConnectAP"); // anonymous ap
    //res = wm.autoConnect("AutoConnectAP","password"); // password protected ap

    if(!res) {
        Serial.println("Failed to connect");
        // ESP.restart();
    } 
    else {
        //if you get here you have connected to the WiFi    
        Serial.println("connected...yeey :)");
    }

     //YA ESTA CONECTADA LA PLACA

    

}


void loop() {
    
    //Actualizo las variables a enviar
    float temp = dht.getTemperature();
    float humedad = dht.getHumidity();

    Serial.println(temp);

    //Preparo el String para enviar por metodo GET, notar que inicia con un ?
    String getData="?temperatura="+String(temp)+"&humedad="+String(humedad);

    
    WiFiClient client;
    HTTPClient http; //Creamos el objeto del tipo HTTPClient
    http.begin(client,url+getData); //Inicializamos el objeto con la URL+getData
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");//Cabecera del protocolo
       
    int httpCode=http.GET(); //Se envia por método GET y se guarda la respuesta 200=OK -1=ERROR
    String respuesta=http.getString();//Respuesta del Servidor

    //Se imprimen las respuestas
    Serial.println(httpCode);
    Serial.println(respuesta);

    //Se termina la comunicación
    http.end();

    delay(10000);
}
