var mappa = document.getElementById("mappa");				    //carichiamo il canvas
var ctxMappa = canvas.getContext("2d");							// e carichiamo il suo contesto
	
var dimWidth = window.innerWidth / 100;
var dimHeight = window.innerHeight / 100;
    
ctxMappa.canvas.width = dimWidth * 80;
ctxMappa.canvas.height = dimHeight * 85;




function drawMap ()
{
    dimWidth = window.innerWidth / 100;
    dimHeight = window.innerHeight / 100;
    
    ctxMappa.canvas.width = dimWidth * 80;
    ctxMappa.canvas.height = dimHeight * 85;
    
    drawNodes();
    drawLines();
    drawIndication ();
    drawFill ();
}

//funzione per il disegno dei nodi
function drawNodes ()
{
    ctxMappa.font = "2vw Typewrite";
    ctxMappa.fillStyle = "#0d0d0d";
    
    ctxMappa.fillText ("Homepage", dimWidth*35, dimHeight*10);
    
    ctxMappa.fillText ("Gioca", dimWidth*9, dimHeight*37);
    ctxMappa.fillText ("Trama", dimWidth*19.5, dimHeight*37);
    ctxMappa.fillText ("Personaggi", dimWidth*28.5, dimHeight*37);
    ctxMappa.fillText (" e luoghi", dimWidth*28.5, dimHeight*40);
    ctxMappa.fillText (" Regole", dimWidth*41, dimHeight*37);
    ctxMappa.fillText ("di gioco", dimWidth*41, dimHeight*40);
    ctxMappa.fillText ("Easter", dimWidth*51, dimHeight*37);
    ctxMappa.fillText (" Eggs", dimWidth*51, dimHeight*40);
    ctxMappa.fillText ("Comandi", dimWidth*61, dimHeight*37);
    ctxMappa.fillText ("di gioco", dimWidth*61, dimHeight*40);
    
    ctxMappa.fillText ("Personaggi", dimWidth*20, dimHeight*64);
    ctxMappa.fillText ("Luoghi", dimWidth*40, dimHeight*64);
}

//funzione per il disegno delle linee
function drawLines ()
{
    ctxMappa.beginPath();
    
    //linea da homepage
    ctxMappa.moveTo (dimWidth*38.5, dimHeight*12);
    ctxMappa.lineTo (dimWidth*38.5, dimHeight*23);
    ctxMappa.moveTo (dimWidth*39.5, dimHeight*12);
    ctxMappa.lineTo (dimWidth*39.5, dimHeight*23);
    ctxMappa.moveTo (dimWidth*38.5, dimHeight*12);
    ctxMappa.lineTo (dimWidth*39.5, dimHeight*12);
    
    //linea orizzontale superiore
    ctxMappa.moveTo (dimWidth*38.5, dimHeight*23);
    ctxMappa.lineTo (dimWidth*11, dimHeight*23);
    ctxMappa.moveTo (dimWidth*39.5, dimHeight*23);
    ctxMappa.lineTo (dimWidth*65, dimHeight*23);
    
    //linea per gioca
    ctxMappa.moveTo (dimWidth*11, dimHeight*23);
    ctxMappa.lineTo (dimWidth*11, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*11, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*12, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*12, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*12, dimHeight*25);
    
    //Linea per trama
    ctxMappa.moveTo (dimWidth*12, dimHeight*25);
    ctxMappa.lineTo (dimWidth*21.5, dimHeight*25);
    ctxMappa.moveTo (dimWidth*21.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*21.5, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*22.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*22.5, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*21.5, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*22.5, dimHeight*32.5);
    
    //Linea per personaggi e luoghi
    ctxMappa.moveTo (dimWidth*22.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*33, dimHeight*25);
    ctxMappa.moveTo (dimWidth*33, dimHeight*25);
    ctxMappa.lineTo (dimWidth*33, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*34, dimHeight*25);
    ctxMappa.lineTo (dimWidth*34, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*33, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*34, dimHeight*32.5);
    
    //Linea per regole di gioco
    ctxMappa.moveTo (dimWidth*34, dimHeight*25);
    ctxMappa.lineTo (dimWidth*44, dimHeight*25);
    ctxMappa.moveTo (dimWidth*44, dimHeight*25);
    ctxMappa.lineTo (dimWidth*44, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*45, dimHeight*25);
    ctxMappa.lineTo (dimWidth*45, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*44, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*45, dimHeight*32.5);
    
    //Linea per easter eggs
    ctxMappa.moveTo (dimWidth*45, dimHeight*25);
    ctxMappa.lineTo (dimWidth*53.5, dimHeight*25);
    ctxMappa.moveTo (dimWidth*53.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*53.5, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*54.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*54.5, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*53.5, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*54.5, dimHeight*32.5);
    
    //Linea per comandi gioco
    ctxMappa.moveTo (dimWidth*54.5, dimHeight*25);
    ctxMappa.lineTo (dimWidth*64, dimHeight*25);
    ctxMappa.moveTo (dimWidth*64, dimHeight*25);
    ctxMappa.lineTo (dimWidth*64, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*65, dimHeight*23);
    ctxMappa.lineTo (dimWidth*65, dimHeight*32.5);
    ctxMappa.moveTo (dimWidth*65, dimHeight*32.5);
    ctxMappa.lineTo (dimWidth*64, dimHeight*32.5);
    
    //Linea da personaggi e luoghi
    ctxMappa.moveTo (dimWidth*33, dimHeight*41);
    ctxMappa.lineTo (dimWidth*34, dimHeight*41);
    ctxMappa.moveTo (dimWidth*33, dimHeight*41);
    ctxMappa.lineTo (dimWidth*33, dimHeight*50);
    ctxMappa.moveTo (dimWidth*33, dimHeight*41);
    ctxMappa.lineTo (dimWidth*33, dimHeight*50);
    ctxMappa.moveTo (dimWidth*34, dimHeight*41);
    ctxMappa.lineTo (dimWidth*34, dimHeight*50);
    
    //linea orizzontale inferiore
    ctxMappa.moveTo (dimWidth*33, dimHeight*50);
    ctxMappa.lineTo (dimWidth*23, dimHeight*50);
    ctxMappa.moveTo (dimWidth*34, dimHeight*50);
    ctxMappa.lineTo (dimWidth*43, dimHeight*50);
    
    //Linea per personaggi
    ctxMappa.moveTo (dimWidth*23, dimHeight*59.5);
    ctxMappa.lineTo (dimWidth*24, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*23, dimHeight*50);
    ctxMappa.lineTo (dimWidth*23, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*24, dimHeight*52);
    ctxMappa.lineTo (dimWidth*24, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*23, dimHeight*59.5);
    ctxMappa.lineTo (dimWidth*24, dimHeight*59.5);
    
    //Linea per luoghi
    ctxMappa.moveTo (dimWidth*24, dimHeight*52);
    ctxMappa.lineTo (dimWidth*42, dimHeight*52);
    ctxMappa.moveTo (dimWidth*42, dimHeight*59.5);
    ctxMappa.lineTo (dimWidth*43, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*42, dimHeight*52);
    ctxMappa.lineTo (dimWidth*42, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*43, dimHeight*50);
    ctxMappa.lineTo (dimWidth*43, dimHeight*59.5);
    ctxMappa.moveTo (dimWidth*42, dimHeight*59.5);
    ctxMappa.lineTo (dimWidth*43, dimHeight*59.5);
    
    ctxMappa.stroke ();
}

//funzione per il riempimento delle linee
function drawFill ()
{
    ctxMappa.fillStyle = "gray";
    //verticale da homepage
    ctxMappa.fillRect (dimWidth*38.6,dimHeight*12.1,dimWidth*0.8,dimHeight*11);
    //orizzontale superiore
    ctxMappa.fillRect (dimWidth*11.1,dimHeight*23.1,dimWidth*27.3,dimHeight*1.8);
    ctxMappa.fillRect (dimWidth*36.6,dimHeight*23.1,dimWidth*28.3,dimHeight*1.8);
    
    //verticale rispettivamente gioca, trama, personaggieluoghi, regolegioco, eastereggs, comandigioco, personaggi, luoghi
    ctxMappa.fillRect (dimWidth*11.1, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*21.6, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*33.1, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*44.1, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*53.6, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*64.1, dimHeight*23.1, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*33.1, dimHeight*41.1, dimWidth*0.8, dimHeight*10.3);
    ctxMappa.fillRect (dimWidth*23.1, dimHeight*50.0, dimWidth*0.8, dimHeight*9.3);
    ctxMappa.fillRect (dimWidth*42.1, dimHeight*50.0, dimWidth*0.8, dimHeight*9.3);
    
    //orizzontale inferiore
    ctxMappa.fillRect (dimWidth*23.1,dimHeight*50.0,dimWidth*10.8,dimHeight*1.8);
    ctxMappa.fillRect (dimWidth*33.9, dimHeight*50.0,dimWidth*8.8,dimHeight*1.8);
}

function drawIndication ()
{
    ctxMappa.beginPath();
    
    ctxMappa.font = "1.6vw Typewrite";
    ctxMappa.fillText ("LEGENDA", dimWidth*60, dimHeight*55); 
    
    ctxMappa.font = "1.4vw Typewrite";
    ctxMappa.fillStyle = "#4d94ff";
    ctxMappa.fillText ("Nodo", dimWidth*60, dimHeight*60);
    ctxMappa.fillStyle = "#0d0d0d";
    ctxMappa.fillText ("Posizione Attuale", dimWidth*64, dimHeight*60);
    
    ctxMappa.moveTo (dimWidth*60, dimHeight*64);
    ctxMappa.lineTo (dimWidth*63, dimHeight*64);
    ctxMappa.moveTo (dimWidth*60, dimHeight*65);
    ctxMappa.lineTo (dimWidth*63, dimHeight*65);
    ctxMappa.fillStyle = "gray";
    ctxMappa.fillRect (dimWidth*60.1,dimHeight*64.1,dimWidth*2.8,dimHeight*0.9);
    ctxMappa.fillStyle = "#0d0d0d";
    ctxMappa.fillText ("Percorso Ammesso", dimWidth*64, dimHeight*65);
    
    ctxMappa.moveTo (dimWidth*60, dimHeight*69);
    ctxMappa.lineTo (dimWidth*63, dimHeight*69);
    ctxMappa.moveTo (dimWidth*60, dimHeight*70);
    ctxMappa.lineTo (dimWidth*63, dimHeight*70);
    ctxMappa.fillStyle = "#4d94ff";
    ctxMappa.fillRect (dimWidth*60.1,dimHeight*69.1,dimWidth*2.8,dimHeight*0.9);
    ctxMappa.fillStyle = "#0d0d0d";
    ctxMappa.fillText ("Percorso Compiuto", dimWidth*64, dimHeight*70);
    
    ctxMappa.stroke ();
}