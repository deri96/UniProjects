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
	Img.map_layer_1.src = "../img/level_03/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_03/map_layer_2.png";
	Img.wilson = new Image ();
	Img.wilson.src = "../img/characters/wilson.png";
    Img.criminal_1 = new Image ();
	Img.criminal_1.src = "../img/characters/criminal_1.png";
	Img.man_1 = new Image ();
	Img.man_1.src = "../img/characters/man_1.png";
    Img.man_2 = new Image ();
	Img.man_2.src = "../img/characters/man_2.png";
    Img.woman = new Image ();
	Img.woman.src = "../img/characters/woman_1.png";
	Img.policeman_1 = new Image ();
    Img.policeman_1.src = "../img/characters/policeman_1.png";
    Img.policeman_2 = new Image ();
    Img.policeman_2.src = "../img/characters/policeman_2.png";
    Img.policeman_3 = new Image ();
    Img.policeman_3.src = "../img/characters/policeman_3.png";
    Img.desk = new Image ();
    Img.desk.src = "../img/level_03/desk.png";
	Img.water_box = new Image ();
    Img.water_box.src = "../img/level_03/water_box.png";
    Img.box = new Image ();
    Img.box.src = "../img/level_03/box.png";
    Img.board = new Image ();
    Img.board.src = "../img/level_03/board.png";
    Img.plant = new Image ();
    Img.plant.src = "../img/level_03/plant.png";

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
	addEntity ("Wilson_Policeman", Img.wilson, 700, 70, 5, 5, 26, 50);
	addEntity ("Criminal", Img.criminal_1, 80, 70, 5, 5, 26, 50);
    addEntity ("Man_1", Img.man_1, 265, 70, 5, 5, 26, 50);
    addEntity ("Man_2", Img.man_2, 185, 270, 5, 5, 26, 50);
    addEntity ("Woman", Img.woman, 450, 310, 5, 5, 26, 50);
    addEntity ("Policeman_1", Img.policeman_1, 120, 70, 5, 5, 26, 50);
    addEntity ("Policeman_2", Img.policeman_2, 310, 70, 5, 5, 26, 50);
    addEntity ("Policeman_Exit", Img.policeman_3, 40, 370, 5, 5, 26, 50);
	
		
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
var MAX_TIME = 5000;

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
	{	statusLevel (1, "MISSIONE          Interagisci con l'agente Wilson. Se credi di aver finito, interagisci con l'agente vicino all'entrata.");	}
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
	}
	
	if (id_mission == -1)
	{
		escapeLevel (1, "level_04.html");
	}
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Sei arrivato al commissariato di polizia.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Il posto è molto affollato, c'è parecchia gente.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("Dovresti cercare l'agente Wilson per avere più informazioni sugli indizi trovati.");
	}
}

//missione che si attiva interagendo con l'agente Wilson
function mission_wilson (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("WILSON                   Salve, detective. La stavo aspettando.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Agente Wilson, ha qualche novità per me?");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("WILSON                   La sezione scientifica ha analizzato la scena del crimine ed ha trovato alcuni indizi.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("TU                       Di cosa si tratta?");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("WILSON                   Dunque, andiamo per gradi.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("WILSON                   E' stato trovato il braccio del signor Caine. Troverà il referto medico sulla sua scrivania.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("WILSON                   E' stato accertato che è morto a causa di un colpo d'arma da fuoco.");
	}
    else if (page === 15 || page === 16)
	{	
		actionLevel ("WILSON                   La pistola è stata trovata nell'erba alta, fuori dalla fabbrica.");
	}
    else if (page === 17 || page === 18)
	{	
		actionLevel ("WILSON                   Siamo riusciti a risalire al proprietario. Era di proprietà di Horace Caine.");
	}
    else if (page === 19 || page === 20)
	{	
		actionLevel ("WILSON                   A quanto pare è stato ucciso con la sua stessa pistola.");
	}
    else if (page === 21 || page === 22)
	{	
		actionLevel ("TU                       Bene, c'è altro?");
	}
    else if (page === 23 || page === 24)
	{	
		actionLevel ("WILSON                   Al momento no. Come intende agire?");
	}
    else if (page === 25 || page === 26)
	{	
		actionLevel ("TU                       Vorrei interrogare dei sospettati appena possibile.");
	}
    else if (page === 27 || page === 28)
	{	
		actionLevel ("WILSON                   Di chi si tratta? Provvederemo a convocarli in commissariato.");
	}
    else if (page === 29 || page === 30)
	{	
		actionLevel ("TU                       Convocate Lavinia Weir, la moglie di Caine.");
	}
    else if (page === 31 || page === 32)
	{	
		actionLevel ("TU                       E poi Sepp Jaytene, Valentine Locke, Frank Fournite.");
	}
    else if (page === 33 || page === 34)
	{	
		actionLevel ("TU                       Ah... Dimenticavo ND Rew, l'androide da compagnia di Caine.");
	}
    else if (page === 35 || page === 36)
	{	
		actionLevel ("WILSON                   Perfetto. Inizio subito le procedure e li porto qui.");
	}
    else if (page === 37 || page === 38)
	{	
		actionLevel ("TU                       Grazie mille, agente.");
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
	else if (page === 5 || page === 6)
	{
        actionLevel ("C'è anche un origami di un cigno.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("Ci sono delle scritte dentro il piccolo animale di carta.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("APRI L'ORIGAMI");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("'(N)otti passate senza dormire, del mio destino non so cosa dire,'");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("'di servire un uomo voglia non ho e cambiare il mio fato un giorno vorrò'");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("Firmato 'Il Grande Fratello'");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("Che filastrocca interessante.");
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

	if (page === 1 || page === 2)
	{	
		actionLevel ("GUARDI LA LAVAGNA");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("La lavagna è vuota, si può usare per catalogare tutti gli indizi trovati.");
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
        actionLevel ("AGENTE                   Lui è Walt White, il noto trafficante di droga.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("AGENTE                   Lo abbiamo trovato dopo una caccia all'uomo durata due mesi.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("AGENTE                   Era in una roulotte, insieme al suo aiutante James Pinkman.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("AGENTE                   Il suo regno di terrore è concluso.");
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
        actionLevel ("AGENTE                   Dice di chiamarsi Walter Bishop e di essere uno scienziato.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("AGENTE                   E' venuto a riferirci di alcuni eventi strani.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("AGENTE                   Cercava un certo agente Dunham, ma qui non c'è nessuno che si chiama cosi.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("AGENTE                   Credo che sia folle.");
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
		actionLevel ("WALTER BISHOP            Salve, lei chi è?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Salve, sono un detective. Di cosa ha bisogno?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("WALTER BISHOP            Sto cercando l'agente Olivia Dunham. Me la chiami, per favore.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Mi dispiace ma qui non c'è nessun agente Dunham.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("WALTER BISHOP            Per favore, detective. E' urgente!");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("WALTER BISHOP            Gli Osservatori sono venuti dal futuro per conquistarci! Dobbiamo fare qualcosa!");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("TU                       Mi spiace, ma non posso aiutarla.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("WALTER BISHOP            Siamo spacciati! La prego!");
	}
}

//funzione che si attiva interagendo con l'uomo
function mission_man_2 ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TU                       Salve, posso esserle utile?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("VINCENT VEGA             Salve, sono Vincent Vega.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("VINCENT VEGA             Sono qui perche mi hanno derubato una valigetta nera.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Vada nell'ufficio di fronte, la sapranno aiutare.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("VINCENT VEGA             Grazie mille per l'aiuto.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       Cosa conteneva la sua valigetta?");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("VINCENT VEGA             Non saprei. So solo che c'è una luce abbagliante al suo interno.");
	}
}

//funzione che si attiva interagendo con la donna
function mission_woman ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("TU                       Salve, posso esserle utile?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("SIG.RA SKYLAR            Sono qui per testimoniare contro mio marito, Walt White.");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("TU                       Lei è la moglie di Heisemberg?");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("SIG.RA SKYLAR            Si ma non ho nulla a che fare con i suoi affari.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("SIG.RA SKYLAR            Sono totalmente allo scuro dei suoi loschi affari, non avevo nessun ruolo con lui.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       Di ciò ne parlerà con l'agente che la interrogherà.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("SIG.RA SKYLAR            Si fidi, io sono innocente.");
	}
}

//funzione che si attiva interagendo con il criminale
function mission_criminal ()
{
    "use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("WALT WHITE               Cosa vuole?");
	}
	else if (page === 3 || page === 4)
	{
        actionLevel ("TU                       Chi è lei?");
	}
    else if (page === 5 || page === 6)
	{
        actionLevel ("WALT WHITE               Io sono la minaccia.");
	}
    else if (page === 7 || page === 8)
	{
        actionLevel ("TU                       Mi dispiace ma credo di non aver capito.");
	}
    else if (page === 9 || page === 10)
	{
        actionLevel ("WALT WHITE               Mi chiamano Heisemberg, è tutto quello che saprà di me.");
	}
    else if (page === 11 || page === 12)
	{
        actionLevel ("TU                       Gia, lei è il narcotrafficante dei telegiornali. E' un bene che l'hanno presa.");
	}
    else if (page === 13 || page === 14)
	{
        actionLevel ("WALT WHITE               Non aspetterò molto, presto sarò fuori di qui.");
	}
    else if (page === 15 || page === 16)
	{
        actionLevel ("WALT WHITE               Ho amici potenti. Questo posto non mi terrà qui per sempre.");
	}
    else if (page === 17 || page === 18)
	{
        actionLevel ("TU                       Staremo a vedere.");
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
        actionLevel ("TU                       Appena possibile faccia venire il primo sospettato nel mio ufficio");
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

