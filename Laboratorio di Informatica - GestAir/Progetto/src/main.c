//**********************************************DESCRIZIONE DEL PROGRAMMA****************************************
/**
 * @file main.c
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 *  TRACCIA:
 *  Si vuole realizzare un sistema software per la gestione automatizzata della torre di controllo dell’aeroporto civile di Bari Palese.
 *  La torre di controllo consentirà ai controllori del traffico aereo di gestire i voli di linea in arrivo ed in partenza da Bari.
 *  Per ogni volo è necessario memorizzare le seguenti informazioni:
 *  1. Un codice identificativo formato da 2 lettere e 4 numeri (Esempio: FR7070) dove le prime due lettere rappresentano la compagnia aerea
 *  (Esempio: FR per Ryanair, AZ per Alitalia, ecc)
 *  2. Il nome della compagnia aerea
 *  3. L’aeromobile che a sua volta è identificato da:
 *  	a. Una targa che identifica univocamente l’aeromobile (6 lettere)
 *  	b. L’azienda produttrice del velivolo (Esempio: Boeing, Airbus, Embraer, ecc)
 *  	c. Modello dell’aeromobile (Esempio: 747-800, A320, ecc…)
 *  	d. Numero di motori
 *  	e. Il tipo di propulsione che può essere a elica (turboelica) o a getto (turboventola)
 *  	f. Numero massimo di passeggeri
 *  4. Il codice aeroportuale IATA dell’aeroporto da cui arriva o verso cui è diretto il volo (Esempio: FCO per Roma Fiumicino, TIA per Tirana Rinas, ecc…)
 *  	a. Codice aeroportuale di partenza, per i voli in arrivo
 *  	b. Codice aeroportuale di destinazione, per i voli in partenza
 *  5. Data e ora di partenza prevista come da carta di imbarco
 *  6. Data e ora di arrivo prevista come da carta di imbarco
 *  7. Il numero di passeggeri effettivamente a bordo dell’aeromobile
 *  8. Il gate di imbarco/sbarco dell’aeroporto di Bari (A1, A2, A3, A4, A5)
 *  All’avvio, il sistema deve:
 *  1. Caricare da file CSV le informazioni relative agli aeromobili che sono autorizzati ad atterrare e decollare dall’aeroporto di Bari.
 *  2. Caricare da file CSV le informazioni relative ai voli in partenza ed in arrivo nella giornata.
 *  Infine, il sistema deve consentire all’utente finale (il controllore del traffico aereo dell’aeroporto di Bari) di:
 *  1. Stampare a video la lista dei voli in arrivo ordinati per data arrivo prevista decrescente
 *  2. Stampare a video la lista dei voli in partenza ordinati per data arrivo prevista decrescente
 *  3. Stampare a video le informazioni di un volo a partire dal codice del volo
 *  4. Stampare a video le informazioni dell’aeromobile a partire dal codice del volo
 *  5. Eliminare un volo in partenza in caso di cancellazione del volo
 *  6. Modificare il gate di un volo a partire dal codice volo
 *  7. Gestire eventuali emergenze per cui un volo appena decollato deve fare ritorno all’aeroporto di bari e deve essere inserito nuovamente tra i voli in arrivo
 *
 *  Richieste aggiuntive:
 *  1. Autorizzare al decollo un volo in partenza a partire dal codice
 *  2. Autorizzare all’atterraggio un volo in arrivo a partire dal codice
 *  Nel momento in cui si effettuano queste operazioni, il sistema deve tenere traccia della data e ora effettiva in cui il velivolo è stato autorizzato dalla torre
 *  a decollare o atterrare (Si simuli questo comportamento aggiungendo un numero casuale tra [-10, 10] fingendo che ci possa essere un anticipo/ritardo di massimo
 *  10 minuti). Prima della chiusura del programma, si generi un file CSV contenente un log delle attività svolte durante la giornata.
 */


//****************************************INCLUSIONE DEI FILE HEADER CREATI**************************************
#include "main.h"
#include "gestione_dati.h"
#include "gestione_aeroporto.h"
#include "funzioni_varie.h"
#include "test.h"

//*******************************************PROGRAMMA PRINCIPALE************************************************
int main()
{
	//INIZIALIZZAZIONE DEL TEST REGISTRY--------------------------------------------------------------------------------------------------------------------
	if (CUE_SUCCESS != CU_initialize_registry())
	      return CU_get_error();

	//AGGIUNTA DELLE TEST SUITE AL TEST REGISTRY------------------------------------------------------------------------------------------------------------
	CU_pSuite Suite_gestione_dati = CU_add_suite ("Suite di gestione_dati.c", init_suite, clean_suite);
	CU_pSuite Suite_funzioni_varie = CU_add_suite ("Suite di funzioni_varie.c", init_suite, clean_suite);
	CU_pSuite Suite_gestione_aeroporto = CU_add_suite ("Suite di gestione_aeroporto.c", init_suite, clean_suite);

	//AGGIUNTA DEI TEST METHOD ALLE TEST SUITE--------------------------------------------------------------------------------------------------------------
	CU_add_test (Suite_gestione_dati, "Test di caricamento_info_modelli()", test_caricamento_info_modelli_aerei);
	CU_add_test (Suite_gestione_dati, "Test di caricamento_info_aeromobili()", test_caricamento_info_aeromobili);
	CU_add_test (Suite_gestione_dati, "Test di caricamento_info_voli()", test_caricamento_info_voli);
	CU_add_test (Suite_gestione_dati, "Test di caricamento_info_aeroporti()", test_caricamento_info_aeroporti);
	CU_add_test (Suite_gestione_dati, "Test di acquisizione_password()", test_acquisizione_password);

	CU_add_test (Suite_funzioni_varie, "Test di cambio_data_indietro()", test_cambio_data_indietro);
	CU_add_test (Suite_funzioni_varie, "Test di cambio_data_avanti()", test_cambio_data_avanti);

	CU_add_test (Suite_gestione_aeroporto, "Test di mergesort_data_per_arrivo()", test_mergesort_data_per_arrivo);
	CU_add_test (Suite_gestione_aeroporto, "Test di mergesort_data_per_partenza()", test_mergesort_data_per_partenza);
	CU_add_test (Suite_gestione_aeroporto, "Test di riconoscimento_aeroporto()", test_riconoscimento_aeroporto);

	//ESECUZIONE DEL TEST REGISTRY--------------------------------------------------------------------------------------------------------------------------
	CU_basic_set_mode(CU_BRM_VERBOSE);
	CU_basic_run_tests();
	system("PAUSE");

	//DEFINIZIONE DELLE VARIABILI----------------------------------------------------------------------------------------------------------------------------
	_MODELLO *modello;						//struttura dati modello di tipo _MODELLO
	_AEROMOBILE *aereo;						//struttura dati aereo di tipo _AEROMOBILE
	_VOLO *volo;							//struttura dati volo di tipo _VOLO
	_AEROPORTO *aeroporto;					//struttura dati aeroporto di tipo _AEROPORTO

	int numero_modelli = 0;					//contatore del numero dei modelli
	int numero_aerei = 0;					//contatore del numero di aerei
	int numero_voli = 0;					//contatore del numero di voli
	int numero_aeroporti = 0;				//contatore del numero di aeroporti

	long int password = 0;					//variabile per l'acquisizione della password da file
	long int password_inserita = 0;			//variabile per l'acquisizione della password da tastiera
	int tentativi = 3;						//contatore per il numero di tentativi di immissione della password

	string scelta_menu;						//stringa per la scelta del menu

	//ALLOCAZIONE DINAMICA DELLA MEMORIA---------------------------------------------------------------------------------------------------------------------
	//ALLOCAZIONE DINAMICA DELLA MEMORIA PER LA SCELTA DEL MENU PRINCIPALE
	scelta_menu = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));

	// ALLOCAZIONE DINAMICA DELLA MEMORIA PER IL MODELLO DEGLI AEREI
	modello = (_MODELLO*) malloc (MAX_NUMERO_MODELLI * sizeof(_MODELLO));
	for (int i = 0; i < MAX_NUMERO_MODELLI; i ++)
	{
		modello[i].azienda = (string) malloc (DIMENSIONE_NOME_AZIENDA_COSTRUTTRICE * sizeof(string));
		modello[i].modello = (string) malloc (DIMENSIONE_NOME_MODELLO_AEREO * sizeof(string));
	}

	// ALLOCAZIONE DINAMICA DELLA MEMORIA PER GLI AEREI
	aereo = (_AEROMOBILE*) malloc (MAX_NUMERO_AEROMOBILI * sizeof(_AEROMOBILE));
	for (int i = 0; i < MAX_NUMERO_AEROMOBILI; i ++)
	{
		aereo[i].modello = (string) malloc (DIMENSIONE_NOME_MODELLO_AEREO * sizeof(string));
		aereo[i].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
	}

	// ALLOCAZIONE DINAMICA DELLA MEMORIA PER I VOLI
	volo = (_VOLO*) malloc (MAX_NUMERO_VOLI * sizeof(_VOLO));
	for (int i = 0; i < MAX_NUMERO_VOLI; i ++)
	{
		volo[i].codice_id = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
		volo[i].nome_compagnia = (string) malloc (DIMENSIONE_NOME_COMPAGNIA_AEREA * sizeof(string));
		volo[i].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
		volo[i].gate = (string) malloc (DIMENSIONE_NOME_GATE * sizeof(string));
		volo[i].codice_iata = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
	}

	// ALLOCAZIONE DINAMICA DELLA MEMORIA PER I CODICI IATA
	aeroporto = (_AEROPORTO*) malloc (MAX_NUMERO_AEROPORTI * sizeof(_AEROPORTO));
	for (int i = 0; i < MAX_NUMERO_AEROPORTI; i ++)
	{
		aeroporto[i].codice = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
		aeroporto[i].nome = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	}

	//CARICAMENTO DEI DATI DAI FILE----------------------------------------------------------------------------------------------------------------------------
	srand(time(NULL));									//FUNZIONE DI ATTIVAZIONE DEI SEED CASUALI PRESI DALL'OROLOGIO DELL'ELABORATORE

	settaggio_schermo ();														//impostazioni per il settaggio dello schermo
	printf("CARICAMENTO IN CORSO... ATTENDERE PREGO.\n");
	caricamento_info_modelli_aerei (modello, &numero_modelli);					//caricamento dei modelli degli aerei dal file
	caricamento_info_aeromobili (aereo, &numero_aerei);							//caricamento delle informazioni degli aeromobili dal file
	caricamento_info_voli (volo, &numero_voli);									//caricamento delle informazioni dei voli dal file
	caricamento_info_aeroporti (aeroporto, &numero_aeroporti);					//caricamento delle informazioni degli aeroporti dal file
	password = acquisizione_password ();										//caricamento della password da file


	//MENU DEL PROGRAMMA--------------------------------------------------------------------------------------------------------------------------------------
	do
	{
		system("CLS");													//pulisci lo schermo
		stampa_menu_iniziale ();										//stampa il menu iniziale
		printf("INSERIMENTO:   ");
		gets(scelta_menu);												//prrendi la scelta da tastiera
		scelta_menu = converti_minuscolo(scelta_menu);					//converti la scelta in maiuscolo

		//GESTIONE DELLE TABELLE SUI VOLI E SUGLI AEROMOBILI---------------------------------------------------
		if (strcmp (scelta_menu, "tabella") == 0)						//se la parola è uguale a 'tabella'
		{
			do
			{
				system("CLS");
				stampa_menu_tabella_voli();										//stampa il menu dei voli
				printf("INSERIMENTO:   ");
				gets(scelta_menu);												//prendi la scelta da tastiera
				scelta_menu = converti_minuscolo(scelta_menu);					//converti la scelta in maiuscolo

				if (strcmp (scelta_menu, "arrivo") == 0)															//se la parola è uguale ad 'arrivo
				{
					system("CLS");
					stampa_lista_ordinata_voli_in_arrivo (volo, numero_voli, aeroporto, numero_aeroporti);				//stampa a video i risultati relativi al volo in arrivo
				}
				else if (strcmp (scelta_menu, "partenza") == 0)														//se la parola è uguale a 'partenza'
				{
					system("CLS");
					stampa_lista_ordinata_voli_in_partenza (volo, numero_voli, aeroporto, numero_aeroporti);		//stampa a video i risultati relativi al volo in partenza
				}
				else if (strcmp (scelta_menu, "codice") == 0)
				{
					system("CLS");
					stampa_volo_ricerca_per_codice (volo, numero_voli, aeroporto, numero_aeroporti);				//stampa a video i risultati del volo cercando per il codice
				}
				else if (strcmp (scelta_menu, "aereo") == 0)
				{
					system("CLS");
					stampa_aereo_ricerca_per_codice (volo, numero_voli, aeroporto, numero_aeroporti, aereo, numero_aerei, modello, numero_modelli);		//stampa a video i risultati dell'aereo cercando per il codice
				}
				else if (strcmp (scelta_menu, "esci tabella") == 0)						//esci dal menu 'tabella voli'
					break;
			} while (strcmp (scelta_menu, "esci tabella") != 0);
		}

		//GESTIONE DELL'AREA RISERVATA-----------------------------------------------------------------------
		else if (strcmp (scelta_menu, "riservata") == 0)				//se la parola è uguale a 'riservata'
		{
			int riuscita = 0;							//variabile flag per la riuscita autenticazione
			system("CLS");

			while (tentativi > 0 && riuscita == 0)					//finche i tentativi sono piu di 0 e non è stat ancora riuscita l'autenticazione...
			{
				printf("LA CHIAVE D'ACCESSO E' COMPOSTA DA SOLE CIFRE. L'IMMISSIONE DI UN\n");
				printf("CARATTERE COMPORTA IL BLOCCO PER L'AREA RISERVATA PER TALE SESSIONE.\n\n");
				printf("INSERISCI LA CHIAVE D'ACCESSO (%d TENTATIVI).\n", tentativi);
				printf("INSERIMENTO:     ");
				scanf("%ld", &password_inserita);						//inserisci la password
				system("CLS");
				if (password_inserita == password)						//e paragonala con quella salvata da file. Se è uguale...
				{
					do
					{
						system("CLS");
						riuscita = 1;					//imposti il flag a 1

						stampa_menu_area_riservata();					//stampi il menu
						printf("INSERIMENTO:   ");
						gets(scelta_menu);												//prrendi la scelta da tastiera
						scelta_menu = converti_minuscolo(scelta_menu);					//converti la scelta in maiuscolo

						if (strcmp (scelta_menu, "cancella") == 0)					//se la scelta è 'cancella' vai nel menu di cancellazione dei voli
						{
							system("CLS");
							cancellazione_volo (volo, numero_voli, aeroporto, numero_aeroporti);
						}

						if (strcmp (scelta_menu, "gate") == 0)					//se la scelta è 'gate' vai nel menu di modifica del gate
						{
							system("CLS");
							modifica_gate (volo, numero_voli, aeroporto, numero_aeroporti);
						}

						if (strcmp (scelta_menu, "emergenza") == 0)					//se la scelta è 'emergenza' vai nel menu di gestione delle emergenze
						{
							system("CLS");
							gestione_emergenze (volo, numero_voli);
						}

						if (strcmp (scelta_menu, "autorizza") == 0)					//se la scelta è 'autorizza' vai nel menu di autorizzazione
						{
							system("CLS");
							autorizzazione_voli(volo, numero_voli);
						}

						if (strcmp (scelta_menu, "esci riservata") == 0)					//se la scelta è 'esci riservaya'
							break;															//non fai nulla

					} while (strcmp (scelta_menu, "esci riservata") != 0);				//continua il ciclo finche non scrivi 'esci riservata'

				}
				else if (password_inserita != password)						//se la password non è corretta
				{
						tentativi --;									//scala i tentativi
						printf("PASSWORD ERRATA.\n");
				}
			}
			if (tentativi == 0)					//se i tentativi arrivano a 0 hai finito le opportunità per immetterne altre
			{
				printf("TENTATIVI TERMINATI.\nPER QUESTA SESSIONE NON POTRAI ACCEDERE ALL'AREA RISERVATA\n");
				system("PAUSE");
			}
		}

		//GESTIONE DELL'USCITA DAL PROGRAMMA------------------------------------------------------------
		else if (strcmp (scelta_menu, "esci") == 0)						//se la parola è uguale a 'esci'
			break;														//non fare nulla

	} while (strcmp (scelta_menu, "esci") != 0);						//finche la parola è uguale ad esci

	//SVUOTAMENTO DELLA MEMORIA ALLOCATA DINAMICAMENTE----------------------------------------------------------------------------------------------------
	free (modello);			//libera la memoria allocata per modello e per i suoi sottocampi
	free (aereo);			//libera la memoria allocata per aereo e per i suoi sottocampi
	free (volo);			//libera la memoria allocata per volo e per i suoi sottocampi
	free (aeroporto);		//libera la memoria allocata per aeroporto e per i suoi sottocampi
	free (scelta_menu);		//libera la memoria allocata per la scelta del menu

	//CHIUSURA DEL PROGRAMMA-------------------------------------------------------------------------------------------------------------------------------
	creazione_log(volo, numero_voli);				//creazione del file di log
	remove ("gest/voli.csv");						//cancellazione del file voli.csv

	printf ("GRAZIE PER AVER UTILIZZATO QUESTO PROGRAMMA!\n");
	printf ("UN FILE DI LOG E' STATO CREATO NELLA CARTELLA log\n");
	printf ("IL FILE voli.csv VERRA' ELIMINATO PER MOTIVI DI SICUREZZA.\n");
	getchar();

	//CHIUSURA DEL TEST REGISTRY--------------------------------------------------------------------------------------------------------------------------
	CU_cleanup_registry();
	return CU_get_error();
}
//***********************************FINE DEL PROGRAMMA PRINCIPALE********************************************






