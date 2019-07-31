// JavaScript Document

var EntityList = {};

//funzione per l'aggiunta di entità
function addEntity (id, src, x, y, spdX, spdY, dimX, dimY)
{
	"use strict";
	var Entity =
	{
		id: id,
		src: src,
		x: x,
		y: y,
		prevX: x,
		prevY: y,
		spdX: spdX,
		spdY: spdY,
		dimX: dimX,
		dimY: dimY,
		moveX: 0,			//cursori per la parte ineressata all'interno dello sprite
		movement: "st",
		isMoving: false,	//flag per il controllo del movimento: se è false l'entità non si muove, viceversa per true 	
		isColliding: false,
	};
	EntityList[id] = Entity;
}




		