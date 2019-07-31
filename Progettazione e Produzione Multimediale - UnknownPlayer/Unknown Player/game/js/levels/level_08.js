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
	Img.map_layer_1.src = "../img/level_08/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_08/map_layer_2.png";
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
    Img.desk.src = "../img/level_08/desk.png";
	Img.water_box = new Image ();
    Img.water_box.src = "../img/level_08/water_box.png";
    Img.box = new Image ();
    Img.box.src = "../img/level_08/box.png";
    Img.board = new Image ();
    Img.board.src = "../img/level_08/board.png";
    Img.plant = new Image ();
    Img.plant.src = "../img/level_08/plant.png";
    Img.frank = new Image ();
	Img.frank.src = "../img/characters/frank_fournite.png";

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
    addEntity ("Frank_Fournite", Img.frank, 700, 70, 5, 5, 26, 50);
	
		
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
                if (entityCollision (EntityList[en], EntityList[ent]) == "Frank_Fournite")
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
	{	statusLevel (1, "MISSIONE          Interagisci con il signor Fournite. Se credi di aver finito, interagisci con l'agente vicino all'entrata.");	}
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
		{	mission_frank (page);	}
	}
	
	if (id_mission == -1)
	{
		escapeLevel (1, "level_09.html");
	}
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Frank Fournite è stato convocato ed è appena arrivato.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Dovresti trovarlo nel tuo ufficio.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("Dovresti cercare l'agente Wilson per avere più informazioni su di lui.");
	}
}

//missione che si attiva interagendo con l'agente Wilson
function mission_wilson (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("WILSON                   Salve, detective. Il signor Fournite la sta aspettando nel suo ufficio.");
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
		actionLevel ("TU                       Certo, mi dica pure pure.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("WILSON                   Il signor Fournite è un tipo diverso dagli altri sospettati.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("WILSON                   Sembra un tipo senza peli sulla lingua, non ha paura delle conseguenze.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("WILSON                   Penso che le dirà tutto quello che sa, ma non si fidi di tutto ciò che dice comunque.");
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
    else if (page === 5 || page === 6)
	{
        actionLevel ("C'è un origami di un cavallo sul lato superiore.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("APRI L'ORIGAMI");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("'(W)allace di Scozia cantava libertà per l'uomo stretto in cattività,'");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("'decisi cosi di fuggir dal signore ma egli spirò dicendo il mio nome'");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("Firmato 'Il Grande Fratello'");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("Chissà se avrà un significato particolare.");
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
    else if (indizi == 1)
    {
        if (page === 1 || page === 2)
	    {	
            actionLevel ("Dopo la discussione con Fournite ho tratto una conclusione.");
        }
        if (page === 3 || page === 4)
	    {	
            actionLevel ("L'odio per Caine è profondo e sincero. Per come ne ha parlato è il peggior uomo sulla faccia della Terra.");
        }
        if (page === 5 || page === 6)
	    {	
            actionLevel ("Non è l'unico a dirlo, ma lui non si cura affatto di nasconderlo.");
        }
        if (page === 7 || page === 8)
	    {	
            actionLevel ("E' un tipo sanguigno. Ha ammesso senza mezzi termini che la sua morte lo ha reso felice.");
        }
        if (page === 9 || page === 10)
	    {	
            actionLevel ("Ciò non vuol dire che sia stato lui ad ucciderlo. Oppure è così spavaldo da non avere paura.");
        }
        if (page === 11 || page === 12)
	    {	
            actionLevel ("Inoltre, non ha problemi a provarci con altre donne.");
        }
        if (page === 13 || page === 14)
	    {	
            actionLevel ("Si è fatto sfuggire che ama la Weir, ma anche che prova attrazione per la Locke.");
        }
        if (page === 15 || page === 16)
	    {	
            actionLevel ("L'omicidio a sfondo passionale è una teoria molto forte. Chissa se non sia stato lui.");
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

///funzione che si attiva interagendo con l'uomo
function mission_man_1 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("RONALD WEASLEY           Salve, agente.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("RONALD WEASLEY           Perchè sono ancora qui? Quand'è che uscirò finalmente?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TU                       Dovrebbe dire la verità per il motivo per cui lei è qui.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("RONALD WEASLEY           Ma... Agente... Io non so perchè sono qui!");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("RONALD WEASLEY           Tutto quello che è successo non è mica colpa mia.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("RONALD WEASLEY           Cosa crede?? Che sia un mago?");
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
        actionLevel ("JOHN SNOW                Sapete già chi è stato. Per favore, non fatevi intimorire dal suo potere e arrestatelo!");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Faremo di tutto per assicurarcelo alla giustizia, non tema.");
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
        actionLevel ("SIG.RA LANNISTER         Sono stata convocata qui. Ho appena avuto l'interrogatorio.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("SIG.RA LANNISTER         Il figlio del signor Stark continua a ritenermi la colpevole della sua morte.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("SIG.RA LANNISTER         Io non c'entro nulla. Glielo assicuro!");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       Non sarò io a decidere. L'agente incaricato vedrà cosa fare di lei.");
	}
}

//funzione che si attiva interagendo con il criminale
function mission_criminal ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TONY MONTANA             Allontanati, sbirro!");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Calmo, Montana. Non voglio farti nulla.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TONY MONTANA             Meglio per te. Non sai con chi hai a che fare.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TONY MONTANA             La galera non mi fa paura. Supererò anche questo e mi risolleverò dalle ceneri!");
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
        actionLevel ("TU                       Penso di avere tutti gli elementi sufficenti dopo gli interrogatori. Mi ritirerò per pensare.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("AGENTE                   Certamente. Faccio in modo che non la disturbi nessuno.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Grazie agente.");
	}
    else if (page === 9 || page === 10)
	{
        id_mission = -1;
	}
}

//funzione che si attiva interagendo con il sospettato
function mission_frank ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("FRANK FOURNITE           Salve, detective. Mi ha mandato a chiamare?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, signor Fournite. E' venuto a conoscenza della morte del signor Caine?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("FRANK FOURNITE           Caine? Horace Caine? Si riferisce a lui?");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Si proprio così. Deduco che non ha ricevuto la notizia.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("FRANK FOURNITE           No, mi dispiace. Sono appena venuto a saperlo da lei...");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       Che rapporto aveva con il signor Caine, poco prima della sua morte?");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("FRANK FOURNITE           Horace ed io non eravamo più in buoni rapporti da ormai troppo tempo.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("TU                       Come mai?.");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("FRANK FOURNITE           Abbiamo litigato poco tempo fa. Eravamo soci in affari ma ha fatto cose che non avrebbe dovuto fare.");
	}
    else if (page === 19 || page === 20)
	{
        actionLevel ("TU                       Ovvero.");
	}
    else if (page === 21 || page === 22)
	{
        actionLevel ("FRANK FOURNITE           Mmmh... Diciamo che ha preso ciò che era mio.");
	}
    else if (page === 23 || page === 24)
	{
        actionLevel ("TU                       Come si risolse quella situazione, alla fine?.");
	}
    else if (page === 25 || page === 26)
	{
        actionLevel ("FRANK FOURNITE           Nel peggiore dei modi. Siamo venuti alle mani ed abbiamo concluso il nostro rapporto lavorativo.");
	}
    else if (page === 27 || page === 28)
	{
        actionLevel ("FRANK FOURNITE           Gli ho dovuto vendere molte compartecipazioni delle mie aziende. Stava diventando una situazione tragica.");
	}
    else if (page === 29 || page === 30)
	{
        actionLevel ("TU                       Di cosa parla?");
	}
    else if (page === 31 || page === 32)
	{
        actionLevel ("FRANK FOURNITE           Stava creando una politica di ostracismo incredibile. Mi ha danneggiato parecchio.");
	}
    else if (page === 33 || page === 34)
	{
        actionLevel ("TU                       Perchè ha chiamato il signor Caine alle 21:21?");
	}
    else if (page === 35 || page === 36)
	{
        actionLevel ("FRANK FOURNITE           Ho dovuto chiamarlo, se fosse stato per me avrei evitato di digitare il suo numero.");
	}
    else if (page === 37 || page === 38)
	{
        actionLevel ("FRANK FOURNITE           Avevamo una situazione da sbrigare. Sarebbe stata l'ultima. Dopodichè avrei tagliato tutti i ponti con lui.");
	}
    else if (page === 39 || page === 40)
	{
        actionLevel ("TU                       Di che si tratta?");
	}
    else if (page === 41 || page === 42)
	{
        actionLevel ("FRANK FOURNITE           Diciamo che il soggetto è una donna. Non le dirò altro, ne va della mia privacy.");
	}
    else if (page === 43 || page === 44)
	{
        actionLevel ("FRANK FOURNITE           Horace non è l'uomo che i giornali descrivono. Era un vile, un voltafaccia ed un doppiogiochista.");
	}
    else if (page === 45 || page === 46)
	{
        actionLevel ("TU                       Sono parole pesanti, queste.");
	}
    else if (page === 47 || page === 48)
	{
        actionLevel ("FRANK FOURNITE           Cosa vuole che me ne importi? Non ritornerà mica in vita per trascinarmi all'inferno. Hahaha!");
	}
    else if (page === 49 || page === 50)
	{
        actionLevel ("TU                       Dunque la sua morte non la tocca nemmeno?");
	}
    else if (page === 51|| page === 52)
	{
        actionLevel ("FRANK FOURNITE           Assolutamente no. Ciò non vuol dire che sia stato io ad ucciderlo.");
	}
    else if (page === 53|| page === 54)
	{
        actionLevel ("FRANK FOURNITE           Sono stato vessato per anni da lui, se l'è meritata. Non ero l'unico a cui ha fatto del male.");
	}
    else if (page === 55 || page === 56)
	{
        actionLevel ("TU                       Davvero? Saprebbe dirmi con chi altri avesse un conto in sospeso?");
	}
    else if (page === 57 || page === 58)
	{
        actionLevel ("FRANK FOURNITE           Erano davvero tanti. Ma nessuna parte del suo vero aspetto è mai uscita fuori dalle sue mura.");
	}
    else if (page === 59 || page === 60)
	{
        actionLevel ("FRANK FOURNITE           Aveva in mano giornali, tv, politici, gente potente. Era come una piovra, aveva mani dappertutto.");
	}
    else if (page === 61 || page === 62)
	{
        actionLevel ("FRANK FOURNITE           Probabilmente anche qui dentro aveva i suoi uomini. Probabilmente lei è uno di loro.");
	}
    else if (page === 63 || page === 64)
	{
        actionLevel ("TU                       Conosceva ND Rew?");
	}
    else if (page === 65 || page === 66)
	{
        actionLevel ("FRANK FOURNITE           Il suo zerbino? Altrochè? Chissa se si è ribellato mai a quello scellerato del suo padrone!");
	}
    else if (page === 67 || page === 68)
	{
        actionLevel ("TU                       Cosa mi sa dire di Sepp Jaytene?");
	}
    else if (page === 69 || page === 70)
	{
        actionLevel ("FRANK FOURNITE           Jaytene! Povero uomo. La vera vittima del carnefice Caine. Ha pagato per i suoi errori.");
	}
    else if (page === 71 || page === 72)
	{
        actionLevel ("FRANK FOURNITE           Ci scommetterei tutti i miei soldi che sia stato lui ad uccidere Horace.");
	}
    else if (page === 73 || page === 74)
	{
        actionLevel ("TU                       Conosce Lavinia Weir e Valentine Locke?");
	}
    else if (page === 75 || page === 76)
	{
        actionLevel ("FRANK FOURNITE           Belle donne, entrambi. Con Lavinia ci conosciamo fin da bambini, l'ho sempre amata come se fosse mia.");
	}
    else if (page === 77 || page === 78)
	{
        actionLevel ("FRANK FOURNITE           La Locke è una tipa tosta. Non si lascia abbindolare facilmente. E' questo che mi piace di lei.");
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
        actionLevel ("FRANK FOURNITE           Va bene, detective. Non mi muovo dai miei uffici.");
	}
    else if (page == 85)
    {
        indizi = 1;
        id_mission = -1;
    }
}