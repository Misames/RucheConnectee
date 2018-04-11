/********************************************************
Toutes les 3 secondes, l'Arduino envoie un message qui 
sera éventuellement reçu par un Raspberry pi.
********************************************************/

int compteur = 0;

void setup(){
  Serial.begin(9600);
}

 
void loop(){
  Serial.print("Message numero ");
  Serial.println(compteur);
  Serial.println("Bonjour, la Framboise, ici l'Arduino!");
  compteur++;
  delay(3000);
}