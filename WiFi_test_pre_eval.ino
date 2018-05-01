#include "SoftwareSerial.h"
#include<Wire.h>
const int MPU_addr=0x68;
int16_t axis_X,axis_Y,axis_Z;
int minVal=265;
int maxVal=402;


//String apiKey="6ZW1NZ1A9WSN4RFT";

String ssid ="narain_mukul";
String password="mu11u12@s55m1@1889";
SoftwareSerial esp(7, 8);// RX, TX
String data;
String server = "192.168.43.188"; // www.example.com
String uri = "update.php";// our example is /esppost.php



String finger1,finger2,finger3,finger4,finger5;
float fint1,fint2,fint3,fint4,fint5;
float x_degree,y_degree,z_degree,handbool;
float compflex=300;

void setup() 
{

  Wire.begin();
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x6B);
  Wire.write(0);
  Wire.endTransmission(true);
  
  esp.begin(115200);
  
  Serial.begin(9600);
  
  //server=getString();
  check();
  //reset();
  //delay(3000);
  connectWifi();

  pinMode(13,INPUT);
  pinMode(3,INPUT);
}

void loop () 
{
  // convert the bit data to string form
  handbool=digitalRead(13);
  fint1 = analogRead(A0);
  fint2 = analogRead(A1);
  fint3 = analogRead(A2);
  fint4 = analogRead(A3);
  fint5 = analogRead(3);
  //Gyroscope Read here
  Wire.beginTransmission(MPU_addr);
  Wire.write(0x3B);
  Wire.endTransmission(false);
  Wire.requestFrom(MPU_addr,14,true);
  axis_X=Wire.read()<<8|Wire.read();
  axis_Y=Wire.read()<<8|Wire.read();
  axis_Z=Wire.read()<<8|Wire.read();
  int xAng = map(axis_X,minVal,maxVal,-90,90);
  int yAng = map(axis_Y,minVal,maxVal,-90,90);
  int zAng = map(axis_Z,minVal,maxVal,-90,90);
  x_degree= RAD_TO_DEG * (atan2(-yAng, -zAng)+PI);
  y_degree= RAD_TO_DEG * (atan2(-xAng, -zAng)+PI);
  z_degree= RAD_TO_DEG * (atan2(-yAng, -xAng)+PI);


  httppost();
  
  delay(1000);

}

String getString()
{
  while(!Serial.available())
    delay(10);
}

void check() 
{

  esp.println("AT\r");
  
  delay(500);
  
  if(esp.find("OK") ) Serial.println("Ok");
  else Serial.println("Not Ok");
}

//reset the esp8266 module

void reset() 
{

  esp.println("AT+RST\r");
  
  delay(1000);
  
  if(esp.find("OK") ) Serial.println("Module Reset");
  else 
  {
     Serial.println("Error resetting module");
     reset();
     
  }
  check();

}

//connect to your wifi network
void checkConnect()
{
  esp.println("AT+CWJAP?\r\n");
  delay(500);
  while (esp.available()) 
  {
    String tmpResp = esp.readString();
    Serial.println(tmpResp);
  }
  
}
void connectWifi() 
{
  //checkConnect();
  String cmd = "AT+CWJAP=\"" +ssid+"\",\"" + password + "\"\r\n";

  esp.println(cmd);
  
  delay(20000);
  
  if(esp.find("OK")) 
  {
  
    Serial.println("Connected!");
  while (esp.available()) 
  {
    String tmpResp = esp.readString();
    Serial.println(tmpResp);
  }
  
  }
  else
  {
    Serial.println("Cannot connect to wifi"); 
  while (esp.available()) 
  {
    String tmpResp = esp.readString();
    Serial.println(tmpResp);
  }
    //connectWifi();
  
  }

}


void httppost () {

  esp.println("AT+CIPSTART=\"TCP\",\"" + server + "\",80");//start a TCP connection.
  
  if( esp.find("OK")) 
  {
  
    Serial.println("TCP connection ready");
  
  }
  delay(1000);
  char buf[32];
  String hand=hand?"1":"0";
  finger1=((fint4>compflex)?"1":"0");
  finger2=((fint4>compflex)?"1":"0");
  finger3=((fint4>compflex)?"1":"0");
  finger4=((fint4>compflex)?"1":"0");
  finger5=((fint4>compflex)?"1":"0");
  finger2=finger3=finger4=finger5="0";
  String postRequest ="GET /update.php?hand="+hand+"&finger1="+finger1+"&finger2="+finger2+"&finger3="+finger3+"&finger4="+finger4+"&finger5="+finger5;
  postRequest+="&x_degree=";
  postRequest+=y_degree;
  postRequest+="y_degree=";
  postRequest+=x_degree;
  postRequest+="&z_degree=";
  postRequest+=z_degree;
  postRequest+="\r\n";
  
  String sendCmd = "AT+CIPSEND=";//determine the number of characters to be sent.
  
  esp.print(sendCmd);
  
  esp.println(postRequest.length() );
  Serial.println(postRequest);
  delay(1500);
  
  if(esp.find(">")) 
  {
    Serial.println("Sending..");
    esp.print(postRequest);
    delay(500);
    if( esp.find("SEND OK"))
    {
      Serial.println("Packet sent");
      while (esp.available()) 
      {
        String tmpResp = esp.readString();
        Serial.println(tmpResp);
      }
      // close the connection
      esp.println("AT+CIPCLOSE");
  
    }
  }
  else
  {
//    Serial.println("Sending Init failed");
  }
}
