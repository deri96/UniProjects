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
	Img.map_layer_1.src = "../img/level_02/map_layer_1.png";
	Img.map_layer_2 = new Image ();
	Img.map_layer_2.src = "../img/level_02/map_layer_2.png";
	Img.wilson = new Image ();
	Img.wilson.src = "../img/characters/wilson.png";
	Img.policeman_1 = new Image ();
	Img.policeman_1.src = "../img/characters/policeman_1.png";
	Img.policeman_2 = new Image ();
	Img.policeman_2.src = "../img/characters/policeman_2.png";
	Img.policeman_3 = new Image ();
	Img.policeman_3.src = "../img/characters/policeman_3.png";
	Img.policeman_exit = new Image ();
	Img.policeman_exit.src = "../img/characters/policeman_1.png";
	Img.corpse = new Image ();
	Img.corpse.src = "../img/level_02/corpse.png";
	Img.nd_rew = new Image ();
	Img.nd_rew.src = "../img/characters/nd_rew_android.png";
	Img.machine_01 = new Image ();
	Img.machine_01.src = "../img/level_02/machine_01.png";
	Img.machine_02 = new Image ();
	Img.machine_02.src = "../img/level_02/machine_02.png";
	Img.machine_03 = new Image ();
	Img.machine_03.src = "../img/level_02/hydraulic_press.png";
	
	

var ObjectList = {};
	addObject ("Corpse", Img.corpse, 200, 80, 266, 100, " ");
	addObject ("Machine_01", Img.machine_01, 100, 380, 150, 410, " ");
	addObject ("Machine_02", Img.machine_02, 700, 100, 740, 120, " ");
	addObject ("Machine_03", Img.machine_03, 630, 320, 725, 365, " ");
	
var LayerList = {};
	addLevel (1, Img.map_layer_1, 0, 0);
	addLevel (2, Img.map_layer_2, 0, 0);
		
var EntityList = {};
	addEntity ("Player", Img.player, 730, 200, 5, 5, 26, 50);
	addEntity ("Wilson_Policeman", Img.wilson, 100, 200, 5, 5, 26, 50);
	addEntity ("Policeman_1", Img.policeman_1, 480, 250, 5, 5, 26, 50);
	addEntity ("Policeman_2", Img.policeman_2, 350, 180, 5, 5, 26, 50);
	addEntity ("Policeman_3", Img.policeman_3, 500, 80, 5, 5, 26, 50);
	addEntity ("Policeman_exit", Img.policeman_exit, 300, 350, 5, 5, 26, 50);
	addEntity ("ND Rew", Img.nd_rew, 700, 370, 5, 5, 26, 50);
		
var WallList = {};
	addWall (1, 20, 20, 135, 125);
	addWall (2, 20, 295, 130, 300);
	addWall (3, 185, 295, 235, 300);
	addWall (4, 220, 295, 235, 425);
	addWall (5, 530, 330, 545, 425);
	addWall (6, 540, 330, 560, 340);
	addWall (7, 615, 330, 780, 340);


	
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
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Corpse")			//collisioni delle entità con gli oggetti
			{	id_mission = 8; page = 1;	}
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Machine_01")			//collisioni delle entità con gli oggetti
			{	id_mission = 9; page = 1;	}
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Machine_02")			//collisioni delle entità con gli oggetti
			{	id_mission = 10; page = 1;	}
			if (objectCollision (EntityList[en], ObjectList[ob]) == "Machine_03")			//collisioni delle entità con gli oggetti
			{	id_mission = 11; page = 1;	}
			
		}
		for (var ent in EntityList)
		{
			if (en != ent)
			{	
				if (entityCollision (EntityList[en], EntityList[ent]) == "Wilson_Policeman")
				{	id_mission = 2;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_1")
				{	id_mission = 3;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_2")
				{	id_mission = 4;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_3")
				{	id_mission = 5;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "ND Rew")
				{	id_mission = 6;	page = 1;	}
				if (entityCollision (EntityList[en], EntityList[ent]) == "Policeman_exit")
				{	id_mission = 7;	page = 1;	}
				
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
	{	statusLevel (1, "MISSIONE          Interagisci con il livello. Se credi di aver finito, interagisci con l'agente biondo in fondo alla stanza.");	}
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
		{	mission_wilson (page);	}
		if (id_mission == 3)
		{	mission_policeman_1 (page);	}
		if (id_mission == 4)
		{	mission_policeman_2 (page);	}
		if (id_mission == 5)
		{	mission_policeman_3 (page);	}
		if (id_mission == 6)
		{	mission_ND_Rew (page);	}
		if (id_mission == 7)
		{	mission_policeman_exit (page);	}
		if (id_mission == 8)
		{	mission_corpse (page);	}
		if (id_mission == 9)
		{	mission_machine_01 (page);	}
		if (id_mission == 10)
		{	mission_machine_02 (page);	}
		if (id_mission == 11)
		{	mission_machine_03 (page);	}
	}
	
	if (id_mission == -1)
	{
		escapeLevel (1, "level_03.html");
	}
	
}

//funzione iniziale. Si può anche non farla
function mission_01 (page)
{
	"use strict";

	if (page === 1 || page === 2)
	{	
		actionLevel ("Sei arrivato alla vecchia fabbrica.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Qualche mese fa, questo posto era ancora in funzione, con centinaia di persone che ci lavoravano.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("Il proprietario, Horace Caine, decise all'improvviso di chiudere la struttura.");
	}
	else if (page === 7 || page === 8)
	{
		actionLevel ("Nessuno ha mai saputo il perchè.");
	}
}

//missione che si attiva interagendo con Wilson
function mission_wilson (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("WILSON                   Salve, detective. Io sono l'agente Wilson. Lieto di conoscerla.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("WILSON                   Il cadavere è poco più in la. Se vuole esaminarlo si avvicini pure. ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("WILSON                   Io sono appena arrivato, quindi sono poco informato.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("WILSON                   Se le dovesse servire qualcosa, chieda pure agli altri agenti.");
	}
}

//missione che si attiva interagendo con un agente
function mission_policeman_1 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Salve, detective. Mi dica pure.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Ha qualche informazione utile per me? ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("AGENTE                   Il cadavere del signor Caine è in fondo alla stanza.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("AGENTE                   Ha un grosso buco in fronte, sembra una ferita da arma da fuoco.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("AGENTE                   Ad occhio e croce, dovrebbe essere stato il proiettile di una pistola.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("AGENTE                   La sezione scientifica ci darà risultati più attendibili in merito.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("TU                       Grazie agente.");
	}
}

//missione che si attiva interagendo con un agente
function mission_policeman_2 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Buonasera, detective. Posso esserle utile?");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Ha qualche informazione utile per me? ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("AGENTE                   Il cadavere del signor Caine è in fondo alla stanza.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("AGENTE                   Ho notato che ha un braccio mancante.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("AGENTE                   Non so cosa o chi possa essere stato ma è stato decisamente brutale");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("AGENTE                   Il braccio non è stato ancora trovato. Chissà dove può essere finito.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("TU                       Grazie agente.");
	}
}

//missione che si attiva interagendo con un agente
function mission_policeman_3 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Detective. Cosa vuole?");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Ha qualche informazione utile per me? ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("AGENTE                   Il  cadavere del signor Caine è in fondo alla stanza.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("AGENTE                   Ha dei segni evidenti di colluttazione.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("AGENTE                   Inoltre ha dei lividi sul collo. Evidente prova di strozzamento.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("AGENTE                   Dovrebbe andare a vederlo con i suoi occhi invece di perder tempo parlando.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("TU                       Grazie agente.");
	}
}

//missione che si attiva interagendo con l'agente vicino all'entrata
function mission_policeman_exit (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("AGENTE                   Mi dica detective.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Ho concluso qui, ho preso abbastanza indizi. ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("AGENTE                   Perfetto. Dove l'accompagno?");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("TU                       Mi porti in centrale. Devo interrogare alcune persone.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("AGENTE                   Agli ordini, signore.");
	}
	else if (page === 11)
	{	
		id_mission = -1;
	}
}

//missione che si attiva interagendo con l'agente vicino all'entrata
function mission_ND_Rew (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("N.D. REW                 Lei è della polizia?");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("TU                       Si, sono un detective. Tu chi sei? ");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("N.D. REW                 Sono N.D. Rew, androide da lavoro. Modello Nexus6. Numero di serie 0132AD4B0.");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("TU                       Cosa ci fai qui?");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("N.D. REW                 Sono qui perchè il mio padrone ha voluto che rimanessi qui.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("TU                 	   Chi è il tuo padrone?");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("N.D. REW                 Il mio padrone era il signor Caine. E' davvero triste che lui sia morto.");
	}
	else if (page === 15 || page === 16)
	{	
		actionLevel ("TU                 	    I robot non possono provare emozioni. Tu non sei davvero triste.");
	}
	else if (page === 17 || page === 18)
	{	
		actionLevel ("N.D. REW                 Invece si, detective. Gli androidi del modello Nexus6 hanno un cervello positronico di ultima generazione.");
	}
	else if (page === 19 || page === 20)
	{	
		actionLevel ("N.D. REW                 Sono in grado di provare emozioni e sono identici agli umani. Se non fosse per la pelle blu.");
	}
	else if (page === 21 || page === 22)
	{	
		actionLevel ("TU                 	   Qual'era il tuo rapporto con il signor Caine?");
	}
	else if (page === 23 || page === 24)
	{	
		actionLevel ("N.D. REW                 Avevo una profonda amicizia con il signor Caine. Era davvero una brava persona.");
	}
	else if (page === 25 || page === 26)
	{	
		actionLevel ("TU                 	   Per ora è tutto. Non allontanarti dalla città. Dovrò interrogarti ancora.");
	}
	else if (page === 27 || page === 28)
	{	
		actionLevel ("N.D. REW                 Mi ritiene il colpevole?");
	}
	else if (page === 29 || page === 30)
	{	
		actionLevel ("TU                 	   Devo valutare tutte le variabili del caso. E tu non sei escluso.");
	}
	else if (page === 31 || page === 32)
	{	
		actionLevel ("N.D. REW                 Sono d'accordo, detective. Al nostro prossimo incontro.");
	}
}

//missione che si attiva interagendo con il cadavere
function mission_corpse (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("Ecco il cadavere.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("E' il signor Caine, l'ex proprietario della struttura.");
	}
	else if (page === 5 || page === 6)
	{
		actionLevel ("OSSERVI MINUZIOSAMENTE IL CORPO");
	}
	else if (page === 7 || page === 8)
	{	
		actionLevel ("Il braccio sinistro è mancante, strappato di netto.");
	}
	else if (page === 9 || page === 10)
	{	
		actionLevel ("Il collo ha dei segni lividi, qualcosa lo ha stretto.");
	}
	else if (page === 11 || page === 12)
	{	
		actionLevel ("Sul viso ci sono segni non molto profondi, ad eccezione di un foro.");
	}
	else if (page === 13 || page === 14)
	{	
		actionLevel ("C'è moltissimo sangue.");
	}
	else if (page === 15 || page === 16)
	{	
		actionLevel ("PRENDI IL CELLULARE DI CAINE");
	}
	else if (page === 17 || page === 18)
	{	
		actionLevel ("Un interessante reperto.");
	}
	else if (page === 19 || page === 20)
	{	
		actionLevel ("Ci sono quattro chiamate ricevute nelle ultime ore.");
	}
	else if (page === 21 || page === 22)
	{	
		actionLevel ("'Lavinia' alle 12:32.");
	}
	else if (page === 23 || page === 24)
	{	
		actionLevel ("'Valentine Locke' alle 17:40.");
	}
	else if (page === 25 || page === 26)
	{	
		actionLevel ("'Sepp Jaytene' alle 18:50.");
	}
	else if (page === 27 || page === 28)
	{	
		actionLevel ("'Frank Fourniet' alle 21:21.");
	}
	else if (page === 29 || page === 30)
	{	
		actionLevel ("Dovrò scoprirne di più. Devo interrogare queste persone.");
	}
}

//missione che si attiva interagendo con il cadavere
function mission_machine_01 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("Un macchinario di dubbio utilizzo. Probabilmente è malfunzionante.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Può essere stata questa cosa ad aver strappato il braccio di Caine?");
	}
}

//missione che si attiva interagendo con il cadavere
function mission_machine_02 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("Un nastro trasportatore usurato e vecchio. C'è una scatola che sembra contenere qualcosa. Può essere il braccio di Caine?");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Contiene solo bulloni, vecchi arnesi arrugginiti e robaccia varia.");
	}
	
}

//missione che si attiva interagendo con il cadavere
function mission_machine_03 (page)
{
	"use strict";
	
	if (page === 1 || page === 2)
	{	
		actionLevel ("Una pressa idraulica antiquata. Emette un rumore spaventoso.");
	}
	else if (page === 3 || page === 4)
	{
		actionLevel ("Può essere stata questa cosa ad aver strappato il braccio di Caine?");
	}
	
}

