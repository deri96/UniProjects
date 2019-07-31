/**
 * @file gestione_aeroporto.c
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 *  Contenuto:
 *  Questo file sorgente contiene tutte le funzioni necessarie per la gestione dei dati
 *  dell'aeroporto (per esempio la cancellazione dei volo, la visualizzazione
 *  delle tabelle dei voli, ecc.)
 */


#include "main.h"
#include "gestione_aeroporto.h"
#include "funzioni_varie.h"

/**
 * Stampa dei vari voli in partenza all'aereoporto in ordine decrescente in base al loro approdo.
 * La funzione prima ordina tutti i dati chiamndo la funzione 'mergesort_data_per_arrivo()' e, successivamente, effettua
 * un controllo: se il volo è in partenza (quindi denominato con la lettera 'p') allora lo si stampa con tutte le
 * relative informazioni.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 */
void stampa_lista_ordinata_voli_in_partenza (_VOLO* volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti)
{
	int i = 0;						//indice del ciclo
	string destinazione;			//stringa per la definizione della destinazione dell'aereo
	string scelta;					//stringa per la definizione della scelta del menu

	//ALLOCAZIONE DELLE STRINGHE
	destinazione = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));

	mergesort_data_per_arrivo (volo, 0, numero_voli - 1);				//richiama la funzione mergesort per l'ordinamento dei voli

	do
	{
		if (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P')			//e se il volo è in partenza
		{
			printf ("-----------------------TABELLA DEI VOLI IN PARTENZA------------------------\n\n");				//stampa tutti i dati del volo
			printf ("CODICE VOLO:   \t\t\t\t%s\n", volo[i].codice_id);
			printf ("TARGA VELIVOLO:   \t\t\t%s\nCOMPAGNIA AEREA:   \t\t\t%s\n", volo[i].targa, volo[i].nome_compagnia);
			printf ("DESTINAZIONE:   \t\t\t%s\n", destinazione = riconoscimento_aeroporto (volo[i].codice_iata, aeroporto, numero_aeroporti));
			if (volo[i].cancellato == 'n')
			{
				printf ("DATA ED ORA DI PARTENZA: \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno, volo[i].partenza.ora, volo[i].partenza.minuto);
				printf ("DATA ED ORA DI ARRIVO:   \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].arrivo.giorno, volo[i].arrivo.mese, volo[i].arrivo.anno, volo[i].arrivo.ora, volo[i].arrivo.minuto);
				printf ("NUMERO PASSEGGERI:   \t\t\t%d\nGATE D'IMBARCO:   \t\t\t%s\n\n", volo[i].numero_passeggeri, volo[i].gate);

				if (volo[i].autorizzato == 's' || volo[i].autorizzato == 'S')
					printf("VOLO AUTORIZZATO. IN PARTENZA ALLE %.2d:%.2d.\n\n\n", volo[i].effettiva.ora, volo[i].effettiva.minuto);			//se il volo è autorizzato dai un messaggio
				else if (volo[i].autorizzato == 'n' || volo[i].autorizzato == 'N')
					printf("VOLO NON ANCORA AUTORIZZATO.\n\n\n");										//altrimenti danne un altro

			}
			else if (volo[i].cancellato == 's' || volo[i].cancellato == 'S')					//se il volo è cancellato dai un messaggio
				printf("\t\t\t\n\n\nVOLO CANCELLATO\n\n\n\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf ("| prossimo | esci tabella |\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf("INSERIMENTO:   ");

			gets(scelta);
			scelta = converti_minuscolo (scelta);					//converti in minuscolo la stringa
			system("CLS");
			if (strcmp(scelta, "prossimo") == 0)					//se la stringa immessa è 'prossimo' allora incrementa l'indice
				i ++;

		}
		else											//se il volo nonè in partenza allor a incrementa l'indice
			i ++;
		if (i == numero_voli)
			i = 0;

	} while (strcmp (scelta, "esci tabella") != 0);							//finche non si scrive 'esci tabella'

	//libera la memoria allocata dinamicamente
	free(destinazione);
	free(scelta);
}

/**
 * Stampa dei vari voli in arrivo all'aereoporto in ordine decrescente in base al loro approdo.
 * La funzione prima ordina tutti i dati chiamndo la funzione 'mergesort_data_per_arrivo()' e, successivamente, effettua
 * un controllo: se il volo è in partenza (quindi denominato con la lettera 'a') allora lo si stampa con tutte le
 * relative informazioni.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 */
void stampa_lista_ordinata_voli_in_arrivo (_VOLO* volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti)
{
	int i = 0;						//indice del ciclo
	string provenienza;				//stringa per la definizione della provenienza dell'aereo
	string scelta;					//stringa per la definizione della scelta del menu

	//ALLOCAZIONE DELLLE STRINGHE
	provenienza = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));

	mergesort_data_per_arrivo (volo, 0, numero_voli - 1);				//richiama la funzione mergesort per l'ordinamento dei voli

	do
	{
		if (volo[i].partenza_arrivo == 'a' || volo[i].partenza_arrivo == 'A')			//e se il volo è in arrivo
		{
			printf ("------------------------TABELLA DEI VOLI IN ARRIVO-------------------------\n\n");
			printf ("CODICE VOLO:   \t\t\t\t%s\n", volo[i].codice_id);							//stampa tutti i dati del volo
			printf ("TARGA VELIVOLO:   \t\t\t%s\nCOMPAGNIA AEREA:   \t\t\t%s\n", volo[i].targa, volo[i].nome_compagnia);
			printf ("PROVENIENTE DA:   \t\t\t%s\n", provenienza = riconoscimento_aeroporto (volo[i].codice_iata, aeroporto, numero_aeroporti));
			printf ("DATA ED ORA DI PARTENZA: \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno, volo[i].partenza.ora, volo[i].partenza.minuto);
			printf ("DATA ED ORA DI ARRIVO:   \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].arrivo.giorno, volo[i].arrivo.mese, volo[i].arrivo.anno, volo[i].arrivo.ora, volo[i].arrivo.minuto);
			printf ("NUMERO PASSEGGERI:   \t\t\t%d\nGATE D'IMBARCO:   \t\t\t%s\n\n", volo[i].numero_passeggeri, volo[i].gate);

			if (volo[i].emergenza == 's' || volo[i].emergenza == 'S')
				printf("ATTENZIONE! ATTERRAGGIO DI EMERGENZA IN BARI-PALESE.\n\n");
			if (volo[i].autorizzato == 's' || volo[i].autorizzato == 'S')
				printf("VOLO AUTORIZZATO. IN ARRIVO ALLE %.2d:%.2d.\n\n\n", volo[i].effettiva.ora, volo[i].effettiva.minuto);			//se il volo è autorizzato dai un messaggio
			else if (volo[i].autorizzato == 'n' || volo[i].autorizzato == 'N')
				printf("VOLO NON ANCORA AUTORIZZATO.\n\n\n");										//altrimenti danne un altro

			printf ("---------------------------------------------------------------------------\n\n");
			printf ("| prossimo | esci tabella |\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf("INSERIMENTO:   ");

			gets(scelta);
			scelta = converti_minuscolo (scelta);					//converti in minuscolo la stringa
			system("CLS");
			if (strcmp(scelta, "prossimo") == 0)					//se la stringa immessa è 'prossimo' allora incrementa l'indice
				i ++;
		}
		else									//se il volo non è in arrivo allora incrementa l'indice
			i ++;

		if (i == numero_voli)
			i = 0;
	} while (strcmp (scelta, "esci tabella") != 0);							//finche non si scrive 'esci tabella'

	//libera la memoria allocata dinamicamente
	free (provenienza);
	free (scelta);
}

/**
 * Ordinamento dei voli.
 * Tale funzione ordina i voli in ordine decrescente sulla base della informazioni riguardo
 * la data d'arrivo prevista all'aereoporto. Utilizza un algoritmo merge sort ovvero spezza l'array di
 * strutture in tanti altri piccoli array e successivamente le ordina in un altro array di appoggio.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param sinistra Variabile per l'individuazione del primo elemento a partire da sinistra dell'array di strutture spezzato.
 * @param destra Variabile per l'individuazione dell'ultimo elemento a partire da sinistra dell'array di strutture spezzato.
 */
void mergesort_data_per_arrivo (_VOLO *volo, int sinistra, int destra)
{
	int centro;						//variabile per l'individuazione del centro dell'array

	if (sinistra < destra)					//se l'array spezzettato preso in esame non è unitario
	{
		centro = (sinistra + destra) / 2;							//trova il centro dell'array
		mergesort_data_per_arrivo (volo, sinistra, centro);			//spezza l'array in due parti: una che va dal valore 'sinistra' al centro...
		mergesort_data_per_arrivo (volo, centro + 1, destra);		//...e l'altro che va dal valore successivo al centro al valore finale 'destra'
		merge_data_per_arrivo (volo, sinistra, centro, destra);		//successivamente ordina l'array secondo il merge, ovvero confronta gli elementi ad uno ad uno e gli copia nell'array
	}
}

/**
 * Ordinamento degli array spezzati di strutture.
 * Utilizza l'algoritmo merge sort per ordinare gli elementi,ovvero spezza la
 * struttura in tante altre piccole strutture e successivamente le ordina in un altro array di appoggio.
 * Infine, copia l'array di appoggio nell'array di strutture finale riordinando cosi gli spezzoni di array.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param sinistra Variabile per l'individuazione del primo elemento a partire da sinistra dell'array di strutture spezzato.
 * @param centro Variabile per l'individuazione dell'elemento centrale dell'array di strutture.
 * @param destra Variabile per l'individuazione dell'ultimo elemento a partire da sinistra dell'array di strutture spezzato.
 */
void merge_data_per_arrivo (_VOLO *volo, int sinistra, int centro, int destra)
{
	int i;				//variabili indici
	int j;
	int k;
	_VOLO *appoggio;				//variabile di tipo _VOLO di appoggio

	//ALLOCAZIONE DELLA VARIABILE D'APPOGGIO
	appoggio = (_VOLO*) malloc (MAX_NUMERO_VOLI * sizeof(_VOLO));
	for (int indice = 0; indice < MAX_NUMERO_VOLI; indice ++)
	{
		appoggio[indice].codice_id = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
		appoggio[indice].nome_compagnia = (string) malloc (DIMENSIONE_NOME_COMPAGNIA_AEREA * sizeof(string));
		appoggio[indice].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
		appoggio[indice].gate = (string) malloc (DIMENSIONE_NOME_GATE * sizeof(string));
		appoggio[indice].codice_iata = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
	}

	i = sinistra;				//l'indice i è pari all'indice del valore di 'sinistra'
	j = centro + 1;				//l'indice j è pari all'indice del valore successivo del centro
	k = 0;

	 while (i <= centro && j <= destra)					//se l'indice i è minore dell'indice del valore di centro
	 {
		 if (volo[i].arrivo.data_estesa > volo[j].arrivo.data_estesa)		//e se la data dell'arrivo del volo con indice i è piu recente di quello di indice j
		 {
			 appoggio[k] = volo[i];					//inserisci nella struttura di appoggio la struttura 'volo' ad indice i
			 i ++;
		 }
		 else
		 {
			 appoggio[k] = volo[j];					//altrimenti inserisci quella con indice j
			 j ++;
		 }
		 k ++;					//incrementa l'indice della struttura di appoggio
	 }
	 while (i <= centro)				//finche l'indice i è minore o uguale all'indice del valore di centro
	 {
		 appoggio[k] = volo[i];					//inserisci nella struttura di appoggio la struttura 'volo' ad indice i
		 i ++;
		 k ++;
	 }
	 while (j <= destra)				//finche l'indice j è minore o uguale all'indice del valore finale
	 {
		 appoggio[k] = volo[j];				//inserisci nella struttura di appoggio la struttura 'volo' ad indice j
		 j ++;
		 k ++;
	 }
	 for (k = sinistra; k <= destra; k++)				//infine copia tutta la struttura 'appoggio' in quella principale
		 volo[k] = appoggio[k - sinistra];

	 free(appoggio);				//libera la memoria occupata dinamicamente dalla struttura 'appoggio'
}

/**
 * Ordinamento dei voli.
 * Tale funzione ordina i voli in ordine decrescente sulla base della informazioni riguardo
 * la data di partenza prevista all'aereoporto. Utilizza un algoritmo merge sort ovvero spezza l'array di
 * strutture in tanti altri piccoli array e successivamente le ordina in un altro array di appoggio.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param sinistra Variabile per l'individuazione del primo elemento a partire da sinistra dell'array di strutture spezzato.
 * @param destra Variabile per l'individuazione dell'ultimo elemento a partire da sinistra dell'array di strutture spezzato.
 */
void mergesort_data_per_partenza (_VOLO *volo, int sinistra, int destra)
{
	int centro;						//variabile per l'individuazione del centro dell'array

	if (sinistra < destra)					//se l'array spezzettato preso in esame non è unitario
	{
		centro = (sinistra + destra) / 2;							//trova il centro dell'array
		mergesort_data_per_partenza (volo, sinistra, centro);			//spezza l'array in due parti: una che va dal valore 'sinistra' al centro...
		mergesort_data_per_partenza (volo, centro + 1, destra);		//...e l'altro che va dal valore successivo al centro al valore finale 'destra'
		merge_data_per_partenza (volo, sinistra, centro, destra);		//successivamente ordina l'array secondo il merge, ovvero confronta gli elementi ad uno ad uno e gli copia nell'array
	}
}

/**
 * Ordinamento degli array spezzati di strutture.
 * Utilizza l'algoritmo merge sort per ordinare gli elementi,ovvero spezza la
 * struttura in tante altre piccole strutture e successivamente le ordina in un altro array di appoggio.
 * Infine, copia l'array di appoggio nell'array di strutture finale riordinando cosi gli spezzoni di array.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param sinistra Variabile per l'individuazione del primo elemento a partire da sinistra dell'array di strutture spezzato.
 * @param centro Variabile per l'individuazione dell'elemento centrale dell'array di strutture.
 * @param destra Variabile per l'individuazione dell'ultimo elemento a partire da sinistra dell'array di strutture spezzato.
 */
void merge_data_per_partenza (_VOLO *volo, int sinistra, int centro, int destra)
{
	int i;							//variabili per gli indici
	int j;
	int k;
	_VOLO *appoggio;				//variabile di tipo _VOLO di appoggio

	//ALLOCAZIONE DELLA VARIABILE D'APPOGGIO
	appoggio = (_VOLO*) malloc (MAX_NUMERO_VOLI * sizeof(_VOLO));
	for (int indice = 0; indice < MAX_NUMERO_VOLI; indice ++)
	{
		appoggio[indice].codice_id = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
		appoggio[indice].nome_compagnia = (string) malloc (DIMENSIONE_NOME_COMPAGNIA_AEREA * sizeof(string));
		appoggio[indice].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
		appoggio[indice].gate = (string) malloc (DIMENSIONE_NOME_GATE * sizeof(string));
		appoggio[indice].codice_iata = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
	}

	i = sinistra;				//l'indice i è pari all'indice del valore di 'sinistra'
	j = centro + 1;				//l'indice j è pari all'indice del valore successivo del centro
	k = 0;

	 while (i <= centro && j <= destra)					//se l'indice i è minore dell'indice del valore di centro
	 {
		 if (volo[i].partenza.data_estesa < volo[j].partenza.data_estesa)		//e se la data dell'arrivo del volo con indice i è piu recente di quello di indice j
		 {
			 appoggio[k] = volo[i];					//inserisci nella struttura di appoggio la struttura 'volo' ad indice i
			 i ++;
		 }
		 else
		 {
			 appoggio[k] = volo[j];					//altrimenti inserisci quella con indice j
			 j ++;
		 }
		 k ++;					//incrementa l'indice della struttura di appoggio
	 }
	 while (i <= centro)				//finche l'indice i è minore o uguale all'indice del valore di centro
	 {
		 appoggio[k] = volo[i];					//inserisci nella struttura di appoggio la struttura 'volo' ad indice i
		 i ++;
		 k ++;
	 }
	 while (j <= destra)				//finche l'indice j è minore o uguale all'indice del valore finale
	 {
		 appoggio[k] = volo[j];				//inserisci nella struttura di appoggio la struttura 'volo' ad indice j
		 j ++;
		 k ++;
	 }
	 for (k = sinistra; k <= destra; k++)				//infine copia tutta la struttura 'appoggio' in quella principale
		 volo[k] = appoggio[k - sinistra];

	 free(appoggio);				//libera la memoria occupata dinamicamente dalla struttura 'appoggio'
}


/**
 * Funzione per il riconoscimento della destinazione/provenienza dell'aereo.
 * Tale funzione determina, inserendo il codice IATA del volo, la provenienza o la destinazione
 * dell'aereo, cercando tra la lista di aeroporti il conìdice associato alla città dell'aeroporto.
 *
 * @param codice_da_cercare Variabile di tipo string che determina il codice IATA da ricercare.
 * @param aeroporto Struttura dati comprendente le istruzioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio del numero degli aeroporti.
 * @return nome_aeroporto il valore della stringa associata al codice inserito in input
 */
string riconoscimento_aeroporto (string codice_da_cercare, _AEROPORTO *aeroporto, const int numero_aeroporti)
{
	string nome_aeroporto;				//stringa per la definizione del nome dell'aeroporto

	//ALLOCAZIONE DELLA STRINGA
	nome_aeroporto = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));

	for (int i = 0; i < numero_aeroporti; i ++)
	{
		while ((strcmp (codice_da_cercare, aeroporto[i].codice) == 0))				//cerca per tutta la lista e quando si trova una corrispondenza con il codice IATA dell'aeroporto
		{
			strcpy (nome_aeroporto, aeroporto[i].nome);						//si definisce il nome
			i ++;
		}
	}
	return nome_aeroporto;

	//libera la memoria allocata dinamicamente
	free (nome_aeroporto);
}


/**
 * Funzione per la stampa a video del volo partendo dal codice.
 * Questa funzione permette la stampa a video di un volo tramite l'inserimento del suo
 * codice: inserendolo, si va a ricercare tra tutti i voli disponibili quello con
 * lo stesso codice di quello immesso e si mostrano le statistiche dello stesso.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 */
void stampa_volo_ricerca_per_codice (_VOLO *volo, const int numero_voli, _AEROPORTO* aeroporto, const int numero_aeroporti)
{
	const int DIMENSIONE_SCELTA = 2;					//definizione della costante della dimensione della scelta
	string codice_da_cercare;							//stringa relativa al codice da ricercare
	string scelta;										//stringa relativa alla scelta da menu
	string provenienza;									//stringa relativa alla provenienza del volo
	int trovato;										//variabile flag per indicazione di ritrovamento

	provenienza = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));					//ALLOCAZIONE DELLE VARIE STRINGHE
	codice_da_cercare = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_SCELTA * sizeof(string));

	do
	{
		system("CLS");
		trovato = 0;															//azzeramento del flag di ricerca del volo
		printf ("------------------------RICERCA DEI VOLI PER CODICE------------------------\n\n");
		printf ("\n\n\nINSERISCI IL CODICE DI VOLO DA CERCARE (2 LETTERE E 4 CIFRE).\n\n\n");
		printf ("---------------------------------------------------------------------------\n\n");
		printf ("INSERISCI:     ");
		gets(codice_da_cercare);												//inserimento del codice da cercare
		codice_da_cercare = converti_maiuscolo (codice_da_cercare);				//conversione in maiuscolo del codice

		do						//immetti la scelta se si vuole continuare a cercare fino a quando si inserisce o 'si' o 'no'
		{
			system("CLS");
			printf ("------------------------RICERCA DEI VOLI PER CODICE------------------------\n\n");
			for (int i = 0; i < numero_voli; i ++)
			{
				if (strcmp (volo[i].codice_id, codice_da_cercare) == 0)				//se c'è un riscontro di un volo esistente stampa i dati di quest'ultimo
				{
					printf ("INFORMAZIONI SUL VOLO:\n\n");
					printf ("CODICE VOLO:   \t\t\t\t%s\n", volo[i].codice_id);							//stampa tutti i dati del volo
					printf ("TARGA VELIVOLO:   \t\t\t%s\nCOMPAGNIA AEREA:   \t\t\t%s\n", volo[i].targa, volo[i].nome_compagnia);
					printf ("PROVENIENTE DA:   \t\t\t%s\n", provenienza = riconoscimento_aeroporto (volo[i].codice_iata, aeroporto, numero_aeroporti));
					printf ("DATA ED ORA DI PARTENZA: \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno, volo[i].partenza.ora, volo[i].partenza.minuto);
					printf ("DATA ED ORA DI ARRIVO:   \t\t%.2d/%.2d/%.4d  ORE %.2d.%.2d\n", volo[i].arrivo.giorno, volo[i].arrivo.mese, volo[i].arrivo.anno, volo[i].arrivo.ora, volo[i].arrivo.minuto);
					printf ("NUMERO PASSEGGERI:   \t\t\t%d\nGATE D'IMBARCO:   \t\t\t%s\n\n\n", volo[i].numero_passeggeri, volo[i].gate);
					printf ("---------------------------------------------------------------------------\n\n");
					trovato = 1;
				}
			}

			if (trovato == 0)										//se nulla è stato trovato dai un messaggio di non ritrovamento
			{
				printf ("\n\n\nCODICE NON TROVATO. \nVERIFICA SE E' STATO SCRITTO IN MODO CORRETTO (2 NUMERI E 4 CARATTERI).\n\n\n");
				printf ("---------------------------------------------------------------------------\n\n");
			}


			printf("VUOI CONTINUARE A RICERCARE ALTRI VOLI?\n SI   NO\n\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf("INSERIMENTO:   ");
			gets(scelta);
			scelta = converti_minuscolo(scelta);
		} while (strcmp(scelta, "si") != 0 && strcmp(scelta, "no") != 0);

	} while (strcmp(scelta, "si") == 0);					//continua tutto il ciclo di ricerca e di immissione del codice da cercare fino a quando non verra inserito un 'no'

	//libera la memoria allocata dinamicamente
	free(provenienza);
	free(codice_da_cercare);
	free(scelta);
}

/**
 * Funzione per la stampa a video dell'aeromobile partendo dal codice.
 * Questa funzione permette la stampa a video delle informazioni relative all'aeromobile di
 * un determinato volo: si inserisce dapprima il codice del volo, si cerca tra tutti i
 * voli disponibili se c'è una corrispondenza, si prende in esame il modello dell'aereo
 * utilizzato nel volo e lo si compara con una lista di aereomobili. Quando si trova
 * il modello dell'aereo nella lista allora si stampano tutte le caratteristiche
 * tecniche del velivolo.
 *
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 * @param aereo Struttura dati comprendente le informazioni relative agli aerei
 * @param numero_aerei Variabile per il conteggio dei numeri degli aerei
 * @param modello Struttura dati camprendente le informazione relative ai modelli degli aerei
 * @param numero_modelli Variabile per il conteggio dei modelli degli aerei presenti in lista
 */
void stampa_aereo_ricerca_per_codice (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti, _AEROMOBILE *aereo, const int numero_aerei,
		_MODELLO *modello, const int numero_modelli)
{
	const int DIMENSIONE_SCELTA = 2;					//definizione della costante della dimensione della scelta
	string codice_da_cercare;							//stringa relativa al codice da ricercare
	string scelta;										//stringa relativa alla scelta da menu
	string targa;										//stringa d'appoggio per la targa
	string model;										//stringa d'appoggio per il modello
	int trovato;										//variabile flag per indicazione di ritrovamento
	int i = 0, j = 0, k = 0;							//indici per i cicli

	targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));					//ALLOCAZIONE DELLE VARIE STRINGHE
	model = (string) malloc (DIMENSIONE_NOME_MODELLO_AEREO * sizeof(string));
	codice_da_cercare = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_SCELTA * sizeof(string));

	do
	{
		system("CLS");
		printf ("------------------RICERCA DEL TIPO DI AEREO PER CODICE---------------------\n\n");															//azzeramento del flag di ricerca del volo
		printf ("\n\n\nINSERISCI IL CODICE DI VOLO DELL'AEROMOBILE DA CERCARE (2 LETTERE E 4 CIFRE).\n\n\n");
		printf ("---------------------------------------------------------------------------\n\n");
		printf ("INSERIMENTO:     ");
		gets(codice_da_cercare);												//inserimento del codice da cercare
		codice_da_cercare = converti_maiuscolo (codice_da_cercare);				//conversione in maiuscolo del codice

		do						//immetti la scelta se si vuole continuare a cercare fino a quando si inserisce o 'si' o 'no'
		{
			i = 0;							//azzera indici e flag
			j = 0;
			k = 0;
			trovato = 0;
			system("CLS");
			printf ("------------------RICERCA DEL TIPO DI AEREO PER CODICE---------------------\n\n");

			while (i < numero_voli && trovato != 1)									//finche l'indice i è minore del numero dei voli e il modello non è stato trovato
			{
				if (strcmp (volo[i].codice_id, codice_da_cercare) == 0)				//se c'è un riscontro di un volo esistente ...
				{
					strcpy(targa, volo[i].targa);									//copia la sua targa nella variabile 'targa'

					while (j < numero_aerei && trovato != 1)						//finche l'indice j è minore del numero degli aerei e il modello non è stato trovato
					{
						if (strcmp(aereo[j].targa, targa) == 0)						//scorrendo l'indice j, se si ha un riscontro tra la targa dell'aereo e quella nella variabile 'targa'
						{
							strcpy(model, aereo[j].modello);						//copia il modello nella variabile 'model'
							while (k < numero_modelli && trovato != 1)				//finche l'indice k è minore del numero dei modelli e il modello non è stato trovato
							{
								if (strcmp(model, modello[k].modello) == 0)				//scorrendo l'indice j, se si ha un riscontro tra il modello dell'aereo e la variabile 'model'...
								{
									printf("INFORMAZIONI DELL'AEROMOBILE:\n");									//stampa tutte le informazione dell'aeromobile a video
									printf("AZIENDA COSTRUTTRICE:   \t\t\t%s\n", modello[k].azienda);
									printf("MODELLO DI AEROMOBILE:   \t\t\t%s\n", modello[k].modello);
									printf("NUMERO DI PROPULSORI:   \t\t\t%d\n", modello[k].numero_motori);
									if (modello[k].propulsore == 'g')
										printf("TIPO DI PROPULSORE:   \t\t\t\tTurbogetto\n");
									else if (modello[k].propulsore == 'e')
										printf("TIPO DI PROPULSORE:   \t\t\t\tTurboelica\n");
									printf("NUMERO DI MOTORI:   \t\t\t\t%d\n", modello[k].numero_motori);
									printf("NUMERO DI POSTI DISPONIBILI:   \t\t\t%d\n\n", modello[k].numero_massimo_passeggeri);
									printf ("---------------------------------------------------------------------------\n\n");
									trovato = 1;									//setta il flag trovato a uno
								}
								k ++;												//incrementa l'indice k per la ricerca del modello
							}
						}
						j ++;														//incrementa l'indice j per la ricerca dell'aereo
					}
				}
				i ++;																//incrementa l'indice i per la ricerca del volo
			}

			if (trovato == 0)										//se nulla è stato trovato, dai un messaggio di non ritrovamento
			{
				printf("\n\n\nCODICE NON TROVATO. \nVERIFICA SE E' STATO SCRITTO IN MODO CORRETTO (2 NUMERI E 4 CARATTERI).\n\n\n");
				printf ("---------------------------------------------------------------------------\n\n");
			}

			printf("VUOI CONTINUARE A RICERCARE ALTRI VOLI?\n SI   NO\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf("INSERIMENTO:   ");
			gets(scelta);
			scelta = converti_minuscolo(scelta);
		} while (strcmp(scelta, "si") != 0 && strcmp(scelta, "no") != 0);

	} while (strcmp(scelta, "si") == 0);					//continua tutto il ciclo di ricerca e di immissione del codice da cercare fino a quando non verra inserito un 'no'

	//libera la memoria allocata dinamicamente
	free(targa);
	free(model);
	free(scelta);
	free(codice_da_cercare);
}

/**
 * Funzione per la cancellazione di un volo.
 * Tale funzione permette la cancellazione di un volo partendo dal suo codice: si inserisce
 * il codice del volo da ricercare, se esiste una corrispondenza allora il volo verrà
 * cancellato, altrimenti ci sarà un messaggio di errore che afferma che non è presente
 * cancellare il suddetto volo.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 */
void cancellazione_volo (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti)
{
	const int MAX_VOLI_STAMPATI = 9;				//definizione della costante per il numero di voli stampati
	string destinazione;							//stringa per la definizione della destinazione
	string scelta_menu;								//stringa per la definizione della scelta nel menu
	string volo_da_cancellare;						//stringa per la definizione del volo da cancellare
	int trovato = 0;								//flag per il ritrovamento del volo inserito
	int i = 0;										//indice del ciclo
	int voli_stampati = 0;							//contatore dei singoli voli stampati a video
	int scelta_corretta = 0;						//flag per l'effettuazione della scelta corretta alla scelta del menu
	int scorrimento_indice = 0;						//contatore per lo scorrimento dell'indice nel ciclo

	//ALLOCAZIONE DELLE STRINGHE
	destinazione = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	volo_da_cancellare = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	scelta_menu = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));

	mergesort_data_per_partenza(volo, 0, numero_voli - 1);				//ordinamento dei voli per data di partenza
	do					//effettua tale ciclo finceh le scelte sono uguali ad 'avanti' e 'caancella'
	{

		do					//effettua tale ciclo fino a che la scelta è corretta
		{
			system("CLS");
			printf ("--------------------CANCELLAZIONE DEL VOLO PER CODICE----------------------\n");
			printf ("VOLI IN PARTENZA DALL'AEROPORTO DI BARI-PALESE:\n\n");
			voli_stampati = 0;						//inizializza i contatori di voli stampati e dell scorrimentod ell'indice
			scorrimento_indice = 0;

			while (i < numero_voli && voli_stampati < MAX_VOLI_STAMPATI)				//finche non si arriva alla fine dei voli e i voli stampati non sono 10
			{
				if (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P')			//se i voli sono in partenza allora stampa i dati
				{
					destinazione = riconoscimento_aeroporto (volo[i].codice_iata, aeroporto, numero_aeroporti);
					if (volo[i].cancellato == 'n')												//se non è stato cancellato stampa tutto
						printf("CODICE VOLO: %s\t PARTENZA: %.2d/%.2d/%d ORE %.2d:%.2d\t \nDESTINAZIONE: %s\n\n", volo[i].codice_id, volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno,volo[i].partenza.ora, volo[i].partenza.minuto, destinazione);
					else if (volo[i].cancellato == 's')											//altrimenti scrivi il messaggio di errore
						printf("CODICE VOLO: %s\t VOLO CANCELLATO \nDESTINAZIONE: %s\n\n", volo[i].codice_id, destinazione);
					voli_stampati ++;					//incrementa il contatpre dei voli stampati
				}
				i ++;						//incrementa l'indice
				scorrimento_indice ++;					//incrementa il suo scorrimento
			}

			printf ("---------------------------------------------------------------------------\n");
			printf("'avanti' | 'cancella' | 'esci cancella' |\n\n");
			printf ("---------------------------------------------------------------------------\n");
			printf("INSERIMENTO:   ");
			gets(scelta_menu);
			scelta_menu = converti_minuscolo (scelta_menu);					//converti in minuscolo la scelta del menu

			if (strcmp(scelta_menu, "cancella") == 0)
			{
				printf("INSERISCI IL CODICE DEL VOLO CANCELLATO:     ");
				gets(volo_da_cancellare);
				volo_da_cancellare = converti_maiuscolo(volo_da_cancellare);				//converti in maiuscolo il volo da cancellare

				for (int k = 0; k < numero_voli; k ++)
				{
					if (strcmp(volo[k].codice_id, volo_da_cancellare) == 0 && volo[k].cancellato == 'n')			//se il codice del volo esiste e non è stato gia cancellato allora cancellalo
					{
						volo[k].numero_passeggeri = -1;								//si impostano i dati in modo che il volo siacancellato e le informazioni siano inutili da utilizzare
						volo[k].partenza.giorno = -1;
						volo[k].partenza.mese = -1;
						volo[k].partenza.anno = -1;
						volo[k].partenza.ora = -1;
						volo[k].partenza.minuto = -1;
						volo[k].arrivo.giorno = -1;
						volo[k].arrivo.mese = -1;
						volo[k].arrivo.anno = -1;
						volo[k].arrivo.ora = -1;
						volo[k].arrivo.minuto = -1;
						volo[k].cancellato = 's';						//si setta il flag cancellato su 's'
						volo[k].emergenza = 'n';						//e gli altri su 'n'
						volo[k].autorizzato = 'n';
						system("CLS");
						printf("IL VOLO %s E' STATO CANCELLATO.\n\n", volo_da_cancellare);
						trovato = 1;								//setta il flag di ritrovamento
						getchar();
						fflush(stdin);
					}
				}
				if (trovato == 0)										//se non è stato trovato stampa un messaggio di errore
				{
					printf ("IL VOLO NON E' STATO TROVATO. PREGO RIPROVARE.\n\n");
					getchar();
					fflush(stdin);
					printf ("---------------------------------------------------------------------------\n\n");
				}

				i -= scorrimento_indice;						//scorri l'indice indietro per far visualizzare gli stessi voli
			}

			else if (strcmp(scelta_menu, "avanti") != 0 && strcmp(scelta_menu, "cancella") != 0 && strcmp(scelta_menu, "esci cancella") != 0)			//se la scelta non è tra quelle valutabili
				scelta_corretta = -1;						//la scelta non è corretta
			else											//altrimenti è corretta
				scelta_corretta = 1;

			if (scelta_corretta == -1)					//se la scelta  non è corretta scorri lindice indietro di quanti passi ha compiuto prima affinche si stampino gli stessi voli
				i -= scorrimento_indice;

		} while (scelta_corretta != 1);

		if (i == numero_voli)					//se l'indice è pari al numero dei voli, azzeralo per rieffettuare la stampa dei vari voli dall'inizio
			i = 0;

	} while (strcmp(scelta_menu, "avanti") == 0 || strcmp(scelta_menu, "cancella") == 0);

	//libera la memoria allocata dinamicamente
	free(destinazione);
	free(volo_da_cancellare);
	free(scelta_menu);
}

/**
 * Funzione per la modifica del gate di attracco-partenza un volo.
 * Tale funzione permette la modifica del gate di un volo: sarà solo possibile
 * inserire un gate che va da A1 ad A5, gli altri saranno segnalati come errore.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti.
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti.
 */
void modifica_gate (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti)
{
	const int MAX_VOLI_STAMPATI = 9;				//costante per il numero di voli da stampare
	int i = 0;										//indice del ciclo
	int voli_stampati = 0;							//variabile contatore per i voli stampati a video
	int scorrimento_indice = 0;						//indice per lo scorrimento dell'indice
	int trovato = 0;								//flag per il ritrovamento del volo
	int scelta_corretta = 0;						//flag per l'immissione della scelta corretta nel menu di scelta
	int inserimento_corretto = 0;					//flag per l'immissione corretta del gate
	string prov_dest;								//stringa per il riconoscimento del volo se è in partenza o arrivo
	string scelta_menu;								//stringa per l'immissione della scelta del menu
	string volo_da_modificare;						//stringa per l'immissione del volo da modificare
	string nuovo_gate;								//stringa per l'immissione del nuovo gate da immettere

	//ALLOCAZIONE DELLE STRINGHE
	prov_dest = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	scelta_menu = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));
	volo_da_modificare = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	nuovo_gate = (string) malloc (DIMENSIONE_NOME_GATE * sizeof(string));

	mergesort_data_per_partenza(volo, 0, numero_voli - 1);				//ordinamento dei voli per data di partenza
	do					//effettua tale ciclo finche le scelte sono uguali ad 'avanti' e 'caancella'
	{

		do					//effettua tale ciclo fino a che la scelta è corretta
		{
			system("CLS");
			printf ("------------------MODIFICA DEL GATE DEL VOLO PER CODICE--------------------\n");
			printf ("VOLI IN TRANSITO DALL'AEROPORTO DI BARI-PALESE:\n\n");
			voli_stampati = 0;						//inizializza i contatori di voli stampati e dell scorrimentod ell'indice
			scorrimento_indice = 0;
			inserimento_corretto = 0;

			while (i < numero_voli && voli_stampati < MAX_VOLI_STAMPATI)				//finche non si arriva alla fine dei voli e i voli stampati non sono 10
			{
				prov_dest = riconoscimento_aeroporto (volo[i].codice_iata, aeroporto, numero_aeroporti);
				if (volo[i].cancellato == 'n')												//se non è stato cancellato stampa tutto
					printf("CODICE VOLO: %s\t PARTENZA: %.2d/%.2d/%d ORE %.2d:%.2d\t", volo[i].codice_id, volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno,volo[i].partenza.ora, volo[i].partenza.minuto);
				else if (volo[i].cancellato == 's')											//altrimenti scrivi il messaggio di errore
					printf("CODICE VOLO: %s\t VOLO CANCELLATO", volo[i].codice_id);

				if (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P')
					printf("\nDESTINAZIONE: %s\t\tGATE: %s\n\n", prov_dest, volo[i].gate);
				else if (volo[i].partenza_arrivo == 'a' || volo[i].partenza_arrivo == 'A')
					printf("\nPROVENIENZA: %s\t\tGATE: %s\n\n", prov_dest, volo[i].gate);
				voli_stampati ++;					//incrementa il contatpre dei voli stampati

				i ++;						//incrementa l'indice
				scorrimento_indice ++;					//incrementa il suo scorrimento
			}

			printf ("---------------------------------------------------------------------------\n");
			printf ("'avanti' | 'cambia' | 'esci gate' |\n\n");
			printf ("---------------------------------------------------------------------------\n");
			printf("INSERIMENTO:   ");
			gets(scelta_menu);
			scelta_menu = converti_minuscolo (scelta_menu);					//converti in minuscolo la scelta del menu

			if (strcmp(scelta_menu, "cambia") == 0)
			{
				printf("INSERISCI IL CODICE DEL VOLO IL CUI GATE DEVE ESSERE MODIFICATO:   ");
				gets(volo_da_modificare);
				volo_da_modificare = converti_maiuscolo(volo_da_modificare);				//converti in maiuscolo il volo da cancellare

				for (int k = 0; k < numero_voli; k ++)
				{
					if (strcmp(volo[k].codice_id, volo_da_modificare) == 0 && volo[k].cancellato == 'n')			//se il codice del volo esiste e non è stato gia cancellato allora cancellalo
					{
							trovato = 1;


							printf("INSERISCI IL NUOVO GATE:     ");
							gets(nuovo_gate);
							nuovo_gate = converti_maiuscolo(nuovo_gate);
							if (strcmp(nuovo_gate, "A1") == 0 || strcmp(nuovo_gate, "A2") == 0 || strcmp(nuovo_gate, "A3") == 0 || strcmp(nuovo_gate, "A4") == 0 || strcmp(nuovo_gate, "A5") == 0)		//se il gate è ammesso
							{
								if (strcmp(nuovo_gate, volo[k].gate) == 0)							//se è lo stesso avvisa del problema
								{
									system("CLS");
									printf("IL GATE E' LO STESSO. RIPROVARE PREGO.\n");
									getchar();
									fflush(stdin);
								}
								else
								{
									system("CLS");																//altrimenti cambia semplicemente
									printf("NUOVO GATE INSERITO CORRETTAMENTE.\n");
									strcpy(volo[k].gate, nuovo_gate);
									getchar();
									fflush(stdin);
									inserimento_corretto = 1;										//setta il flag di inserimento corretto a 1
								}
							}

							else if (strcmp(nuovo_gate, "A1") != 0 && strcmp(nuovo_gate, "A2") != 0 && strcmp(nuovo_gate, "A3") != 0 && strcmp(nuovo_gate, "A4") != 0 && strcmp(nuovo_gate, "A5") != 0)			//se il gate non è ammesso dai un messaggio di errore
							{
								system("CLS");
								printf("GATE NON CORRETTO. RIPROVARE PREGO.\n");
								getchar();
								fflush(stdin);
							}

						trovato = 1;								//setta il flag di ritrovamento
					}
				}
				if (trovato == 0)										//se non è stato trovato stampa un messaggio di errore
				{
					printf("IL VOLO NON E' STATO TROVATO. PREGO RIPROVARE.\n\n");
					getchar();
					fflush(stdin);
				}

				i -= scorrimento_indice;						//scorri l'indice indietro per far visualizzare gli stessi voli
			}

			else if (strcmp(scelta_menu, "avanti") != 0 && strcmp(scelta_menu, "cambia") != 0 && strcmp(scelta_menu, "esci gate") != 0)			//se la scelta non è tra quelle valutabili
				scelta_corretta = -1;						//la scelta non è corretta
			else											//altrimenti è corretta
				scelta_corretta = 1;

			if (scelta_corretta == -1)					//se la scelta  non è corretta scorri lindice indietro di quanti passi ha compiuto prima affinche si stampino gli stessi voli
				i -= scorrimento_indice;

		} while (scelta_corretta != 1 && inserimento_corretto != 1 && trovato == 0);

		if (i == numero_voli)					//se l'indice è pari al numero dei voli, azzeralo per rieffettuare la stampa dei vari voli dall'inizio
			i = 0;

	} while (strcmp(scelta_menu, "esci gate") != 0);

	//libera la memoria allocata dinamicamente
	free(prov_dest);
	free(scelta_menu);
	free(volo_da_modificare);
	free(nuovo_gate);
}

/**
 * Funzione per la gestione dei voli di'emergenza.
 * Tale funzione per mette la gestione dei voli in emergenza: segnalando il codice dell'aereo
 * lo si immetterà (se non cancellato e gia in partenza) nuovamente in lista, settandolo però
 * come volo in arrivo, determinando anche un certo tempo di differenza tra la partenza effettiva
 * e la richiesta di atterraggio di emergenza (che non può superare l'ora in quanto è impossibile
 * che dopo tale tempo l'aereo sia ancora nei pressi dell'aeroporto di Bari-Palese per chiedere
 * un'emergenza)
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 */
void gestione_emergenze (_VOLO *volo, const int numero_voli)
{
	int i = 0;									//indice per il ciclo
	int trovato = 0;							//flag per il ritrovamento del volo
	int tempo_emergenza = 0;					//variabile per l'inserimento del tempo passato dall'emergenza dopo la partenza
	string volo_emergenza;						//stringa per l'inserimento del volo di emergenza in entrata
	string scelta;								//stringa per la scelta del menu di inserimento

	//ALLOCAZIONE DELLE STRINGHE
	volo_emergenza = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));


	do						//continua a fare il ciclo di inserimento finche la scelta immessa in ingresso è uguale a si (se diventa no allora esci)
	{
		system("CLS");
		printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
		printf ("\n\n\nINSERISCI IL VOLO IN PARTENZA IN EMERGENZA.\n\n\n");
		printf ("---------------------------------------------------------------------------\n\n");
		printf("INSERISCI:     ");
		gets(volo_emergenza);
		volo_emergenza = converti_maiuscolo(volo_emergenza);


		system("CLS");
		trovato = 0;
		i = 0;
		do							//fai queste azioni finche non si finiscono i voli a disposizione oppure se si trova il volo
		{
			if (strcmp(volo[i].codice_id, volo_emergenza) == 0 && (volo[i].cancellato == 'n' || volo[i].cancellato == 'N'))					//se si ha una corrispondenza del volo e non è stato cancellato allora...
			{
				if (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P')			//si valuta se è in partenza, se lo è allora fai tali azioni
				{
					do							//fai tale ciclo finche i minuti sono compresi tra 1 e 60
					{
						system("CLS");																				//inserisci il tempo
						printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
						printf ("\n\n\nINSERIRE DOPO QUANTO TEMPO DALLA PARTENZA E' AVVENUTA L'EMERGENZA.\n\n\n");
						printf ("---------------------------------------------------------------------------\n\n");
						printf("INSERIMENTO:     minuti ");
						scanf("%d", &tempo_emergenza);
						fflush(stdin);

						if (tempo_emergenza < 1)							//se è minore di un minuto dai l'errore
						{
							system("CLS");
							printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
							printf ("\n\n\nINSERIMENTO ERRATO. PREGO RIPROVARE.\n");
							printf ("L'EMERGENZA NON PUO' AVVENIRE PRIMA DEL DECOLLO.\n\n\n");
							printf ("---------------------------------------------------------------------------\n\n");
							getchar();
							fflush(stdin);
						}
						if (tempo_emergenza > 60)								//se è maggiore di sessanta minuti dai l'errore
						{
							system("CLS");
							printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
							printf ("\n\n\nINSERIMENTO ERRATO. PREGO RIPROVARE.\n");
							printf("L'EMERGENZA NON PUO' AVVENIRE DOPO UN'ORA IN QUANTO L'AEREO\n");
							printf("E' GIA ABBASTANZA LONTANO DALL'AEROPORTO DI BARI-PALESE E,\n");
							printf("PERTANTO, FAREBBE ATTERRAGGIO ALTROVE.\n\n\n");
							printf ("---------------------------------------------------------------------------\n\n");
							getchar();
							fflush(stdin);
						}

					} while (tempo_emergenza < 1 || tempo_emergenza > 60);

					volo[i].arrivo.anno = volo[i].partenza.anno;								//copia i valori di arrivo in quelli di partenza
					volo[i].arrivo.mese = volo[i].partenza.mese;
					volo[i].arrivo.giorno = volo[i].partenza.giorno;
					volo[i].arrivo.ora = volo[i].partenza.ora;
					volo[i].arrivo.minuto = volo[i].partenza.minuto + tempo_emergenza;			//aggiungi il tempo inserito nei minuti a quello di arrivo

					volo[i].partenza_arrivo = 'A';					//setta che il volo è in arrivo
					volo[i].emergenza = 's';						//e che è in emergenza
					trovato = 1;									//setta il flag di ritrovamento del volo a uno

					if (volo[i].arrivo.minuto >= 60)					//se i minuti dell'orario di arrivo sono maggiori o uguali di 60
					{

						volo[i].arrivo.minuto -= 60;					//li resetti e incrementi l'ora
						volo[i].arrivo.ora ++;

						if (volo[i].arrivo.ora >= 24)					//se anche l'ora supera la sua soglia
						{
							volo[i].arrivo.ora -= 24;					//la resetti e incrementa il giorno
							volo[i].arrivo.giorno ++;
						}
						cambio_data_avanti (&volo[i].arrivo.anno, &volo[i].arrivo.mese, &volo[i].arrivo.giorno);			//setti il cambiamento di data anche per mese ed anno se possibile
					}

					printf("\nECCO LE INFORMAZIONI SUGLI ORARI DEL VOLO:\n\n");
					printf("PARTENZA PRECEDENTE:     %.2d:%.2d DI %.2d/%.2d/%d\n", volo[i].partenza.ora, volo[i].partenza.minuto, volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno);
					printf("ORA MODIFICATA:            %.2d:%.2d DI %.2d/%.2d/%d\n\n\n", volo[i].arrivo.ora, volo[i].arrivo.minuto, volo[i].arrivo.giorno, volo[i].arrivo.mese, volo[i].arrivo.anno);
					printf ("---------------------------------------------------------------------------\n\n");
					getchar();
					fflush(stdin);

				}
				else if (volo[i].partenza_arrivo == 'a' || volo[i].partenza_arrivo == 'A')					//se il volo è in arrivo setti il flag a -1
					trovato = -1;
			}

			if (strcmp(volo[i].codice_id, volo_emergenza) == 0 && (volo[i].cancellato == 's' || volo[i].cancellato == 'S'))				//se il volo esiste ma è stato cancellato allora dai il messaggio di errore
			{
				printf("IL VOLO E' STATO GIA' CANCELLATO E NON SI PUO' MODIFICARLO.\n");
				printf ("---------------------------------------------------------------------------\n\n");
				getchar();
				fflush(stdin);
			}

			i ++;							//incrementi infine l'indice del ciclo

		} while (i < numero_voli && trovato != 1);

		do					//stampa tali messaggi finche la scelta è diversa da si e da no
		{
			switch (trovato)
			{
				case -1:
				{
					system("CLS");
					printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
					printf ("\n\n\nIL VOLO %s NON PUO' ESSERE MODIFICATO POICHE' E' GIA UN VOLO\nIN ARRIVO.\n\n\n", volo_emergenza);
					break;
				}
				case 0:
				{
					system("CLS");
					printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
					printf ("\n\n\nIL VOLO %s NON E' STATO TROVATO OPPURE E' IMPOSSIBILE DA MODIFICARE.\nPREGO RIPROVARE.\n", volo_emergenza);
					break;
				}
				case 1:
				{
					system("CLS");
					printf ("------------------GESTIONE DEGLI ATTERRAGGI DI EMERGENZA-------------------\n\n");
					printf ("\n\n\nIL VOLO %s E' STATO INSERITO TRA I VOLI IN ARRIVO A CAUSA DI\nUNA EMERGENZA.\n", volo_emergenza);
					break;
				}
			}

			printf ("---------------------------------------------------------------------------\n\n");
			printf ("VUOI CONTINUARE AD INSERIRE ALTRI VOLI?\n SI   NO\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			printf("INSERIMENTO:   ");
			gets(scelta);
			scelta = converti_minuscolo(scelta);

		} while (strcmp(scelta, "si") != 0 && strcmp(scelta, "no") != 0);

	} while (strcmp(scelta, "si") == 0);

	//liberazione della memoria allocata dinamicamente
	free (volo_emergenza);
	free (scelta);
}

/**
 * Funzione per l'autorizzazione dei voli in partenza e arrivo.
 * La funzione permette di autorizzare i voli sia in partenza che in arrivo all'aeroporto di
 * Bari-Palese. Permette di autorizzare sia voli in emergenza che quelli senza emergenza. Non permette
 * però di autorizzare voli cancellati, poichè è impossibile.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo.
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto.
 */
void autorizzazione_voli (_VOLO *volo, const int numero_voli)
{
	const int MAX_VOLI_STAMPATI = 20;						//costante per il numero dei voli stampati su schermo
	int i = 0;												//indici dei cicli
	int k = 0;
	int trovato = 0;										//flag per il ritrovamento del volo nella lista
	int ritardo_casuale = 0;								//variabile per la determinazione del valore casuale del ritardo o anticipo
	int voli_stampati = 0;									//contatore dei voli stampaati a video
	string volo_autorizzato;								//stringa per il codice del volo da immettere da tastiera
	string scelta;											//stringa per l'inserimento della scelta del menu

	//allocazione dinamica delle stringhe
	volo_autorizzato = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
	scelta = (string) malloc (DIMENSIONE_STRINGA_MENU * sizeof(string));


	do						//esegui tutto fino a che la scleta è uguale a 'si'
	{
		i = 0;						//azzeramento dell'indice e del flag trovato
		trovato = 0;
		system("CLS");

		printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
		printf ("\n\n\nINSERISCI IL VOLO DA AUTORIZZARE.\n\n\n");
		printf ("---------------------------------------------------------------------------\n\n");
		printf ("INSERISCI:     ");
		gets(volo_autorizzato);
		converti_maiuscolo(volo_autorizzato);

		while (i < numero_voli && trovato == 0)							//finche  l'indice non raggiunge il numero massimo dei voli e il volo non viene trovato
		{
			if (strcmp(volo_autorizzato, volo[i].codice_id) == 0)		//se c'è una corrispondenza del volo allora setta il flag a 1
				trovato = 1;
			else											//altrimenti incrementa l'indice
				i++;

			if ((volo[i].autorizzato == 's' || volo[i].autorizzato == 'S') && trovato == 1)						//se il volo è stato trovato ed è stato gia autorizzato in precedenza
			{
				trovato = -1;													//setti il flag a -1
				if (volo[i].cancellato == 's' || volo[i].cancellato == 'S')						//se è stato cancellato successivamente mostra un messaggio in cui affermi che il volo è stato cancellato
				{
					system ("CLS");
					printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
					printf ("\n\n\nIL VOLO %s E' STATO CANCELLATO, L'AUTORIZZAZIONE PRECEDENTE\nE' STATA ANNULLATA.\n\n", volo[i].codice_id);
					printf ("---------------------------------------------------------------------------\n\n");
				}

				else						//altrimenti mostra un messaggio in cui affermi che il volo è stato gia autorizzato
				{
					system ("CLS");
					printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
					printf("IL VOLO %s E' GIA STATO AUTORIZZATO IN PRECEDENZA.\n\n", volo[i].codice_id);
					printf ("---------------------------------------------------------------------------\n\n");
				}
				getchar();
				fflush(stdin);
			}
			if ((volo[i].cancellato == 's' || volo[i].cancellato == 'S') && trovato == 1)						//se si trova il volo ma è stato cancellato allora mostra un messaggio in cui affermi che è stato cancellato
			{
				trovato = -1;					//e setti il flag a -1
				system ("CLS");
				printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
				printf("IL VOLO %s E' STATO CANCELLATO, PERTANTO E' IMPOSSIBILE AUTORIZZARLO.\n\n", volo[i].codice_id);
				printf ("---------------------------------------------------------------------------\n\n");
				getchar();
				fflush(stdin);
			}

		}

		if (trovato == 1)					//se il volo è stato trovato
		{
			system("CLS");
			printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
			ritardo_casuale = -10 + rand () % 20;				//genera il ritardo/anticipo
			volo[i].autorizzato = 's';						//setta il flag di autorizzazione su 's'

			if (volo[i].partenza_arrivo == 'a' || volo[i].partenza_arrivo == 'A')				//se il volo è in arrivo allora effettua tali istruzioni
			{
				volo[i].effettiva = volo[i].arrivo;							//copia i valori dell'orario in arrivo sull'orario effettivo
				volo[i].effettiva.minuto += ritardo_casuale;			//aggiungi il tempo di ritardo/anticipo

				if (volo[i].effettiva.minuto <= 0)				//se il valor sommato al ritardo è minore di 0 (ovvero c'è di certo un anticipo)
				{
					volo[i].effettiva.minuto += 59;				//cambi l'orario dei minuti e delle ore all'indietro
					volo[i].effettiva.ora -= 1;

					if (volo[i].effettiva.ora <= 0)
					{
						volo[i].effettiva.ora = 23;
						volo[i].effettiva.giorno -= 1;
					}
				}
				else if (volo[i].effettiva.minuto >= 60)				//se invece il valore sommato al ritardo è maggiore di 60 (ovvero c'è di certo un ritardo)
				{
					volo[i].effettiva.minuto -= 60;					//cambi l'orario dei minuti e delle ore in avanti
					volo[i].effettiva.ora += 1;

					if (volo[i].effettiva.ora >= 24)
					{
						volo[i].effettiva.ora = 0;
						volo[i].effettiva.giorno += 1;
					}
				}

				if (ritardo_casuale > 0)				//se c'è un ritardo allora conrtolla se è necessario cambiare la data in avanti
					cambio_data_avanti (&volo[i].effettiva.anno, &volo[i].effettiva.mese, &volo[i].effettiva.giorno);
				else if (ritardo_casuale < 0)			//se c'è un anticipo allora conrtolla se è necessario cambiare la data all'indietro
					cambio_data_indietro(&volo[i].effettiva.anno, &volo[i].effettiva.mese, &volo[i].effettiva.giorno);

				printf("VOLO %s REGOLARMENTE AUTORIZZATO. IN ARRIVO A BARI-PALESE.\n\n", volo[i].codice_id);
				printf("ORARIO STABILITO IN PRECEDENZA:     %.2d/%.2d/%d  ORE %.2d:%.2d\n", volo[i].arrivo.giorno, volo[i].arrivo.mese, volo[i].arrivo.anno, volo[i].arrivo.ora, volo[i].arrivo.minuto);
				printf("ORARIO EFFETTIVO DI PARTENZA:       %.2d/%.2d/%d  ORE %.2d:%.2d\n\n\n", volo[i].effettiva.giorno, volo[i].effettiva.mese, volo[i].effettiva.anno, volo[i].effettiva.ora, volo[i].effettiva.minuto);
				printf ("---------------------------------------------------------------------------\n\n");
				getchar();
				fflush(stdin);
			}

			else if (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P')			// se invece il volo è in partenza
			{
				volo[i].effettiva = volo[i].partenza;							//copia il valore dell'orario in partenza nell'ora effettiva
				volo[i].effettiva.minuto += ritardo_casuale;					//aggiungi il ritardo/anticipo

				if (volo[i].effettiva.minuto <= 0)				//se il valor sommato al ritardo è minore di 0 (ovvero c'è di certo un anticipo)
				{
					volo[i].effettiva.minuto += 59;				//cambi l'orario dei minuti e delle ore all'indietro
					volo[i].effettiva.ora -= 1;

					if (volo[i].effettiva.ora <= 0)
					{
						volo[i].effettiva.ora = 23;
						volo[i].effettiva.giorno -= 1;
					}
				}
				else if (volo[i].effettiva.minuto >= 60)				//se invece il valore sommato al ritardo è maggiore di 60 (ovvero c'è di certo un ritardo)
				{
					volo[i].effettiva.minuto -= 60;					//cambi l'orario dei minuti e delle ore in avanti
					volo[i].effettiva.ora += 1;

					if (volo[i].effettiva.ora >= 24)
					{
						volo[i].effettiva.ora = 0;
						volo[i].effettiva.giorno += 1;
					}
				}

				if (ritardo_casuale > 0)				//se c'è un ritardo allora conrtolla se è necessario cambiare la data in avanti
					cambio_data_avanti (&volo[i].effettiva.anno, &volo[i].effettiva.mese, &volo[i].effettiva.giorno);
				else if (ritardo_casuale < 0)			//se c'è un anticipo allora conrtolla se è necessario cambiare la data all'indietro
					cambio_data_indietro(&volo[i].effettiva.anno, &volo[i].effettiva.mese, &volo[i].effettiva.giorno);

				printf("VOLO %s REGOLARMENTE AUTORIZZATO. IN PARTENZA DA BARI-PALESE.\n\n", volo[i].codice_id);
				printf("ORARIO STABILITO IN PRECEDENZA:     %.2d/%.2d/%d  ORE %.2d:%.2d\n", volo[i].partenza.giorno, volo[i].partenza.mese, volo[i].partenza.anno, volo[i].partenza.ora, volo[i].partenza.minuto);
				printf("ORARIO EFFETTIVO DI PARTENZA:       %.2d/%.2d/%d  ORE %.2d:%.2d\n\n\n", volo[i].effettiva.giorno, volo[i].effettiva.mese, volo[i].effettiva.anno, volo[i].effettiva.ora, volo[i].effettiva.minuto);
				printf ("---------------------------------------------------------------------------\n\n");
				getchar();
				fflush(stdin);
			}
		}
		else if (trovato == 0)			//se invece non è stato trovato alcun volo mostra un messaggio di errore
		{
			system("CLS");
			printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
			printf ("\n\n\nIL VOLO %s NON E' STATO TROVATO NEI DATABASE.\n", volo_autorizzato);
			printf ("SE HAI COMPIUTO DEGLI ERRORI DI BATTITURA RIPROVA.\n\n\n");
			printf ("---------------------------------------------------------------------------\n\n");
			getchar();
			fflush(stdin);
		}


		do						//continua il ciclo finche la scltà è si oppure no
		{
			k = 0;
			system("CLS");
			printf ("------------------GESTIONE DELLE AUTORIZZAZIONI DEI VOLI-------------------\n\n");
			printf("VOLI AUTORIZZATI PIU' VICINI ALLA DATA DI ARRIVO/PARTENZA:\n\n");
			printf(" VOLO    PARTENZA/ARRIVO      DATA EFFETTIVA  GATE\n\n");
			do			//stampa i voli gia autorizzati finche non si raggiunge il massimo numero di voli e non si raggiunge il massimo numero di stampe
			{

				if ((volo[k].autorizzato == 's' || volo[k].autorizzato == 'S') && (volo[k].cancellato == 'n' || volo[k].cancellato == 'N'))
				{
					printf("%s         %c                   %.2d:%.2d       %s\n", volo[k].codice_id, volo[k].partenza_arrivo, volo[k].effettiva.ora, volo[k].effettiva.minuto, volo[k].gate);
					voli_stampati ++;
				}

				k ++;

			} while (voli_stampati < MAX_VOLI_STAMPATI && k < numero_voli);
			printf ("\n---------------------------------------------------------------------------\n");
			printf ("VUOI CONTINUARE AD INSERIRE ALTRI VOLI?\n SI   NO\n");
			printf ("---------------------------------------------------------------------------\n");
			printf("INSERIMENTO:   ");
			gets(scelta);
			scelta = converti_minuscolo(scelta);

		} while (strcmp(scelta, "si") != 0 && strcmp(scelta, "no") != 0);

	} while (strcmp(scelta, "si") == 0);

}





