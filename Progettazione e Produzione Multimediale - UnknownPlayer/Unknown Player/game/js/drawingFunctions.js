// JavaScript Document

var MAP_WIDTH = 800;
var MAP_HEIGHT = 450;

var SPRITE_DIV_HEIGHT = 4;
var SPRITE_DIV_WIDTH = 3;

var canvas = document.getElementById("canvas");				//carichiamo il canvas
var ctx = canvas.getContext("2d");							// ecarichiamo il suo contesto

var Img = {};			//lista di immagini

var ObjectList = {};	//lista di oggetti

var MapLevelList = {};	//lista di layer della mappa

var EntityList = {};	//lista delle entità

//funzione per l'aggiunta dei layer della mappa
function addLevel (id, src, x, y)
{
	"use strict";
	var Level =
	{
		id: id,
		src: src,
		x: x,
		y: y,
	};
	
	MapLevelList[id] = Level;
}

//funzione per il disegno dei layer della mappa
function drawMapLevel (Level)
{
	"use strict";
	ctx.drawImage (Level.src, Level.x, Level.y);
}
		
//funzione per il disegno degli oggetti
function drawObject (Object)
{
	"use strict";
	ctx.drawImage (Object.src, Object.x, Object.y);
}

//funzione per il disegno delle entità
function drawEntity (Entity)
{
	"use strict";
	var frameHeight = Entity.src.height / SPRITE_DIV_HEIGHT;			//grandezze fisse che le entita devono avere, ovvero il numero di immagini negli sprite
	var frameWidth = Entity.src.width / SPRITE_DIV_WIDTH;
	
	var value = drawSprite (Entity);			//acquisizione del valore dello sprite da mostrare relativo alla direzione del movimento
	
	ctx.drawImage (Entity.src, 
				   Entity.moveX*frameWidth, value*frameHeight, frameWidth, frameHeight,			//acquisisce il frame alla posizione (moveX, value)
				   Entity.x, Entity.y, Entity.dimX, Entity.dimY);				//disegna alla posizione (x, y) di dimensioni dimX x dimY
}

//funzione per l'acquisizione dell'indice dello sprite
function drawSprite (Entity)
{
	"use strict";
	var value = -1;
	if (!Entity.isMoving)
	{	value = 0;	}
	else
	{
		switch (Entity.movement)
		{
			case "no":
			case "nw":
			case "ne":
			{	value = 3;	break;	}
			case "so":
			case "sw":
			case "se":
			{	value = 0;	break;	}
			case "ea":
			{	value = 1;	break;	}
			case "we":
			{	value = 2;	break;	}
		}
	}
	return value;
}

//funzione per la scrittura del messaggio all'interno del textbox creato appositamente
function drawMessage (text)
{
	"use strict";
	
	var X_TEXTBOX = 250;
	var Y_TEXTBOX = 320;

	ctx.drawImage (Img.textbox, X_TEXTBOX, Y_TEXTBOX);
	
	ctx.font = '15px "Pixel"';
	writeMessage (text, X_TEXTBOX + 20, Y_TEXTBOX + 20, 230, 15);
}

//funzione per la scrittura dello status all'interno del textbox
function drawStatus (text)
{
	"use strict";
	
	var X_TEXTBOX = 200;
	var Y_TEXTBOX = 200;

	ctx.save ();
	ctx.fillStyle = "blue";
	ctx.drawImage (Img.textbox, X_TEXTBOX, Y_TEXTBOX);

	ctx.font = '15px "Pixel"';
	writeMessage (text, X_TEXTBOX + 20, Y_TEXTBOX + 20, 230, 15);
	ctx.restore ();
}

//funzione per la scrittura degli aiuti all'interno del textbox
function drawHelp (text)
{
	"use strict";
	
	var X_TEXTBOX = 200;
	var Y_TEXTBOX = 200;

	ctx.save ();
	ctx.fillStyle = "green";
	ctx.drawImage (Img.textbox, X_TEXTBOX, Y_TEXTBOX);

	ctx.font = '15px "Pixel"';
	writeMessage (text, X_TEXTBOX + 10, Y_TEXTBOX + 20, 270, 15);
	ctx.restore ();
}

//funzione per la stampa della descrizione dell'oggetto
function drawDescr (descrObject)
{
	"use strict";
	
	if (key.action)
	{	drawMessage (descrObject);	}
}

//funzione per la scrittura del messaggio tramite l'uso del wrapping, ovvero del controllo delle parole per l'uso
//del carattere speciale newline. Fonte: www.html5canvastutorials.com
function writeMessage (text, x, y, maxWidth, lineHeight) 
{
 	var message = text.split(' ');
    var line = '';
	
	for(var i = 0; i < message.length; i ++) 
	{
		var testLine = line + message[i] + ' ';
		var metrics = ctx.measureText(testLine);
		var testWidth = metrics.width;
		
		if (testWidth > maxWidth && i > 0) 
		{
			ctx.fillText(line, x, y);
            line = message[i] + ' ';
            y += lineHeight;
        }
        else 
		{	line = testLine;	}
	}
    
	ctx.fillText(line, x, y);
}

//funzione per la stampa del contatore
function drawCounter (MAX_TIME)
{
    "use strict";
    ctxTim.clearRect(0,0,800, 20);
    ctxTim.font = "15px Pixel";
    ctxTim.fillStyle = "white";
    ctxTim.fillText(" TEMPO TRASCORSO: " + (chrono/25).toFixed(2) + "/ " + (MAX_TIME/25).toFixed(2), 15, 15);
}

