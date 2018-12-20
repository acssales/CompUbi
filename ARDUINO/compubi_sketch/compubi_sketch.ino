#include <Javino.h>
Javino j; 
int led_state = 0;
int count = 0;
String temp = "";
String st = "";
String room = "QUARTO";
String result = "";

void setup()
{
  Serial.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT); // initialize digital pin LED_BUILTIN as an output
  digitalWrite(LED_BUILTIN, LOW);

  // if analog input pin 0 is unconnected, random analog
  // noise will cause the call to randomSeed() to generate
  // different seed numbers each time the sketch runs.
  // randomSeed() will then shuffle the random function.
  randomSeed(analogRead(0)); 
}

void loop()
{
  while(count < 10)
  {
    digitalWrite(LED_BUILTIN, LOW);
    temp = temperature(0);
    st = state(0);
    result = room + ';' + temp + ';' + st ;
    j.sendmsg(result);
    delay(1000);
    count++;
  }
  digitalWrite(LED_BUILTIN, HIGH);
  count = int(random(1,3));
  temp = temperature(count);
  st = state(count);
  result = room + ';' + temp + ';' + st ;
  j.sendmsg(result);
  count = 0;
  delay(1000);
}

String temperature(int mode) {
  if(mode == 0)
  {
    return String(random(360,376)); // Normal
  } 
  else if(mode == 1)
  {
    return String(random(300, 360)); // Baixa
  }
  else 
  {
    return String(random(376,451)); // Alta
  }
}

String state(int mode) { // STATUS
  if(mode == 0)
  {
    return "OK"; //Normal
  } 
  else if(mode == 1)
  {
    return "DORMINDO";
  }
  else 
  {
    return "QUEDA";
  }
}

