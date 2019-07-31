// JavaScript Document


var ObjectList = {};			//lista di oggetti

var WallList = {};				//lista di muri

var DescrList = {};				//lista di oggetti in descrizione

/*funzione per l'aggiunta di nuovi oggetti
  n.b. collPointX e collPointY sono i punti di collisione, si calcolano prendendo la dimensione y dell'immagine
  	   e la si divide per due.
  es.  immagine di dimensione 50x70 -> collPointX = 50 e collPointY = 35  */
function addObject (id, src, x, y, collPointX, collPointY, descr)
{
	"use strict";
	var Object =
	{
		id: id,
		src: src,
		x: x,
		y: y,
		collPointX: collPointX,
		collPointY: collPointY,	
		descr: descr,
	};
	
	ObjectList[id] = Object;
}

//funzione per l'aggiunta di nuovi muri
function addWall (id, startX, startY, stopX, stopY)
{
	"use strict";
	
	var Wall =
	{
		id: id,
		startX: startX,
		startY: startY,
		stopX: stopX,
		stopY: stopY,
	};
	
	WallList[id] = Wall;
}

