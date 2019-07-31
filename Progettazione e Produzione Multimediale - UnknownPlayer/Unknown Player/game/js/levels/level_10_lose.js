// JavaScript Document


var canvas = document.getElementById("canvas");				//carichiamo il canvas
var ctx = canvas.getContext("2d");							// ecarichiamo il suo contesto
	
var timer = document.getElementById("timer");				//carichiamo il canvas
var ctxTim = timer.getContext("2d");

var Img = {};												//definizione dell'array di immagini
	Img.player = new Image ();								//caricamento dell'immagine in memoria
	Img.player.src = "../img/characters/MainCharacter.png"; 			//definizione della sorgente da cui attingere il file (bisogna attribuire l'indirizzo in base a level_x.html)
	Img.textbox = new Image ();
	Img.textbox.src = "../img/textbox.png";
	Img.map_layer_1 = new Image ();
	Img.map_layer_1.src = "../img/level_10/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_10/map_layer_2.png";
	Img.wilson = new Image ();
	Img.wilson.src = "../img/characters/wilson.png";
    Img.policeman_1 = new Image ();
    Img.policeman_1.src = "../img/characters/policeman_3.png";
    Img.plant = new Image ();
    Img.plant.src = "../img/level_10/plant.png";
    Img.table = new Image ();
    Img.table.src = "../img/level_10/table.png";

var ObjectList = {};
    addObject ("Plant", Img.plant, 330, 270, 370, 285, " ");
    addObject ("Table 1", Img.table, 30, 270, 90, 295, " ");
    addObject ("Table 2", Img.table, 300, 370, 360, 395, " ");

var LayerList = {};
	addLevel (1, Img.map_layer_1, 0, 0);
	addLevel (2, Img.map_layer_2, 0, 0);
		
var EntityList = {};
	addEntity ("Player", Img.player, 30, 150, 5, 5, 26, 50);
	addEntity ("Wilson_Policeman", Img.wilson, 50, 350, 5, 5, 26, 50);
    addEntity ("Policeman_Exit", Img.policeman_1, 300, 150, 5, 5, 26, 50);
	
		
var WallList = {};
	addWall (1, 20, 230, 200, 245);
	addWall (2, 285, 230, 380, 245);
	addWall (3, 380, 230, 450, 430);
	addWall (4, 20, 20, 800, 100);
	addWall (5, 650, 20, 800, 430);


	
//variabili per i dialoghi e le azioni
var page = 0;			//numero di pagina del dialogo
var flag = false;		//set di inizio dialogo
var endMission = 0;		//set della fine della missione
var descrObject = "Niente di particolare da notare";	//variabile della descrizione da mostrare in seguito ad un approccio con un oggetto
var id_mission = 1;				//id della missione in corso
var chrono = 0;
var MAX_TIME = 200000;
var indizi = 0;
var chooiceMurder = -1;

//funzione per l'aggiornamento del livello
function update ()
{
	"use strict";
	drawMap ();		//disegna la mappa
	chrono ++;
    
	movementPlayer ();					//movimento del giocatore
	
	drawMapLevel (MapLevelList[2]);				//definizione del secondo layer	(si definisce qui per le proiezioni del layer sulle entità)
	
	for (var en in EntityList)			//cicli di controllo delle collisioni
	{
		borderCollision (EntityList[en]);			//collisioni delle entità con i bordi
		
		for (var ob in ObjectList)
		{
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Table 1")			//collisioni delle entità con gli oggetti
            {	id_mission = 2; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Table 2")			//collisioni delle entità con gli oggetti
            {	id_mission = 3; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Plant")			//collisioni delle entità con gli oggetti
            {	id_mission = 4; page = 1;	}
			
			
		}
		for (var ent in EntityList)
		{
			if (en != ent)
			{	
				if (entityCollision (EntityList[en], EntityList[ent]) == "Wilson_Policeman")
				{	id_mission = 5;	page = 1;	}
                if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_Exit")
				{	id_mission = 6;	page = 1;	}
			}
		}
		for (var wa in WallList)
		{
			wallCollision (EntityList[en], WallList[wa]);
		}
	}	
	
	drawDescr (descrObject);	
	
	helpLevel (1, "            HELP           FRECCE DIREZIONALI: movimento SHIFT: missione in corso      Q: azione                    H: help                      E: esci dal livello");
	
	if (id_mission != -1)
	{	statusLevel (1, "MISSIONE          Interagisci con l'agente Wilson per conoscere se hai catturato il colpevole oppure no.");	}
	else
	{	statusLevel (1, "LIVELLO COMPLETATO.       Premi E per andare al prossimo livello oppure esplora ancora la mappa")}
	
	mission ();
    autoplay ();
	
    if(chrono > MAX_TIME)
    {
        window.location.replace("../level/game_lose.html");
        clearTimeout(ch);
    }
}

//funzione per il disegno della mappa del livello
function drawMap ()
{
	"use strict";	
	
	drawMapLevel (MapLevelList[1]);				//definizione del primo layer
	/**/
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

//funzione per la definizione delle missioni
function mission ()
{
	"use strict";
	
	if (key.action)
	{	
		window.clearInterval();
		page ++;
		
		
		if (!flag)
		{	flag = true;	}
	}
	if (flag)
	{
		if (id_mission == 1)
		{	mission_01 (page);	}	
		if (id_mission == 2)
		{	mission_table_1 (page);	}
		if (id_mission == 3)
		{	mission_table_2 (page);	}
		if (id_mission == 4)
		{	mission_plant (page);	}
		if (id_mission == 5)
		{	mission_wilson (page);	}
		if (id_mission == 6)
		{	mission_policeman_exit (page);	}
	} 
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Sei arrivato al famoso Bar Boe, il tuo pub preferito.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("L'agente Wilson è venuto qui con te. Sarà sicuramente dentro al locale.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("Probabilmente sa qualcosa di più sull'eventuale cattura del sospettato.");
	}
}

//missione che si attiva interagendo con l'agente Wilson
function mission_wilson (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("WILSON                   ... certo. Grazie, commissario, a domani.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("WILSON                   Detective, ha chiamato il commissario Gordon. Il colpevole che ha scelto è stato arrestato.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("WILSON                   Abbiamo consegnato alla giustizia l'omicida. Facciamoci una bevuta!");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("TU                       Certo, è proprio quello che ci vuole.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("WILSON                   Ottimo. Boe, dacci due birre.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("DRIIIIIIIIIN!           DRIIIIIIIIIIIN!!         DRIIIIIIIIIIIIIN!!!");	
	}
    else if (page === 13 || page === 14)
    {
        actionLevel ("WILSON                   Penso sia il tuo telefono.");
    }
    else if (page === 15 || page === 16)
    {
        actionLevel ("RISPONDI AL TELEFONO");
    }
    else if (page === 17 || page === 18)
    {
        actionLevel ("SCONOSCIUTO              Detective, ho delle notizie da darle.");
    }
    else if (page === 19 || page === 20)
    {
        actionLevel ("TU                       Chi parla?");
    }
    else if (page === 21 || page === 22)
    {
        actionLevel ("SCONOSCIUTO              Non è questo ciò che conta.");
    }
    else if (page === 23 || page === 24)
    {
        actionLevel ("SCONOSCIUTO              Ha sbagliato la sua scelta.");
    }
    else if (page === 25 || page === 26)
    {
        actionLevel ("SCONOSCIUTO              Non è il suo sospettato ad aver ucciso Caine.");
    }
    else if (page === 27 || page === 28)
    {
        actionLevel ("SCONOSCIUTO              Il colpevole è oramai in fuga. Ha preso una nave per Cuba.");
    }
    else if (page === 29 || page === 30)
    {
        actionLevel ("SCONOSCIUTO              E' in acque internazionali. Non può prenderlo più oramai.");
    }
    else if (page === 31 || page === 32)
    {
        actionLevel ("SCONOSCIUTO              La sua missione è fallita.");
    }
    else if (page === 33 || page === 34)
    {
        actionLevel ("CLICK.");
    }
    else if (page === 35 || page === 36)
    {
        actionLevel ("WATSON                   Tutto bene, detective?");
    }
    else if (page === 37 || page === 38)
    {
        actionLevel ("TU                       Abbiamo perso, Watson. Oggi la giustizia ha perso.");
    }
    else if (page === 39)
    {
        window.location.replace("../level/game_lost.html");
        clearTimeout(ch);
    }
}

//funzione che si attiva interagendo con la tua scrivania
function mission_table_1 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Un vecchio tavolo che puzza di birra e marcio.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' libero, nessuno è seduto qui.");
	}
	else if (page === 5 || page === 6)
	{
        actionLevel ("C'è un bigliettino accartocciato, chissa cos'è.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("APRI IL BIGLIETTINO");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("'Tardi è l'ora, andato esso è, scampato alla cella e sfuggito a te.'");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("'Le piccole carte dovevi cercare, un indizio in più ti poteva dare.'");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("'Ma adesso è tardi, niente puoi fare, se non finire e di nuovo provare.'");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("'Firmato il Grande Fratello'");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("Piccole poesie in uno squallido bar. Ne ho viste di peggio.");
	}
}

//funzione che si attiva interagendo con la scrivania
function mission_table_2 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Un vecchio tavolo che puzza di birra e marcio.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("C'è una grossa chiazza, qualcosa si sarà versato qui.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_plant ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA PIANTA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' l'unica cosa viva qui dentro.");
	}
}

//funzione che si attiva interagendo con l'agente
function mission_policeman_exit ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   L'agente Wilson è già all'interno del pub.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("AGENTE                   Ha appena ricevuto una telefonata dal commissario Gordon. Penso si trattasse del caso di Caine.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TU                       Grazie mille.");
	}
}

