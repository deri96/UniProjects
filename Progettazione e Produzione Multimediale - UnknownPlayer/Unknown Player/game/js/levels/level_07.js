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
	Img.map_layer_1.src = "../img/level_07/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_07/map_layer_2.png";
	Img.wilson = new Image ();
	Img.wilson.src = "../img/characters/wilson.png";
    Img.criminal_1 = new Image ();
	Img.criminal_1.src = "../img/characters/criminal_3.png";
	Img.man_1 = new Image ();
	Img.man_1.src = "../img/characters/man_3.png";
    Img.man_2 = new Image ();
	Img.man_2.src = "../img/characters/man_4.png";
    Img.woman = new Image ();
	Img.woman.src = "../img/characters/woman_3.png";
	Img.policeman_1 = new Image ();
    Img.policeman_1.src = "../img/characters/policeman_1.png";
    Img.policeman_2 = new Image ();
    Img.policeman_2.src = "../img/characters/policeman_2.png";
    Img.policeman_3 = new Image ();
    Img.policeman_3.src = "../img/characters/policeman_3.png";
    Img.desk = new Image ();
    Img.desk.src = "../img/level_07/desk.png";
	Img.water_box = new Image ();
    Img.water_box.src = "../img/level_07/water_box.png";
    Img.box = new Image ();
    Img.box.src = "../img/level_07/box.png";
    Img.board = new Image ();
    Img.board.src = "../img/level_07/board.png";
    Img.plant = new Image ();
    Img.plant.src = "../img/level_07/plant.png";
    Img.valentine = new Image ();
	Img.valentine.src = "../img/characters/valentine_locke.png";

var ObjectList = {};
    addObject ("Desk 1", Img.desk, 480, 40, 540, 80, " ");
    addObject ("Desk 2", Img.desk, 160, 40, 220, 80, " ");
    addObject ("Desk 3", Img.desk, 370, 40, 430, 80, " ");
    addObject ("Water 1", Img.water_box, 480, 120, 510, 140, " ");
    addObject ("Water 2", Img.water_box, 170, 120, 230, 140, " ");
    addObject ("Water 3", Img.water_box, 390, 120, 450, 140, " ");
    addObject ("Water 4", Img.water_box, 750, 320, 810, 340, " ");
    addObject ("Water 5", Img.water_box, 400, 370, 430, 390, " ");
    addObject ("Box 1", Img.box, 670, 30, 730, 50, " ");
    addObject ("Box 2", Img.box, 50, 30, 110, 50, " ");
    addObject ("Box 3", Img.box, 260, 30, 320, 50, " ");
    addObject ("Board", Img.board, 570, 30, 630, 80, " ");
    addObject ("Plant 1", Img.plant, 480, 400, 500, 430, " ");
    addObject ("Plant 2", Img.plant, 170, 400, 190, 430, " ");
    addObject ("Plant 3", Img.plant, 350, 250, 380, 280, " ");
    addObject ("Plant 4", Img.plant, 670, 250, 690, 280, " ");

var LayerList = {};
	addLevel (1, Img.map_layer_1, 0, 0);
	addLevel (2, Img.map_layer_2, 0, 0);
		
var EntityList = {};
	addEntity ("Player", Img.player, 30, 300, 5, 5, 26, 50);
	addEntity ("Wilson_Policeman", Img.wilson, 700, 370, 5, 5, 26, 50);
	addEntity ("Criminal", Img.criminal_1, 80, 70, 5, 5, 26, 50);
    addEntity ("Man_1", Img.man_1, 265, 70, 5, 5, 26, 50);
    addEntity ("Man_2", Img.man_2, 185, 270, 5, 5, 26, 50);
    addEntity ("Woman", Img.woman, 450, 310, 5, 5, 26, 50);
    addEntity ("Policeman_1", Img.policeman_1, 120, 70, 5, 5, 26, 50);
    addEntity ("Policeman_2", Img.policeman_2, 310, 70, 5, 5, 26, 50);
    addEntity ("Policeman_Exit", Img.policeman_3, 40, 370, 5, 5, 26, 50);
    addEntity ("Valentine_Locke", Img.valentine, 700, 70, 5, 5, 26, 50);
	
		
var WallList = {};
	addWall (1, 20, 210, 100, 230);
	addWall (2, 155, 210, 295, 230);
	addWall (3, 350, 210, 585, 230);
	addWall (4, 640, 295, 780, 230);
	addWall (5, 225, 20, 235, 230);
	addWall (6, 450, 20, 460, 230);


	
//variabili per i dialoghi e le azioni
var page = 0;			//numero di pagina del dialogo
var flag = false;		//set di inizio dialogo
var endMission = 0;		//set della fine della missione
var descrObject = "Niente di particolare da notare";	//variabile della descrizione da mostrare in seguito ad un approccio con un oggetto
var id_mission = 1;				//id della missione in corso
var chrono = 0;
var MAX_TIME = 3500;
var indizi = 0;

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
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Desk 1")			//collisioni delle entità con gli oggetti
            {	id_mission = 2; page = 1;	}
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Desk 3")			//collisioni delle entità con gli oggetti
			{	id_mission = 3; page = 1;	}
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Water 1")			//collisioni delle entità con gli oggetti
			{	id_mission = 4; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Water 2")			//collisioni delle entità con gli oggetti
			{	id_mission = 5; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Water 3")			//collisioni delle entità con gli oggetti
			{	id_mission = 6; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Water 4")			//collisioni delle entità con gli oggetti
			{	id_mission = 7; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Water 5")			//collisioni delle entità con gli oggetti
			{	id_mission = 8; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Box 1")			//collisioni delle entità con gli oggetti
			{	id_mission = 9; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Box 2")			//collisioni delle entità con gli oggetti
			{	id_mission = 10; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Board")			//collisioni delle entità con gli oggetti
			{	id_mission = 11; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Plant 1")			//collisioni delle entità con gli oggetti
			{	id_mission = 12; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Plant 2")			//collisioni delle entità con gli oggetti
			{	id_mission = 13; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Plant 3")			//collisioni delle entità con gli oggetti
			{	id_mission = 14; page = 1;	}
            if (objectCollision (EntityList[en], ObjectList[ob]) == "Plant 4")			//collisioni delle entità con gli oggetti
			{	id_mission = 15; page = 1;	}
            
			
		}
		for (var ent in EntityList)
		{
			if (en != ent)
			{	
				if (entityCollision (EntityList[en], EntityList[ent]) == "Wilson_Policeman")
				{	id_mission = 16;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_1")
				{	id_mission = 17;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_2")
				{	id_mission = 18;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Criminal")
				{	id_mission = 19;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Man_1")
				{	id_mission = 20;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Man_2")
				{	id_mission = 21;	page = 1;	}
                if (entityCollision (EntityList[en], EntityList[ent]) == "Woman")
				{	id_mission = 22;	page = 1;	}
                if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_Exit")
				{	id_mission = 23;	page = 1;	}
                if (entityCollision (EntityList[en], EntityList[ent]) == "Valentine_Locke")
				{	id_mission = 24;	page = 1;	}
				
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
	{	statusLevel (1, "MISSIONE          Interagisci con la signorina Locke . Se credi di aver finito, interagisci con l'agente vicino all'entrata.");	}
	else
	{	statusLevel (1, "LIVELLO COMPLETATO.       Premi E per andare al prossimo livello oppure esplora ancora la mappa")}
	
	mission ();
    autoplay ();
	
    if(chrono > MAX_TIME)
    {
        window.location.replace("../level/game_over.html");
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
    drawCounter(MAX_TIME);
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
		{	mission_desk_1 (page);	}
		if (id_mission == 3)
		{	mission_desk_3 (page);	}
		if (id_mission == 4)
		{	mission_water_1 (page);	}
		if (id_mission == 5)
		{	mission_water_2 (page);	}
		if (id_mission == 6)
		{	mission_water_3 (page);	}
		if (id_mission == 7)
		{	mission_water_4 (page);	}
		if (id_mission == 8)
		{	mission_water_5 (page);	}
		if (id_mission == 9)
		{	mission_box_1 (page);	}
		if (id_mission == 10)
		{	mission_box_2 (page);	}
        if (id_mission == 11)
		{	mission_board (page);	}
        if (id_mission == 12)
		{	mission_plant_1 (page);	}
        if (id_mission == 13)
		{	mission_plant_2 (page);	}
        if (id_mission == 14)
		{	mission_plant_3 (page);	}
        if (id_mission == 15)
		{	mission_plant_4 (page);	}
        if (id_mission == 16)
		{	mission_wilson (page);	}
        if (id_mission == 17)
		{	mission_policeman_1 (page);	}
        if (id_mission == 18)
		{	mission_policeman_2 (page);	}
        if (id_mission == 19)
		{	mission_criminal (page);	}
        if (id_mission == 20)
		{	mission_man_1 (page);	}
        if (id_mission == 21)
		{	mission_man_2 (page);	}
        if (id_mission == 22)
		{	mission_woman (page);	}
        if (id_mission == 23)
		{	mission_policeman_exit (page);	}
        if (id_mission == 24)
		{	mission_valentine (page);	}
	}
	
	if (id_mission == -1)
	{
		escapeLevel (1, "level_08.html");
	}
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Valentine Locke è stata convocata ed è appena arrivata.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Dovresti trovarla nel tuo ufficio.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("Dovresti cercare l'agente Wilson per avere più informazioni su di lei.");
	}
}

//missione che si attiva interagendo con l'agente Wilson
function mission_wilson (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("WILSON                   Salve, detective. La signorina Locke la sta aspettando nel suo ufficio.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Grazie Agente.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("WILSON                   Posso permettermi di darle un consiglio?");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("TU                       Certo, mi dica pure.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("WILSON                   E' una donna dal carattere molto forte.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("WILSON                   Ci ha risposto con molta rabbia quando l'abbiamo convocata in commissariato.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("WILSON                   Potrebbe essere un indiziata molto plausibile per l'omicidio.");
	}
    else if (page === 15 || page === 16)
	{	
		actionLevel ("TU                       Ottimo. Seguirò il suo consiglio.");
	}
    
}

//funzione che si attiva interagendo con la tua scrivania
function mission_desk_1 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI SULLA SCRIVANIA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("Ecco la scrivania del tuo ufficio.");
	}
	else if (page === 5 || page === 6)
	{
        actionLevel ("Sopra di essa ci sono diversi oggetti.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("Ecco il referto medico della sezione scientifica.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("SFOGLI IL REFERTO");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("E' presente una foto del cadavere del signor Caine.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("Ha in fronte un grosso foro, causato da un proiettile di pistola calibro 9mm.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("E' morto sul colpo.");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("E' stato vittima di strangolamento, ma non è stata quella la causa della sua morte.");
	}
    else if (page === 19 || page === 20)
	{
        actionLevel ("La presa è stata davvero forte, i segni sono visibili.");
	}
    else if (page === 21 || page === 22)
    {
         actionLevel("Improbabile che sia dovuta da una stretta causata da mani, non ne avrebbero la forza.");
    }
    else if (page === 23 || page === 24)
    {
         actionLevel("Non è stato trovato però uno strumento adatto ad una presa cosi forte.");
    }
    else if (page === 25 || page === 26)
    {
         actionLevel("Il particolare piu' interessante è il braccio amputato.");
    }
    else if (page === 27 || page === 28)
    {
         actionLevel("E' stato diviso dal corpo come se fosse stato letteralmente strappato via.");
    }
    else if (page === 29 || page === 30)
    {
         actionLevel("L'osso e' stato spezzato all'altezza dell'avambraccio. Il dolore deve essere stato molto forte.");
    }
    else if (page === 31 || page === 32)
    {
         actionLevel("Il sangue porta nei pressi di una macchina idraulica. Potrebbe essere stata quella la causa della ferita.");
    }
    else if (page === 33 || page === 34)
    {
         actionLevel("Non ci sono impronte sulla scena del delitto, nemmeno una. L'omicidio deve essere stato intenzionale.");
    }
    else if (page === 35 || page === 36)
    {
         actionLevel("Ed inoltre non ci sono testimoni: la fabbrica era abbandonata da mesi.");
    }
    else if (page === 37 || page === 38)
    {
         actionLevel("Il caso è davvero difficile, bisognerà ascoltare per bene tutti i sospettati.");
    }
}

//funzione che si attiva interagendo con la scrivania
function mission_desk_3 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI SULLA SCRIVANIA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("La scrivania è affollata di oggetti e fogli.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_water_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL BOCCIONE DELL'ACQUA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' quasi tutto pieno.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_water_2 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL BOCCIONE DELL'ACQUA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' quasi tutto vuoto.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_water_3 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL BOCCIONE DELL'ACQUA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("Il pulsante per versare l'acqua è rotto.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_water_4 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL BOCCIONE DELL'ACQUA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("L'acqua gocciola per terra, penso sia rotto.");
	}
}

//funzione che si attiva interagendo con il boccione dell'acqua
function mission_water_5 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL BOCCIONE DELL'ACQUA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("Il boccione è ammaccato, deve essere stato colpito violentemente da qualcuno.");
	}
}

//funzione che si attiva interagendo con il mobile
function mission_box_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL MOBILE");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' pieno di libri di criminologia e di storia del crimine.");
	}
}

//funzione che si attiva interagendo con il mobile
function mission_box_2 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI IL MOBILE");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("E' pieno di resoconti dettagliati sul crimine.");
	}
}

//funzione che si attiva interagendo con la lavagna
function mission_board ()
{
    "use strict";

    if (indizi == 0)
    {
        if (page === 1 || page === 2)
	    {	
            actionLevel ("Dopo la discussione con ND Rew ho tratto una conclusione.");
        }
        if (page === 3 || page === 4)
	    {	
            actionLevel ("E' un androide. Gia questo dovrebbe far pensare.");
        }
        if (page === 5 || page === 6)
	    {	
            actionLevel ("E' dettato dalle Tre Leggi della Robotica. Non può uccidere una persona, va contro la sua prima regola.");
        }
        if (page === 7 || page === 8)
	    {	
            actionLevel ("D'altronde, deve salvaguardare anche la sua esistenza. La seconda legge dice questo.");
        }
        if (page === 9 || page === 10)
	    {	
            actionLevel ("La terza legge dice che nonostante tutto, se è sotto pericolo non può uccidere nemmeno per salvarsi.");
        }
        if (page === 11 || page === 12)
	    {	
            actionLevel ("Il suo resoconto parla chiaro. Non ci sono segni di danneggiamento, ne malfunzionamento.");
        }
        if (page === 13 || page === 14)
	    {	
            actionLevel ("Le sue emozioni sintetiche, però, possono essere ingovernabili. Altri androidi sono stati ritirati per questo motivo.");
        }
        if (page === 15 || page === 16)
	    {	
            actionLevel ("E' chiaro che potrebbe anche mentire, dato che può provare 'emozioni'. Bisogna valutare tutto, a questo punto.");
        }
    }
    else if (indizi == 1)
    {
        if (page === 1 || page === 2)
	    {	
            actionLevel ("Dopo la discussione con la Locke ho tratto una conclusione.");
        }
        if (page === 3 || page === 4)
	    {	
            actionLevel ("Penso provasse qualcosa per Caine.");
        }
        if (page === 5 || page === 6)
	    {	
            actionLevel ("Da come ne parla, sembrava la migliore persona del mondo. Gli altri invece non lo hanno descritto proprio cosi.");
        }
        if (page === 7 || page === 8)
	    {	
            actionLevel ("Non si sa che il comportamento dell'uomo nei suoi confronti era diverso rispetto agli altri o se lei stia mentendo");
        }
        if (page === 9 || page === 10)
	    {	
            actionLevel ("Inoltre, dice che la sera prima del delitto era insieme ad un uomo, non si sa chi possa essere.");
        }
        if (page === 11 || page === 12)
	    {	
            actionLevel ("Nonostante tutto, come faceva a non sapere nulla degli eventi prima della sua morte se faceva quasi tutto per lui?");
        }
        if (page === 13 || page === 14)
	    {	
            actionLevel ("Caine non le aveva detto niente? Oppure è lei che mente, non volendo scoprirsi per non essere imputata colpevole?");
        }
        if (page === 15 || page === 16)
	    {	
            actionLevel ("Un bel dubbio, ne sapremo meglio in seguito.");
        }
    }
	
}

//funzione che si attiva interagendo con la pianta
function mission_plant_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA PIANTA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("Una bella pianta, verde ed in salute.");
	}
}

//funzione che si attiva interagendo con la pianta
function mission_plant_2 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA PIANTA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("La pianta non è in buona salute, ha delle foglie gialle.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("C'è un origami di un drago su una delle foglie.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("APRI L'ORIGAMI");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("'(E)vviva la vita diceva il signore, ma io non sapevo cosa fosse quel nome,'");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("fatto da mani è il guscio mio, fatto da umani e non da Dio.'");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("Firmato 'Il Grande Fratello'");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("Chissà chi è l'autore di questo messaggio.");
	}
}

//funzione che si attiva interagendo con la pianta
function mission_plant_3 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA PIANTA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("C'è un ragno che tesse una ragnatela.");
	}
}

//funzione che si attiva interagendo con la pianta
function mission_plant_4 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA PIANTA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("Penso abbia bisogno di un po' d'acqua.");
	}
}

//funzione che si attiva interagendo con l'agente
function mission_policeman_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Salve, detective.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, agente. Chi è quest'uomo?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("AGENTE                   Lui è Tony Montana, un noto esponente della mafia.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("AGENTE                   E' stato per anni il più potente boss della città.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("AGENTE                   Siamo riusciti ad arrestarlo dopo una lunga latitanza.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("AGENTE                   Ora la città può dormire sogni tranquilli.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("TU                       Grazie, agente.");
	}
}

//funzione che si attiva interagendo con l'agente
function mission_policeman_2 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Salve, detective.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, agente. Chi è quest'uomo?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("AGENTE                   Lui è Ronald Weasley, un tizio venuto dall'Inghilterra.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("AGENTE                   Lo stiamo interrogando per disordini che ha causato in centro.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("AGENTE                   I testimoni dicono che usava una bacchetta, come se fosse un mago.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("AGENTE                   Quale sarà la verità? Lo sapremo presto.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("TU                       Grazie, agente.");
	}
}

//funzione che si attiva interagendo con l'uomo
function mission_man_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("RONALD WEASLEY           Salve, agente.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("RONALD WEASLEY           Perchè sono ancora qui? Non ho fatto nulla di male.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TU                       Cos'è successo, dunque? Perche l'hanno arrestata?");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("RONALD WEASLEY           Ero in un ristorante ed una caraffa d'acqua è esplosa.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("RONALD WEASLEY           Il lampadario è crollato su di un tavolo e le lampadine sono scoppiate.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("RONALD WEASLEY           Per la polizia sono io il colpevole, solo perchè stavo avendo una discussione accesa con mia moglie.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("TU                       Vedremo cosa diranno i miei colleghi.");
	}
}

//funzione che si attiva interagendo con l'uomo
function mission_man_2 ()
{
     "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TU                       Salve, posso aiutarla?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("JOHN SNOW                Salve, agente. Ho appena testimoniato sulla morte di mio padre.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("JOHN SNOW                Spero che i suoi colleghi sappiano fare un buon lavoro per consegnare il colpevole alla giustizia.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Faremo di tutto per arrestare l'omicida.");
	}
}

//funzione che si attiva interagendo con la donna
function mission_woman ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("SIG.RA LANNISTER         Salve, agente.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, posso esserle utile?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("SIG.RA LANNISTER         Sono stata convocata qui. Dicono che abbia ucciso un certo signor Stark");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("SIG.RA LANNISTER         Sono disposta ad essere interrogata, ma sappia che io non c'entro nulla.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("TU                       La staranno aspettando di certo nella sala di fronte.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("SIG.RA LANNISTER         Grazie, agente.");
	}
}

//funzione che si attiva interagendo con il criminale
function mission_criminal ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TONY MONTANA             Chi è lei?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Sono un detective. Tu chi sei?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TONY MONTANA             Sono Tony Montana, il re del mondo.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TONY MONTANA             Tutti voi siete solo delle mie pedine. Usirò presto di qui.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("TU                       Gia, certo.");
	}
}

//funzione che si attiva interagendo con l'agente
function mission_policeman_exit ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Mi dica detective.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Appena possibile faccia venire l'ultima sospettato nel mio ufficio");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("AGENTE                   Certamente, appena arriverò lo porterò da lei.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Grazie, agente.");
	}
    else if (page === 9)
	{
        id_mission = -1;
	}
}

//funzione che si attiva interagendo con il sospettato
function mission_valentine ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TU                       Salve, signorina Locke.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("VALENTINE LOCKE          Era ora, detective. Mi ha fatto aspettare un sacco di tempo inutilmente.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("VALENTINE LOCKE          Ho anche altro da fare, io. Non sono venuta qui a perdere tempo.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Stia calma, signorina. Iniziamo subito.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("VALENTINE LOCKE          Che fortuna!");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       E' a conoscenza della morte del signor Caine, il suo capo?");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("VALENTINE LOCKE          Si, certo. Sono venuto a saperlo da una mia collega.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("VALENTINE LOCKE          E' stata una notizia sconvolgente. Sono davvero dispiaciuta.");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("TU                       Dove si trovava ieri sera?");
	}
    else if (page === 19 || page === 20)
	{
        actionLevel ("VALENTINE LOCKE          Ieri sera? Ero a cena con un uomo, sono uscita alle 22:00.");
	}
    else if (page === 21 || page === 22)
	{
        actionLevel ("TU                       Perchè ha chiamato il signor Caine alle 17:40?");
	}
    else if (page === 23 || page === 24)
	{
        actionLevel ("VALENTINE LOCKE          L'ho chiamato perchè volevo farmi spiegare alcune procedure da compiere.");
	}
    else if (page === 25 || page === 26)
	{
        actionLevel ("TU                       Ovvero?");
	}
    else if (page === 27 || page === 28)
	{
        actionLevel ("VALENTINE LOCKE          Come sistemare alcuni documenti all'interno del suo ufficio.");
	}
    else if (page === 29 || page === 30)
	{
        actionLevel ("TU                       Aveva una relazione intima con il signor Caine?");
	}
    else if (page === 31 || page === 32)
	{
        actionLevel ("VALENTINE LOCKE          Cosa? Come fa a pensare ad una cosa simile?");
	}
    else if (page === 33 || page === 34)
	{
        actionLevel ("TU                       Devo vagliare tutte le ipotesi, è importante non tralasciare nulla.");
	}
    else if (page === 35 || page === 36)
	{
        actionLevel ("VALENTINE LOCKE          Non avevamo una relazione intima. Io ed il signor Caine avevamo solo un rapporto tra dipendente e capo.");
	}
    else if (page === 37 || page === 38)
	{
        actionLevel ("TU                       Come la trattava il signor Caine? Eravate in buoni rapporti?");
	}
    else if (page === 39 || page === 40)
	{
        actionLevel ("VALENTINE LOCKE          Certo. Il signor Caine era un bravo uomo. Era in buoni rapporti con tutti.");
	}
    else if (page === 41 || page === 42)
	{
        actionLevel ("TU                       Davvero? Mi direbbe alcuni dei suoi pregi?");
	}
    else if (page === 43 || page === 44)
	{
        actionLevel ("VALENTINE LOCKE          Era conosciuto da tutti come una persona gentile e disponibile.");
	}
    else if (page === 45 || page === 46)
	{
        actionLevel ("VALENTINE LOCKE          Penso che lei lo sappia. Se dovesse chiedere a chiunque lo conosca le direbbe ciò che le dico io.");
	}
    else if (page === 47 || page === 48)
	{
        actionLevel ("TU                       Quali erano esattamente i suoi compiti per il signor Caine?");
	}
    else if (page === 49 || page === 50)
	{
        actionLevel ("VALENTINE LOCKE          Ero la sua segretaria ma facevo per lui un pò di tutto.");
	}
    else if (page === 51|| page === 52)
	{
        actionLevel ("VALENTINE LOCKE          Molte volte ho dovuto presentarmi io al posto suo perchè lui era molto impegnato in altre attività.");
	}
    else if (page === 53|| page === 54)
	{
        actionLevel ("VALENTINE LOCKE          Come dicono i giornali, era un uomo impegnato nel sociale. Dovrebbe chiedere a quelle storie.");
	}
    else if (page === 55 || page === 56)
	{
        actionLevel ("TU                       Il signor Caine aveva altre donne?");
	}
    else if (page === 57 || page === 58)
	{
        actionLevel ("VALENTINE LOCKE          Oh no, il signor Caine era un uomo fedele! Amava sua moglie e la trattava come una principessa.");
	}
    else if (page === 59 || page === 60)
	{
        actionLevel ("VALENTINE LOCKE          Non so come immagina il signor Caine ma è proprio diverso dall'uomo che descrive nelle sue domande.");
	}
    else if (page === 61 || page === 62)
	{
        actionLevel ("TU                       Conosce ND Rew?");
	}
    else if (page === 63 || page === 64)
	{
        actionLevel ("VALENTINE LOCKE          So che è il suo domestico e che è un androide. Altro non le so dire.");
	}
    else if (page === 65 || page === 66)
	{
        actionLevel ("TU                       Di Sepp Jaytene, cosa mi sa dire?");
	}
    else if (page === 67 || page === 68)
	{
        actionLevel ("VALENTINE LOCKE          Ha avuto un diverbio acceso con il signor Caine. Penso si riferisse ad un motivo di denaro.");
	}
    else if (page === 69 || page === 70)
	{
        actionLevel ("VALENTINE LOCKE          In molti approfittavano della gentilezza del signor Caine per truffarlo, ma lui era un uomo forte.");
	}
    else if (page === 71 || page === 72)
	{
        actionLevel ("TU                       Di Lavinia Weir cosa sa? E di Frank Fourniet?");
	}
    else if (page === 73 || page === 74)
	{
        actionLevel ("VALENTINE LOCKE          La signora Weir era una donna austera, penso anche tradisse suo marito. Nonstante tutto, egli l'amava.");
	}
    else if (page === 75 || page === 76)
	{
        actionLevel ("VALENTINE LOCKE          Frank, invece, è un'ottima persona. Mi dispiace che lui e il signor Caine litigarono.");
	}
    else if (page === 77 || page === 78)
	{
        actionLevel ("VALENTINE LOCKE          Durante le feste era il migliore, faceva ridere tutti. Mi diveritva un sacco ascoltarlo.");
	}
    else if (page === 79 || page === 80)
	{
        actionLevel ("TU                       Va bene. Penso di avere elementi sufficenti per il momento.");
	}
    else if (page === 81 || page === 82)
	{
        actionLevel ("TU                       Non si muova dalla città per nessun motivo.");
	}
    else if (page === 83 || page === 84)
	{
        actionLevel ("VALENTINE LOCKE          Va bene, ma eviti di chiamarmi se non è proprio necessario.");
	}
    else if (page == 85)
    {
        indizi = 1;
        id_mission = -1;
    }
}