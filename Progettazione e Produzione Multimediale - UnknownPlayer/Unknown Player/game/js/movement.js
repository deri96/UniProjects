// JavaScript Document

var canvas = document.getElementById("canvas");				//carichiamo il canvas
var ctx = canvas.getContext("2d");	

var DIM_SIDEWALL = 20;

var EntityList = {};

var key =			//classe della keyboard
{
	up : false,
	down : false,
	left : false,
	right : false,
	stop: true,
	escape: false,
	action: false,
	status: false,
	help: false,
};

//funzione per l'evento della pressione dei tasti
document.onkeydown = function (event)
{
	"use strict";
	if(event.keyCode === 37)
	{
		key.left = true;		
		key.stop = false;
	}
	if(event.keyCode === 38)
	{
		key.up = true;
		key.stop = false;
	}
	if(event.keyCode === 39)
	{
		key.right = true;		
		key.stop = false;
	}
	if(event.keyCode === 40)
	{
		key.down = true;		
		key.stop = false;
	}
	if(event.keyCode === 69)
	{
		key.escape = true;
	}
	if(event.keyCode === 81)
	{
		key.action = true;
	}
	if(event.keyCode === 16)
	{
		key.status = true;		
	}
	if(event.keyCode === 72)
	{	
		key.help = true;
	}
    if(event.keyCode === 49 || event.keyCode === 97)
    {
        chooiceMurder = 1;
        id_mission = -1;
    }
    if(event.keyCode === 50 || event.keyCode === 98)
    {
        chooiceMurder = 2;
        id_mission = -1;
    }
    if(event.keyCode === 51 || event.keyCode === 99)
    {
        chooiceMurder = 3;
        id_mission = -1;
    }
    if(event.keyCode === 52 || event.keyCode === 100)
    {
        chooiceMurder = 4;
        id_mission = -1;
    }
    if(event.keyCode === 53 || event.keyCode === 101)
    {
        chooiceMurder = 5;
        id_mission = -1;
    }
};
		
//funzione per l'evento del tasto rilasciato sulla tastiera
document.onkeyup = function (event)
{
	"use strict";
	if(event.keyCode === 37)
	{	key.left = false;	}
	if(event.keyCode === 38)
	{	key.up = false;	}
	if(event.keyCode === 39)
	{	key.right = false;	}
	if(event.keyCode === 40)
	{	key.down = false;	}
	if(event.keyCode === 69)
	{	key.escape = false;	}
	if(event.keyCode === 81)
	{	key.action = false;	}
	if(event.keyCode === 16)
	{	key.status = false;	}
	if(event.keyCode === 72)
	{	key.help = false;	}
			
	key.stop = true;
};

//funzione che setta l'escape dal livello, ovvero un rettangolo che va in modo diagonale da (x,y) a (x+40,y+10)
function simpleMovement (Entity, dir)
{
	"use strict";
	
	switch (dir)
	{
		case "no":
		{	
			if (Entity.isColliding)
			{	
				Entity.x = Entity.prevX;
				Entity.y = Entity.prevY + Entity.spdY;	
				Entity.isColliding = false;
			}
			else
			{	
				Entity.prevY = Entity.y;	
				Entity.prevX = Entity.x;	
				Entity.y -= Entity.spdY;	
			}
			Entity.movement = "no";
			Entity.isMoving = false;
			break;	
		}
		case "so":
		{	
			if (Entity.isColliding)
			{	
				Entity.x = Entity.prevX;
				Entity.y = Entity.prevY - Entity.spdY;	
				Entity.isColliding = false;
			}
			else
			{	
				Entity.prevY = Entity.y;	
				Entity.prevX = Entity.x;	
				Entity.y += Entity.spdY;	
			}
			Entity.movement = "so";
			Entity.isMoving = false;
			break;	
		}
		case "we":
		{	
			if (Entity.isColliding)
			{	
				Entity.x = Entity.prevX + Entity.spdX;
				Entity.y = Entity.prevY;
				Entity.isColliding = false;
			}
			else
			{	
				Entity.prevY = Entity.y;	
				Entity.prevX = Entity.x;	
				Entity.x -= Entity.spdX;	
			}
			Entity.movement = "we";
			Entity.isMoving = false;
			break;	
		}
		case "ea":
		{	
			if (Entity.isColliding)
			{	
				Entity.x = Entity.prevX - Entity.spdX;	
				Entity.y = Entity.prevY;
				Entity.isColliding = false;
			}
			else
			{	
				Entity.prevY = Entity.y;	
				Entity.prevX = Entity.x;	
				Entity.x += Entity.spdX;	
			}
			Entity.movement = "ea";
			Entity.isMoving = false;
			break;
		}
		default:
		{
			Entity.isMoving = true;
			break;
		}
	}
}

//funzione per il controllo delle collisioni. ritorna 0 se non ci sono collisioni, 1 se ce ne sono 
function borderCollision (Entity)
{
	"use strict";
	var flag = 0;	
		
	if (Entity.x <= DIM_SIDEWALL)				//estremo sinistro
	{
		Entity.x += Entity.spdX;
		flag = 1;
	}
	if (Entity.y <= DIM_SIDEWALL)				//estremo superiore
	{
		Entity.y += Entity.spdY;
		flag = 1;
	}
	if (Entity.x >= (MAP_WIDTH - DIM_SIDEWALL - Entity.dimX))			//estremo destro
	{
		Entity.x -= Entity.spdX;
		flag = 1;
	}
	if (Entity.y >= (MAP_HEIGHT - DIM_SIDEWALL - Entity.dimY))			//estremo basso
	{
		Entity.y -= Entity.spdY;
		flag = 1;
	}
	return flag;
}

//funzione per uscire dal livello. Viene effettuato solo alla condizione che flag sia true. Non si può tornare indietro
function escapeLevel (flag, src)
{
	"use strict";
	if (flag && key.escape)
	{
		flag = 0;
		location.href = src;
	}
}

//funzione per l'azione del livello, ovvero l'esecuzione di un dialogo o di una parte testuale
function actionLevel (text)
{
	drawMessage (text);
}

//funzione per la visualizzazione dello stato del livello, ovvero cio che bisogna fare per completarlo
function statusLevel (flag, text)
{
	if (flag && key.status)
	{
		drawStatus (text); 
	}
}

//funzione per la visualizzazione degli aiuti del livello
function helpLevel (flag, text)
{
	if (flag && key.help)
	{
		drawHelp (text); 
	}
}

//funzione per il movimento del giocatore tramite l'uso dei tasti
function movementPlayer ()
{
	"use strict";
			
	if (key.right)
	{
		simpleMovement (EntityList["Player"], "ea");
				
		EntityList["Player"].isMoving = true;
				
		if (EntityList["Player"].moveX < 2)
		{	EntityList["Player"].moveX ++;	}
		else
		{	EntityList["Player"].moveX = 0;	}
	}
			
	if (key.left)
	{
		simpleMovement (EntityList["Player"], "we");
				
		EntityList["Player"].isMoving = true;
				
		if (EntityList["Player"].moveX < 2)
		{	EntityList["Player"].moveX ++;	}
		else
		{	EntityList["Player"].moveX = 0;	}
	}
			
	if (key.down)
	{
		simpleMovement (EntityList["Player"], "so");
				
		EntityList["Player"].isMoving = true;
				
		if (EntityList["Player"].moveX < 2)
		{	EntityList["Player"].moveX ++;	}
		else
		{	EntityList["Player"].moveX = 0;	}
	}
				
	if (key.up)
	{
		simpleMovement (EntityList["Player"], "no");
				
		EntityList["Player"].isMoving = true;
				
		if (EntityList["Player"].moveX < 2)
		{	EntityList["Player"].moveX ++;	}
		else
		{	EntityList["Player"].moveX = 0;	}
	}			
}

//funzione per la collisione con gli oggetti della mappa. Ritorna 1 se c'è stata una collisione
function objectCollision (Entity, Object)
{
	"use strict";
	var coord =			//creazione dell'oggetto coordinate
	{
		x: 0,
		y: 0,
	};
			
	//funzione per la valutazione che un punto non sia all'interno di un rettangolo, analizzando i due estremi della sua diagonale B1D1. Restituisce 1 se è contenuto
	function valutingPoint (point)
	{
		if ((point.x >= D1.x && point.x <= B1.x) && (point.y >= B1.y && point.y <= D1.y))
		{	return 1;	}
	}
						
	//definizione dei vertici dei rettangoli dell'entità e dell'oggetto
	var	B1 = {x : (Entity.x + Entity.dimX), y : Entity.y},
		D1 = {x : Entity.x, y : (Entity.y + Entity.dimY)},			//vertici del rettangolo dell'entità
			
		A2 = {x : Object.x, y : Object.y},
		B2 = {x : Object.collPointX, y : Object.y},
		C2 = {x : Object.collPointX, y : Object.collPointY},
		D2 = {x : Object.x, y : Object.collPointY};							//vertici del rettangolo dell'oggetto
			
	//se uno dei vertici del rettangolo dell'oggetto è incluso nel rettangolo della diagonale B1D1 valuta cosa farà
	if (valutingPoint(A2) || valutingPoint(B2) || valutingPoint (C2) || valutingPoint (D2))
	{
		Entity.isColliding = true;
		return Object.id;
	}			
}

//funzione per la collisione tra le entità della mappa. Ritorna 1 se c'è stata una collisione
function entityCollision (Entity1, Entity2)
{
	"use strict";
	var coord =			//creazione dell'oggetto coordinate
	{
		x: 0,
		y: 0,
	};
			
	//funzione per la valutazione che un punto non sia all'interno di un rettangolo, analizzando i due estremi della sua diagonale B1D1. Restituisce 1 se è contenuto
	function valutingPoint (point)
	{
		if ((point.x >= D1.x && point.x <= B1.x) && (point.y >= B1.y && point.y <= D1.y))
		{	return 1;	}
	}
						
	//definizione dei vertici dei rettangoli delle due entità
	var	B1 = {x : (Entity1.x + Entity1.dimX), y : Entity1.y},
		D1 = {x : Entity1.x, y : (Entity1.y + Entity1.dimY)},			//vertici del rettangolo dell'entità
			
		A2 = {x : Entity2.x, y : Entity2.y},
		B2 = {x : (Entity2.x + Entity2.dimX), y : Entity2.y},
		C2 = {x : (Entity2.x + Entity2.dimX), y : (Entity2.y + Entity2.dimY)},
		D2 = {x : Entity2.x, y : (Entity2.y + Entity2.dimY)};							//vertici del rettangolo dell'entità2
			
	//se uno dei vertici del rettangolo dell'entità2 è incluso nel rettangolo della diagonale B1D1 valuta cosa farà
	if (valutingPoint(A2) || valutingPoint(B2) || valutingPoint (C2) || valutingPoint (D2))
	{
		Entity1.isColliding = true;
		Entity2.isColliding = true;
		return Entity2.id;
	}			
}

//funzione per la collisione tra le entità e i muri 
function wallCollision (Entity, Wall)
{
	"use strict";
	var coord =			//creazione dell'oggetto coordinate
	{
		x: 0,
		y: 0,
	};
			
	//funzione per la valutazione che un punto non sia all'interno di un rettangolo, analizzando i due estremi della sua diagonale B1D1. Restituisce 1 se è contenuto
	function valutingPoint (point)
	{
		if ((point.x >= D1.x && point.x <= B1.x) && (point.y >= B1.y && point.y <= D1.y))
		{	return 1;	}
	}
						
	//definizione dei vertici dei rettangoli delle due entità
	var	B1 = {x : Wall.stopX, y : Wall.startY},
		D1 = {x : Wall.startX, y : Wall.stopY},			//vertici del rettangolo dell'entità
			
		A2 = {x : Entity.x, y : Entity.y},
		B2 = {x : (Entity.x + Entity.dimX), y : Entity.y},
		C2 = {x : (Entity.x + Entity.dimX), y : (Entity.y + Entity.dimY)},
		D2 = {x : Entity.x, y : (Entity.y + Entity.dimY)};							//vertici del rettangolo dell'entità2
			
	//se uno dei vertici del rettangolo dell'entità2 è incluso nel rettangolo della diagonale B1D1 valuta cosa farà
	if (valutingPoint(A2) || valutingPoint(B2) || valutingPoint (C2) || valutingPoint (D2))
	{
		Entity.isColliding = true;
		return 1;
	}			
}
  
