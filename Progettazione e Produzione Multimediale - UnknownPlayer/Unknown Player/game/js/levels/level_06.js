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
	Img.map_layer_1.src = "../img/level_06/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_06/map_layer_2.png";
	Img.wilson = new Image ();
	Img.wilson.src = "../img/characters/wilson.png";
    Img.criminal_1 = new Image ();
	Img.criminal_1.src = "../img/characters/criminal_2.png";
	Img.man_1 = new Image ();
	Img.man_1.src = "../img/characters/man_3.png";
    Img.man_2 = new Image ();
	Img.man_2.src = "../img/characters/man_4.png";
    Img.woman = new Image ();
	Img.woman.src = "../img/characters/woman_2.png";
	Img.policeman_1 = new Image ();
    Img.policeman_1.src = "../img/characters/policeman_1.png";
    Img.policeman_2 = new Image ();
    Img.policeman_2.src = "../img/characters/policeman_2.png";
    Img.policeman_3 = new Image ();
    Img.policeman_3.src = "../img/characters/policeman_3.png";
    Img.desk = new Image ();
    Img.desk.src = "../img/level_06/desk.png";
	Img.water_box = new Image ();
    Img.water_box.src = "../img/level_06/water_box.png";
    Img.box = new Image ();
    Img.box.src = "../img/level_06/box.png";
    Img.board = new Image ();
    Img.board.src = "../img/level_06/board.png";
    Img.plant = new Image ();
    Img.plant.src = "../img/level_06/plant.png";
    Img.nd_rew = new Image ();
	Img.nd_rew.src = "../img/characters/nd_rew_android.png";

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
    addEntity ("ND Rew", Img.nd_rew, 700, 70, 5, 5, 26, 50);
	
		
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
                if (entityCollision (EntityList[en], EntityList[ent]) == "ND Rew")
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
	{	statusLevel (1, "MISSIONE          Interagisci con ND Rew. Se credi di aver finito, interagisci con l'agente vicino all'entrata.");	}
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
		{	mission_nd_rew (page);	}
	}
	
	if (id_mission == -1)
	{
		escapeLevel (1, "level_06.html");
	}
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Sepp Jaytene è stato convocato ed è appena arrivato.");
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
		actionLevel ("WILSON                   Salve, detective. L'androide ND Rew la sta aspettando nel suo ufficio.");
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
		actionLevel ("WILSON                   Non conosco molto il modello Nexus6.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("WILSON                   Però, a quanto ho sentito, è un prototipo di ultima generazione.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("WILSON                   Chissà se non ha qualche problema di progettazione.");
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
    else if (page === 5 || page === 6)
	{
        actionLevel ("C'è un origami a forma di volpe su una mensola.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("APRI L'ORIGAMI");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("(R)abbia e furia non posso celare sebbene il mio istinto non è animale,");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("stretta è la gabbia dove sognare ma più io non so sopportare");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("Firmato 'Il Grande Fratello'");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("A cosa si riferirà!");
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
            actionLevel ("Dopo la discussione con Jaytene ho tratto una conclusione.");
        }
        if (page === 3 || page === 4)
	    {	
            actionLevel ("I suoi pensieri su Horace Caine sono discordanti per certi versi.");
        }
        if (page === 5 || page === 6)
	    {	
            actionLevel ("Ha un gran timore di lui ma si è esposto stranamente confutando questa cosa, dimostrando di non averne affatto");
        }
        if (page === 7 || page === 8)
	    {	
            actionLevel ("Penso che soffra di disturbo bipolare.");
        }
        if (page === 9 || page === 10)
	    {	
            actionLevel ("Potrebbe essere molto aggressivo. Dati i trascorsi negativi potrebbe essere stato lui il colpevole.");
        }
        if (page === 11 || page === 12)
	    {	
            actionLevel ("In un acceso attacco d'ira che non ha saputo controllare può aver fatto a pugni ed ucciso Caine.");
        }
        if (page === 13 || page === 14)
	    {	
            actionLevel ("D'altronde ha anche affermato di aver sentito Caine e Frank Fournite discutere animatamente.");
        }
        if (page === 15 || page === 16)
	    {	
            actionLevel ("Può darsi che abbia effettivamente ragione e sia lui il colpevole. Bisogna tastare bene i vari percorsi.");
        }
    }
    else if (indizi == 1)
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
        actionLevel ("AGENTE                   Lui è Dom Toretto, un vero criminale.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("AGENTE                   E' noto per le sue corse clandestine, illegali e pericolose.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("AGENTE                   Siamo riusciti a catturarlo dopo un lunghissimo inseguimento automobilistico");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("AGENTE                   Le sue amate corse gli hanno teso un brutto scherzo.");
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
        actionLevel ("TU                       Salve, lei chi è?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("RONALD WEASLEY           Sono Ronald Weasley. Perchè sono bloccato qui?");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Questo dovrebbe dirmelo lei. Cosa ha fatto per essere qui?");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("RONALD WEASLEY           Credo di esser stato trattato ingiustamente. Non ho fatto nulla di male.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("RONALD WEASLEY           Ero in un ristorante quando è esplosa una caraffa di acqua. Hanno pensato che fossi stato io.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("TU                       Non penso che lei abbia detto tutto, signor Weasley.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("RONALD WEASLEY           Deve credermi, agente. Le dico la verità.");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("TU                       Vedremo.");
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
        actionLevel ("JOHN SNOW                Salve, sono John Snow. Sono qui perchè devo testimoniare per la morte di mio padre.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TU                       Dovrebbe attendere qualche minuto. Gli altri agenti sono occupati.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("JOHN SNOW                Va bene, allora aspetterò qui.");
	}
}

//funzione che si attiva interagendo con la donna
function mission_woman ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("OLIVIA DUNHAM            Salve, agente.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, posso esserle utile?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("OLIVIA DUNHAM            Volevo ringraziarla per aver trovato il signor Bishop.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("OLIVIA DUNHAM            E' un vecchio amico ma purtroppo non è più l'uomo di un tempo.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("OLIVIA DUNHAM            E' uscito da un ospedale psichiatrico, deve ricevere sempre assistenza ma è riuscito a fuggire");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Si figuri, non c'è problema.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("OLIVIA DUNHAM            Grazie al cielo! E' stato un bene che sia stato trovato!");
	}
}

//funzione che si attiva interagendo con il criminale
function mission_criminal ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("DOM TORETTO              Ehi tu, allontanati da qui.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("DOM TORETTO              Esigo un avvocato. Voglio uscire da qui.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("DOM TORETTO              Non parlerò se non ho prima il mio avvocato");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Il suo avvocato sta arrivando. Si rilassi.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("DOM TORETTO              Il mio posto non è qui, è la strada la mia casa!");
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
        actionLevel ("TU                       Appena possibile faccia venire il quarto sospettato nel mio ufficio");
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
function mission_nd_rew ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("ND REW                   Salve detective.");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Benvenuto ND Rew. Sei stato puntuale.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("ND REW                   Non ho avuto motivo per non essere stato puntuale.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("ND REW                   Il mio padrone è morto. Nessuno avrebbe potuto farmi fare altro.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("TU                       Quale rapporto avevi con il signor Caine, il suo padrone?");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("ND REW                   Il signor Caine era il mio padrone. Non so cosa possa essere una relazione diversa da questa.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("ND REW                   Il mio compito è quello di servire il mio padrone. Sono stato creato per quello.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("TU                       Tu sei un modello Nexus6. In cosa si differenzia dai modelli precedenti?");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("ND REW                   Ho un cervello positronico da 1024 layer, da 300 Exabyte ciascuno.");
	}
    else if (page === 19 || page === 20)
	{
        actionLevel ("ND REW                   E' in grado di eseguire 2048 thread contemporaneamente, ciascuno dei...");
	}
    else if (page === 21 || page === 22)
	{
        actionLevel ("TU                       Un attimo, un attimo. Passa oltre i tecnicismi e parla molto più semplice.");
	}
    else if (page === 23 || page === 24)
	{
        actionLevel ("ND REW                   In parole semplici, il mio cervello è in grado di assimilare empatia da chi mi circonda.");
	}
    else if (page === 25 || page === 26)
	{
        actionLevel ("ND REW                   Tramite processi multipli apprendo le connessioni ed emulo i comportamenti umani.");
	}
    else if (page === 27 || page === 28)
	{
        actionLevel ("ND REW                   Praticamente, imparo a percepire ed esprimere emozioni umane.");
	}
    else if (page === 29 || page === 30)
	{
        actionLevel ("TU                       Quanti modelli sono stati rilasciati fino a questo momento?");
	}
    else if (page === 31 || page === 32)
	{
        actionLevel ("ND REW                   Sono stati prodotti 21 androidi simili a me, 18 sono stati ritirati.");
	}
    else if (page === 33 || page === 34)
	{
        actionLevel ("TU                       Come mai sono stati ritirati?");
	}
    else if (page === 35 || page === 36)
	{
        actionLevel ("ND REW                   11 sono stati ritirati a causa di overflow di emozioni. Hanno appreso troppo velocemente e sono stati danneggiati.");
	}
    else if (page === 37 || page === 38)
	{
        actionLevel ("ND REW                   5 sono andati distrutti a causa di danneggiamenti hardware. Le cause sono sconosciute.");
	}
    else if (page === 39 || page === 40)
	{
        actionLevel ("ND REW                   2 sono fuggiti dal luogo assegnato loro per ambiguità negli ordini fornitigli.");
	}
    else if (page === 41 || page === 42)
	{
        actionLevel ("TU                       Quindi esiste la possibilità di danneggiamento a causa di troppe emozioni?");
	}
    else if (page === 43 || page === 44)
	{
        actionLevel ("ND REW                   Corretto. E' una delle cause principali di collasso del sistema del cervello positronico.");
	}
    else if (page === 45 || page === 46)
	{
        actionLevel ("TU                       Vorrei avere una diagnostica sui malfunzionamenti che hai avuto.");
	}
    else if (page === 47 || page === 48)
	{
        actionLevel ("ND REW                   Certo, detective. Sono stato posto a controllo due ore fa. Il resoconto è stato già consegnato.");
	}
    else if (page === 49 || page === 50)
	{
        actionLevel ("TU                       Perchè il signor Caine ti ha ordinato di andare alla fabbrica?");
	}
    else if (page === 51|| page === 52)
	{
        actionLevel ("ND REW                   Non conosco i suoi reali motivi. Non mi sono stati riferiti.");
	}
    else if (page === 53|| page === 54)
	{
        actionLevel ("TU                       Dunque eri presente al momento dell'omicidio?");
	}
    else if (page === 55 || page === 56)
	{
        actionLevel ("ND REW                   No, non ero ancora giunto sul luogo. Ho trovato il signor Caine senza al mio arrivo.");
	}
    else if (page === 57 || page === 58)
	{
        actionLevel ("ND REW                   Sono stato io a chiamare la polizia per avvertirla della sua morte.");
	}
    else if (page === 59 || page === 60)
	{
        actionLevel ("TU                       Per quale motivo il signor Caine si è recato li?");
	}
    else if (page === 61 || page === 62)
	{
        actionLevel ("ND REW                   Ho ascoltato una sua chiamata alle 18:35. Parlava con la signorina Locke riguardo un loro incontro.");
	}
    else if (page === 63 || page === 64)
	{
        actionLevel ("TU                       Conosci Lavinia Weir?");
	}
    else if (page === 65 || page === 66)
	{
        actionLevel ("ND REW                   Si, è la moglie del signor Caine. Lei e suo marito non avevano un bel rapporto. Litigavano sempre.");
	}
    else if (page === 67 || page === 68)
	{
        actionLevel ("TU                       Cosa sai dirmi di Sepp Jaytene?");
	}
    else if (page === 69 || page === 70)
	{
        actionLevel ("ND REW                   Conosco poco il signor Jaytene. So che provava forte risentimento per il signor Caine.");
	}
    else if (page === 71 || page === 72)
	{
        actionLevel ("TU                       Il nome di Frank Fournite ti suona familiare?");
	}
    else if (page === 73 || page === 74)
	{
        actionLevel ("ND REW                   Il signor Fournite era un ex socio del signor Caine.");
	}
    else if (page === 75 || page === 76)
	{
        actionLevel ("ND REW                   Hanno litigato dopo un affare non riuscito. Da allora non avevano un buon rapporto.");
	}
    else if (page === 77 || page === 78)
	{
        actionLevel ("ND REW                   Il signor Caine non aveva buoni rapporti con molte persone, purtroppo.");
	}
    else if (page === 79 || page === 80)
	{
        actionLevel ("TU                       Va bene. Penso di avere elementi sufficenti per il momento.");
	}
    else if (page === 81 || page === 82)
	{
        actionLevel ("TU                       Non muoverti dalla città per nessun motivo.");
	}
    else if (page === 83 || page === 84)
	{
        actionLevel ("SEPP JAYTENE             Va bene detective. Rimarrò a casa del signor Caine.");
	}
    else if (page == 85)
    {
        indizi = 1;
        id_mission = -1;
    }
}