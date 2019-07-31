// JavaScript Document


var canvas = document.getElementById("canvas");				//carichiamo il canvas
var ctx = canvas.getContext("2d");							// ecarichiamo il suo contesto
	
var Img = {};												//definizione dell'array di immagini
	Img.player = new Image ();								//caricamento dell'immagine in memoria
	Img.player.src = "../img/characters/MainCharacter.png"; 			//definizione della sorgente da cui attingere il file (bisogna attribuire l'indirizzo in base a level_x.html)
	Img.textbox = new Image ();
	Img.textbox.src = "../img/textbox.png";
	Img.map = new Image ();
	Img.map.src = "../img/level_01/map.png";
	Img.map_layer_1 = new Image ();
	Img.map_layer_1.src = "../img/level_01/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_01/map_layer_2.png";
	Img.bed = new Image ();
	Img.bed.src = "../img/level_01/bed.png";
	Img.chair_front = new Image ();
	Img.chair_front.src = "../img/level_01/chair_front.png";
	Img.chair_retro = new Image ();
	Img.chair_retro.src = "../img/level_01/chair_retro.png";
	Img.kitchen_table = new Image ();
	Img.kitchen_table.src = "../img/level_01/kitchen_table.png";
	Img.fridge = new Image ();
	Img.fridge.src = "../img/level_01/fridge.png";
	Img.hob = new Image ();
	Img.hob.src = "../img/level_01/hob.png";
	Img.sideboard = new Image ();
	Img.sideboard.src = "../img/level_01/sideboard.png";
	Img.tv = new Image ();
	Img.tv.src = "../img/level_01/tv.png";
	Img.toilette = new Image ();
	Img.toilette.src = "../img/level_01/toilette.png";

var ObjectList = {};
	addObject ("chair_front1", Img.chair_front, 600, 60, 620, 81, "Una sedia di legno, di bassa qualità");//		30
	addObject ("table_kitchen", Img.kitchen_table, 585, 85, 650, 130, "Un tavolo da cucina. Una bottiglia di birra è appoggiata di lato, tutto il contenuto è versato.");
	addObject ("chair_retro1", Img.chair_retro, 600, 110, 620, 131, "Una sedia di legno, di bassa qualità");//275 295
	addObject ("bed", Img.bed, 80, 42, 116, 72, "Un letto. Hai davvero dei gusti orribili per la scelta dei mobili");
	addObject ("fridge", Img.fridge, 530, 35, 560, 90, "Un frigorifero antiquato. Credo che funzioni a malapena.");
	addObject ("hob", Img.hob, 380, 40, 450, 90, "Un piano cottura molto sporco. Chissà da quanto tempo è lì quella padella.");
	addObject ("sideboard", Img.sideboard, 600, 200, 670, 240, "Un bel mobile di legno. Non credo lo abbia scelto tu.");
	addObject ("tv", Img.tv, 680, 40, 700, 65, "Un televisore a tubo catodico. Non pensi sia ora di evolversi?");
	addObject ("toilette", Img.toilette, 290, 35, 340, 55, "Una toilette. Sporca. Dovrei per forza fare i miei bisogni qui?");

var LayerList = {};
	addLevel (1, Img.map_layer_1, 20, 22);
	addLevel (2, Img.map_layer_2, 20, 22);
		
var EntityList = {};
	addEntity ("Player", Img.player, 100, 100, 5, 5, 26, 50);
		
var WallList = {};
	addWall (1, 240, 20, 260, 350);
	addWall (2, 20, 205, 168, 220);
	addWall (3, 210, 205, 245, 220);
	addWall (4, 20, 235, 145, 400);
	addWall (5, 370, 20, 380, 295);
	addWall (6, 380, 285, 450, 300);
	addWall (7, 500, 285, 760, 300);
	addWall (8, 625, 285, 760, 400);


	
//variabili per i dialoghi e le azioni
var page = 0;			//numero di pagina del dialogo
var flag = false;		//set di inizio dialogo
var endMission = 0;		//set della fine della missione
var descrObject = "Niente di particolare da notare";	//variabile della descrizione da mostrare in seguito ad un approccio con un oggetto

//funzione per l'aggiornamento del livello
function update ()
{
	"use strict";
	drawMap ();		//disegna la mappa
	
	movementPlayer ();					//movimento del giocatore
	
	drawMapLevel (MapLevelList[2]);				//definizione del secondo layer	(si definisce qui per le proiezioni del layer sulle entità)
	
	for (var en in EntityList)			//cicli di controllo delle collisioni
	{
		
		borderCollision (EntityList[en]);			//collisioni delle entità con i bordi
		
		for (var ob in ObjectList)
		{
			if (objectCollision (EntityList[en], ObjectList[ob]))			//collisioni delle entità con gli oggetti
			{	
				descrObject = ObjectList[ob].descr;
			}
			
		}
		for (var ent in EntityList)
		{
			if (en != ent)
			{	entityCollision (EntityList[en], EntityList[ent]);	}
		}
		for (var wa in WallList)
		{
			wallCollision (EntityList[en], WallList[wa]);
		}
		
	}	
	
	drawDescr (descrObject);	
	
	helpLevel (1, "            HELP           FRECCE DIREZIONALI: movimento SHIFT: missione in corso      Q: azione                    H: help                      E: esci dal livello");
	
	if (!endMission)
	{	statusLevel (1, "MISSIONE          Rispondi alla chiamata sul cellulare                                    TIP: Premi il tasto Q");	}
	else
	{	statusLevel (1, "LIVELLO COMPLETATO.       Premi E per andare al prossimo livello oppure esplora ancora la mappa")}
	
	mission ();
	autoplay ();
	
}

//funzione per il disegno della mappa del livello
function drawMap ()
{
	"use strict";
	ctx.drawImage (Img.map,						//disegno della mappa
				   0, 0, MAP_WIDTH, MAP_HEIGHT,				//acquisendola per blocchi, prendendo il blocco alla posizione 0x0 di dimensioni MAP_WIDTH x MAP_HEIGHT
				   0, 0, MAP_WIDTH, MAP_HEIGHT);				//disegnandola alla posizione 0x0 di grandezza MAP_WIDTH x MAP_HEIGHT
			
	
	drawMapLevel (MapLevelList[1]);				//definizione del primo layer
	
	for (var j in ObjectList)
	{
		drawObject (ObjectList[j]);
	}	
	
	for (var k in EntityList)
	{
		drawEntity (EntityList[k]);
	}
}

//funzione per l'autoplay della musica
function autoplay ()
{
    var audio=document.getElementById("audiolevel");
    audio.volume = 0.2;
    
    audio.play ();
}

//funzione della missione del livello
function mission()
{
	if (key.action)
	{	
		window.clearInterval();
		page ++;
		if (!flag)
		{	flag = true;	}
	}
	if (flag)
	{	
		endMission = missionDialog (page);	
	}
	if (endMission)
	{
		escapeLevel (1, "level_02.html");
	}
	
}

//funzione per i dialoghi della missione
function missionDialog (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("DRIIIIIIIIIN!           DRIIIIIIIIIIIN!!         DRIIIIIIIIIIIIIN!!!");	
	}
	else if (page === 3 || page === 4)
	{	
		actionLevel ("TU                      Chi sarà a quest'ora??");	
	
	}
	else if (page === 5 || page === 6)
	{	
		actionLevel ("RISPONDI AL TELEFONO.");	
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("GORDON                  Buonasera detective, sono il Commissario Gordon. Ho un incarico importante per lei.");	
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("TU                      Salve, commissario. Mi dica pure.");	
	}
	else if (page === 11 || page === 12)
	{	
        actionLevel ("GORDON                  C'è stato un omicidio, nella vecchia fabbrica al porto.");	
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("GORDON                  Vada sul posto e cerchi di acquisire quante più informazioni possibili.");	
	}
	
	else if (page === 15 || page === 16)
	{	
		actionLevel ("GORDON                  Non abbiamo informazioni utili al momento, ma troverà un nostro agente sul posto che le darà una mano.");
	}
	else if (page === 17 || page === 18)
	{	
		actionLevel ("TU                      Va bene, commissario. Mi dirigerò il prima possibile.");
	}
	else if (page === 19 || page === 20)
	{	
		actionLevel ("GORDON                  Perfetto. Le auguro buona fortuna.");	
	}
    else if (page === 21 || page === 22)
	{
		actionLevel ("CLICK.");
	}
	else if (page === 23 || page === 24)
	{
		actionLevel ("LIVELLO COMPLETATO.     Premi E per andare al prossimo livello oppure esplora ancora la mappa.");
	}
	
	if (page >= 23 )
	{
		return 1;
	}
}
