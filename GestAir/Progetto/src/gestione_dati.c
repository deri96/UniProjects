/**
 * @file gestione_dati.c
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * Questo file sorgente contiene tutte quelle funzioni che permettono la gestione dei dati da file (per esempio
 * il caricamento dei voli, il salvataggio dei log, ecc.)
 */

#include "gestione_dati.h"

/**
 * Caricamento dei modelli degli aerei.
 * La funzione preleva i dati relativi ai modelli degli aeromobili (nel particolare l'azienda costruttrice, il modello, il tipo di propulsore,
 * il numero di motori e il numero massimo dei passeggeri) caricandoli da un file esterno denominato
 * modelli.csv.
 *
 * @param modello Struttura dati comprendente le informazioni relative al modello dell'aereo
 * @param numero_modelli Variabile per il conteggio del numero di modelli esistenti
 */
void caricamento_info_modelli_aerei (_MODELLO *modello, int *numero_modelli)
{
	FILE *fp;			// puntatore al file

	// CARICAMENTO DEI DIVERSI MODELLI DI AEREI
	if ((fp = fopen ("db/modelli.csv","r")) != NULL)		//se il file "modelli.csv" esiste allora esegui tutto
	{
		string appoggio;									//stringa di appoggio per il caricamento dei dati
		const int DIM_STRINGA_APPOGGIO = 100;				//dimensione della stringa di appoggio
		int i = 0;											//indice utile nel ciclo di acquisizione dei dati

		appoggio = (string) malloc (DIM_STRINGA_APPOGGIO * sizeof(string));			//allocazione della memoria per la stringa appoggio

		while (!feof(fp))															//finche il file non arriva alla fine fai tali istruzioni:
		{
			fgets(appoggio, DIM_STRINGA_APPOGGIO, fp);								//in primo luogo acquisisci la stringa dal file

			strcpy (modello[i].azienda, strtok (appoggio, ","));					//dopo tokenizzala e carica la stringa nel campo 'azienda' di 'modello'
			strcpy (modello[i].modello, strtok (NULL, ","));						//poi tokenizzala e carica la stringa nel campo 'modello' di 'modello'
			modello[i].propulsore = strtok (NULL, ",")[0];							//poi tokenizza
			modello[i].numero_motori = atoi(strtok (NULL, ","));					//poi tokenizzala e carica la cifra nel campo 'numero_motori' effettuando prima un casting
			modello[i].numero_massimo_passeggeri = atoi(strtok (NULL, ";"));		//infine tokenizzala e carica la cifra nel campo 'numero_massimo_passeggeri' effettuando prima un casting
			i ++;																	//incrementa l'indice
		}
		fclose(fp);				//chiudi il file indicizzato dal puntatore fp

		*numero_modelli = i;							//il numero dei modelli è pari al valore finale dell'indice
	}
	else				//se il file "modelli.csv" non esiste o non si riesce ad aprire allora mostra il messaggio di errore ed esci dal programma
	{
		printf("FILE modelli.csv DANNEGGIATO O MANCANTE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}

}

/**
 * Caricamento delle informazioni degli aerei transitanti dall'aeroporto.
 * La funzione preleva i dati relativi agli aerei (nel particolare la targa ed il modello dell'aereo) caricandoli da un file esterno denominato
 * aeromobili.csv.
 *
 * @param aereo Struttura dati comprendente le informazioni relative all'aereo transitante nell'aeroporto
 * @param numero_aerei Variabile per il conteggio del numero di aerei esistenti
 */
void caricamento_info_aeromobili (_AEROMOBILE *aereo, int *numero_aerei)
{
	FILE *fp;		//puntatore al file

	// CARICAMENTO DEGLI AEREI FACENTI PARTE DEI DIVERSI VOLI
	if ((fp = fopen("db/aeromobili.csv","r")) != NULL)
	{
		string appoggio;									//stringa di appoggio per il caricamento dei dati
		const int DIM_STRINGA_APPOGGIO = 100;				//dimensione della stringa di appoggio
		int i = 0;											//indice utile nel ciclo di acquisizione dei dati

		appoggio = (string) malloc (DIM_STRINGA_APPOGGIO * sizeof(string));			//allocazione della memoria per la stringa appoggio

		while (!feof(fp))									//finche il file non arriva alla fine fai tali istruzioni:
		{
			fgets(appoggio, DIM_STRINGA_APPOGGIO, fp);		//in primo luogo acquisisci la stringa dal file
			strcpy(aereo[i].targa, strtok (appoggio, ","));		//dopo tokenizzala e carica la stringa nel campo 'targa' di 'aereo'
			strcpy(aereo[i].modello, strtok (NULL, ";"));			//poi tokenizzala e carica la stringa nel campo 'modello' di 'aereo'
			i ++;
		}
		fclose(fp);				//chiudi il file indicizzato dal puntatore fp

		*numero_aerei = i;						//il numero degli aerei sarà uguale all'indice allla fine del ciclo
	}
	else				//se il file "modelli.csv" non esiste o non si riesce ad aprire allora mostra il messaggio di errore ed esci dal programma
	{
		printf("FILE aeromobili.csv DANNEGGIATO O MANCANTE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}
}

/**
 * Caricamento delle informazioni dei voli in arrivo o partenza dall'aeroporto.
 * La funzione preleva i dati relativi ai diversi voli (nel particolare il codice identificativo, il nome della compagnia, la targa ed
 * il modello dell'aereo, il codice IATA dell'aeroporto da cui arriva o deve giungere l'aereo, la data e l'ora di partenza e arrivo,
 * il numero passeggeri ed il gate d'attracco) caricandoli da un file esterno denominato aeromobili.csv.
 *
 * @param volo Struttura dati comprendente le informazioni relative al volo
 * @param numero_voli Variabile per il conteggio dei numeri dei voli in transito dall'aeroporto
 */
void caricamento_info_voli (_VOLO *volo, int *numero_voli)
{
	FILE *fp;				//puntatore al file

	if((fp = fopen("gest/voli.csv","r")) != NULL)
	{
		string appoggio;									//stringa di appoggio per il caricamento dei dati
		const int DIM_STRINGA_APPOGGIO = 100;				//dimensione della stringa di appoggio
		int i = 0;											//indice utile nel ciclo di acquisizione dei dati

		appoggio = (string) malloc (DIM_STRINGA_APPOGGIO * sizeof(string));			//allocazione della memoria per la stringa appoggio

		while (!feof(fp))									//finche il file non arriva alla fine fai tali istruzioni:
		{
			fgets(appoggio, DIM_STRINGA_APPOGGIO, fp);						//in primo luogo acquisisci la stringa dal file
			strcpy(volo[i].codice_id, strtok (appoggio, ","));						//dopo tokenizzala e carica la stringa nel campo 'codice_id' di 'volo'
			strcpy(volo[i].nome_compagnia, strtok (NULL, ","));				//poi tokenizzala e carica la stringa nel campo 'nome_compagnia' di 'volo'
			strcpy(volo[i].targa, strtok (NULL, ","));						//poi tokenizzala e carica la stringa nel campo 'targa' di 'volo'
			volo[i].partenza_arrivo = strtok (NULL, ",")[0];				//poi tokenizzala e carica il carattere nel campo 'partenza_arrivo' di 'volo'
			strcpy(volo[i].codice_iata, strtok (NULL, ","));				//poi tokenizzala e carica la stringa nel campo 'codice_iata' di 'volo'
			volo[i].partenza.giorno = atoi(strtok (NULL, "/"));				//poi tokenizzala e carica il valore nel campo 'partenza.giorno' effettuando prima un casting
			volo[i].partenza.mese = atoi(strtok (NULL, "/"));				//poi tokenizzala e carica il valore nel campo 'partenza.mese' effettuando prima un casting
			volo[i].partenza.anno = atoi(strtok (NULL, ","));				//poi tokenizzala e carica il valore nel campo 'partenza.anno' effettuando prima un casting
			volo[i].partenza.ora = atoi(strtok (NULL, ":"));				//poi tokenizzala e carica il valore nel campo 'partenza.ora' effettuando prima un casting
			volo[i].partenza.minuto = atoi(strtok (NULL, ","));				//poi tokenizzala e carica il valore nel campo 'partenza.minuto' effettuando prima un casting
			volo[i].arrivo.giorno = atoi(strtok (NULL, "/"));				//poi tokenizzala e carica il valore nel campo 'arrivo.giorno' effettuando prima un casting
			volo[i].arrivo.mese = atoi(strtok (NULL, "/"));					//poi tokenizzala e carica il valore nel campo 'arrivo.mese' effettuando prima un casting
			volo[i].arrivo.anno = atoi(strtok (NULL, ","));					//poi tokenizzala e carica il valore nel campo 'arrivo.anno' effettuando prima un casting
			volo[i].arrivo.ora = atoi(strtok (NULL, ":"));					//poi tokenizzala e carica il valoer nel campo 'arrivo.ora' effettuando prima un casting
			volo[i].arrivo.minuto = atoi(strtok (NULL, ","));				//poi tokenizzala e carica il valore nel campo 'arrivo.minuto' effettuando prima un casting
			volo[i].numero_passeggeri = atoi(strtok (NULL, ","));			//poi tokenizzala e carica il valore nel campo 'numero_passeggeri' effettuando prima un casting
			strcpy(volo[i].gate, strtok(NULL, ";"));						//infine tokenizzala e carica la stringa nel campo 'gate' di 'volo'
			volo[i].cancellato = 'n';										//setta il flag della cancellazione a 'n'
			volo[i].emergenza = 'n';										//setta il flag dell'emergenza a 'n'
			volo[i].autorizzato = 'n';										//setta il flag dell'autorizzazione a 'n'
			volo[i].arrivo.data_estesa = (volo[i].arrivo.anno * 0.0001) + (volo[i].arrivo.mese * 0.000001) + (volo[i].arrivo.giorno * 0.00000001)
					+ (volo[i].arrivo.ora * 0.0000000001) + (volo[i].arrivo.minuto * 0.000000000001);						//crea la data estesa di arrivo per l'ordinamento moltiplicando per fattori di base 10
			volo[i].partenza.data_estesa = (volo[i].partenza.anno * 0.0001) + (volo[i].partenza.mese * 0.000001) + (volo[i].partenza.giorno * 0.00000001)
					+	(volo[i].partenza.ora * 0.0000000001) + (volo[i].partenza.minuto * 0.000000000001);		//crea la data estesa di arrivo per l'ordinamento moltiplicando per fattori di base 10
			i ++;
		}
		fclose(fp);				//chiudi il file indicizzato dal puntatore fp

		*numero_voli = i;					//il numero di voli sarà uguale al valore dell'indice alla fine del ciclo
	}
	else				//se il file "modelli.csv" non esiste o non si riesce ad aprire allora mostra il messaggio di errore ed esci dal programma
	{
		printf("FILE voli.csv DANNEGGIATO O MANCANTE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}
}


/**
 * Caricamento delle informazioni sugli aeroporti.
 * La funzione preleva i diversi dati sugli aeroporti, ovvero il suo codice IATA ed il suo nome identificativo,
 * caricandoli da un file esterno denominato 'aeroporti.csv'.
 *
 * @param aeroporto Struttura dati comprendente le informazioni relative agli aeroporti
 * @param numero_aeroporti Variabile per il conteggio dei numeri degli aeroporti
 */
void caricamento_info_aeroporti (_AEROPORTO *aeroporto, int *numero_aeroporti)
{
	FILE *fp;					//puntatore al file

	if ((fp = fopen("db/aeroporti.csv","r")) != NULL)
	{
		string appoggio;									//stringa di appoggio per il caricamento dei dati
		const int DIM_STRINGA_APPOGGIO = 100;				//dimensione della stringa di appoggio
		int i = 0;											//indice utile nel ciclo di acquisizione dei dati

		appoggio = (string) malloc (DIM_STRINGA_APPOGGIO * sizeof(string));			//allocazione della memoria per la stringa appoggio

		while (!feof(fp))						//finche il file non arriva alla fine fai tali istruzioni:
		{
			fgets(appoggio, DIM_STRINGA_APPOGGIO, fp);						//in primo luogo acquisisci la stringa dal file
			strcpy(aeroporto[i].codice, strtok (appoggio, ","));			//poi tokenizzala e carica la stringa nel campo 'codice' di 'aeroporto'
			strcpy(aeroporto[i].nome, strtok (NULL, ";"));		//infine tokenizzala e carica la stringa nel campo 'nome' di 'aeroporto'
			i ++;
		}
		*numero_aeroporti = i;							//il numero di aeroporti sara' pari al valore di i alla fine del ciclo
	}
	else				//se il file "iata_aeroporti.csv" non esiste o non si riesce ad aprire allora mostra il messaggio di errore ed esci dal programma
	{
		printf("FILE iata_aeroporti.csv DANNEGGIATO O MANCANTE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}
	fclose(fp);						//chiudi il file
}

/**
 * Funzione per l'acquisizione da file della password.
 * La funzione acquisisce dal file "key.bin" una stringa che viene convertita in cifre.
 * Essa sarà la password dell'area riservata da immettere.
 *
 * @return Il valore della password in cifre
 */
long int acquisizione_password ()
{
	long int password = 0;					//variabile per l'acquisizione della password
	FILE *fp;							//puntatore al file

	if((fp = fopen ("db/key.bin","rb")) != NULL)					//se il file esiste allora acquisisci la password
		fscanf(fp, "%ld", &password);
	else															//altrimenti dai un messaggio di errore
	{
		printf("FILE key.bin DANNEGGIATO O MANCANTE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}
	fclose(fp);						//chiudi il file
	return password;
}

/**
 * Funzione per la creazione del file di log.
 * Questa funzione serve per la creazione del file di log dove verranno inserite tutte
 * le informazioni riguardo i voli modificati (ovvero i voli cancellati, in emergenza
 * e autorizzati).
 *
 * @param volo
 * @param numero_voli
 */
void creazione_log (_VOLO *volo, const int numero_voli)
{
	const int DIMENSIONE_PERCORSO_FILE = 20;					//costante per la dimensione della stringa del  percorso del file
	FILE *fp;													//puntatore al file
	int i = 0;													//indice del ciclo
	string percorso_file;										//stringa del percorso del file

	//allocazione dinamica della memoria della stringa
	percorso_file = (string) malloc (DIMENSIONE_PERCORSO_FILE * sizeof(string));

	time_t tempo_in_secondi;					//creazione di una struttura dati di nome 'tempo_in_secondi' di tipo 'time_t'
	struct tm *tempo;							//creazione di un puntatore di struttura di nome 'tempo'

	tempo_in_secondi = time(NULL);							//inizializzo la struttura 'tempo_in_secondi' con l'orario del sistema
	tempo = localtime (&tempo_in_secondi);					//e lo converto nell'ora locale (ovvero l'ora in data come la conosciamo)
	sprintf(percorso_file, "gest/log/log_%d%d%d%d%d%d.csv", tempo->tm_year+1900, tempo->tm_mon+1, tempo->tm_mday, tempo->tm_hour, tempo->tm_min, tempo->tm_sec);		//chiamo il file con la dicitura 'log' seguito dalla data e ora di creazione

	if ((fp = fopen (percorso_file,"w")) != NULL)				//se il file viene creato correttamente allora scrivi tutti i dati del log
	{
		fputs ("-------File di log delle attività svolte-------\n", fp);
		fputs ("In sequenza: codice del volo, partenza/arrivo, codice IATA dell'aeroporto, data effettiva(*), ora effettiva(*),  gate(*)\n", fp);
		fputs ("I campi indicati con (*) potrebbero essere stati soggetti a cambiamenti.\n\n", fp);
		while (i < numero_voli)
		{
			if (volo [i].emergenza == 's' || volo[i].emergenza == 'S' || volo[i].autorizzato == 's' || volo[i].autorizzato == 'S' || volo[i].cancellato == 's' || volo[i].cancellato == 'S')
			{
				fprintf(fp, "%s,%c,%s", volo[i].codice_id, volo[i].partenza_arrivo, volo[i].codice_iata);
				if ((volo[i].emergenza == 's' || volo[i].emergenza == 'S') && (volo[i].autorizzato == 'n' || volo[i].autorizzato == 'N'))
					fprintf(fp, ",%.2d/%.2d/%.2d,%.2d:%.2d,%s,emergenza,non autorizzato;\n",volo[i].arrivo.giorno, volo[i].arrivo.mese,volo[i].arrivo.anno, volo[i].arrivo.ora, volo[i].arrivo.minuto, volo[i].gate);
				if ((volo[i].emergenza == 's' || volo[i].emergenza == 'S') && (volo[i].autorizzato == 's' || volo[i].autorizzato == 'S'))
					fprintf(fp, ",%.2d/%.2d/%.2d,%.2d:%.2d,%s,emergenza,autorizzato;\n",volo[i].effettiva.giorno, volo[i].effettiva.mese,volo[i].effettiva.anno, volo[i].effettiva.ora, volo[i].effettiva.minuto, volo[i].gate);
				if ((volo[i].emergenza == 'n' || volo[i].emergenza == 'N') && (volo[i].autorizzato == 's' || volo[i].autorizzato == 'S'))
					fprintf(fp, ",%.2d/%.2d/%.2d,%.2d:%.2d,%s,autorizzato;\n",volo[i].effettiva.giorno, volo[i].effettiva.mese,volo[i].effettiva.anno, volo[i].effettiva.ora, volo[i].effettiva.minuto, volo[i].gate);
				if (volo[i].cancellato == 's' || volo[i].cancellato == 'S')
					fprintf(fp, ",-/-/-,-:-,-,cancellato;\n");
			}
			i ++;						//incrementa l'indice
		}
	}
	else							//SE NON VIENE CREATO DAI IL MESSAGGIO DI ERRORE
	{
		printf("FILE DI LOG IMPOSSIBILE DA CREARE.\nRIVOLGERSI AL RESPONSABILE PER ULTERIORI INFORMAZIONI\n");
		system("PAUSE");
		exit(1);
	}
	fclose (fp);			//chiusura del file indicizzato da fp
}
