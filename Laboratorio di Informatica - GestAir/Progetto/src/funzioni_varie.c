/**
 * @file funzioni_varie.c
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * In questo file sorgente ci sono le funzioni che non sono incluse nelle categorie di gestione dell'aeroporto e in quella
 * di gestione dei dati. Esse sono perlopiù stampe a video di menu' oppure impostazioni varie.
 */

#include "funzioni_varie.h"

/**
 * Procedura per il settaggio del colore del sistema (nel particolare schermo blu con testo bianco) e della dimensione della finestra
 * del programma (nel particolare una grandezza di 40 righe e 75 colonne).
 */
void settaggio_schermo ()
{
	system("color 1b");
	system("MODE CON COLS=75 LINES=40");
}

/**
 * Procedura per la stampa del menu inizale appena il programma viene avviato.
 */
void stampa_menu_iniziale ()
{
	printf("---------------------------AEROPORTO BARI-PALESE---------------------------\n\n");
	printf("\n                   DIGITA 'tabella' PER TABELLA DEI VOLI\n\n\n");
	printf("\n                   DIGITA 'riservata' PER AREA RISERVATA\n\n\n");
	printf("\n                   DIGITA 'esci' PER USCIRE\n\n\n");
	printf("---------------------------------------------------------------------------\n\n\n");
}

/**
 * Funzione che permette la conversione di una determinata stringa in caratteri minuscoli.
 * Se un carattere al suo interno è gia in minuscolo allora passa oltre
 * @param stringa_da_convertire stringa sulla quale verrà applicata la funzione
 * @return stringa convertita in minuscolo.
 */
string converti_minuscolo (string stringa_da_convertire)
{
	for (int i = 0; stringa_da_convertire[i] != '\0'; i ++)
	{
		if (stringa_da_convertire[i] >= 'A' && stringa_da_convertire[i] <= 'Z')
			stringa_da_convertire[i] += 32;
	}
	return stringa_da_convertire;
}

/**
 *  Funzione che permette la conversione di una determinata in caratteri maiuscoli.
 * Se un carattere al suo interno è gia in maiuscolo allora passa oltre
 * @param stringa_da_convertire stringa sulla quale verrà applicata la funzione
 * @return Stringa convertita in maiuscolo
 */
string converti_maiuscolo (string stringa_da_convertire)
{
	for (int i = 0; stringa_da_convertire[i] != '\0'; i ++)
	{
		if (stringa_da_convertire[i] >= 'a' && stringa_da_convertire[i] <= 'z')
			stringa_da_convertire[i] -= 32;
	}
	return stringa_da_convertire;
}

/**
 * Procedura per la stampa del menu della tabella dei voli.
 */
void stampa_menu_tabella_voli ()
{
	printf("---------------------------AEROPORTO BARI-PALESE---------------------------\n\n");
	printf("\n             DIGITA 'arrivo' PER TABELLA DEI VOLI IN ARRIVO\n\n\n");
	printf("\n             DIGITA 'partenza' PER TABELLA DEI VOLI IN PARTENZA\n\n\n");
	printf("\n             DIGITA 'codice' PER RICERCA DEL VOLO DA CODICE\n\n\n");
	printf("\n             DIGITA 'aereo' PER RICERCA DELL'AEREO DEL VOLO\n\n\n");
	printf("\n             DIGITA 'esci tabella' PER TORNARE AL MENU PRINCIPALE\n\n\n");
	printf("---------------------------------------------------------------------------\n\n\n");
}
/**
 * Procedura per la stampa del menu dell'area riservata
 */
void stampa_menu_area_riservata ()
{
	printf("---------------------------AEROPORTO BARI-PALESE---------------------------\n\n");
	printf("\n             DIGITA 'cancella' PER ELIMINAZIONE VOLO IN PARTENZA\n\n\n");
	printf("\n             DIGITA 'gate' PER CAMBIO DI GATE DEL VOLO\n\n\n");
	printf("\n             DIGITA 'emergenza' PER GESTIONE DELLE EMERGENZE\n\n\n");
	printf("\n             DIGITA 'autorizza' PER AUTORIZZAZIONE DEI VOLI\n\n\n");
	printf("\n             DIGITA 'esci riservata' PER TORNARE AL MENU PRINCIPALE\n\n\n");
	printf("---------------------------------------------------------------------------\n\n\n");
}

/**
 * Funzione per il cambio in avanti della data.
 * Tale funzione viene richiamata quando viene immesso un ritardo durante l'accettazione del volo
 * al fine di cambiare la data nel modo corretto
 * @param anno Variabile per la modifica dell'anno della data
 * @param mese Variabile per la modifica del mese della data
 * @param giorno Variabile per la modicfica del giorno della data
 */
void cambio_data_avanti (int *anno, int *mese, int *giorno)
{
	switch (*mese)					//in base al mese dell'anno si cambiano l'indicatore per l'ultimo giorno del mese
	{
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
		{
			if (*giorno > 31)					//se il giorno è il 31 ed è gennaio, marzo, maggio, luglio, agosto, ottobre o dicembre
			{
				if (*mese == 12)
				{
					*giorno = 1;
					*mese = 1;
					*anno += 1;						//se il mese è dicembre si incrementa l'anno
				}
				else
				{
					*mese += 1;
					*giorno = 1;
				}
			}
			break;
		}
		case 4:
		case 6:
		case 9:
		case 11:
		{
			if (*giorno > 30)				//se il giorno è il 30 ed è aprile, giugno, settembre o novembre
			{
				*mese += 1;
				*giorno = 1;
			}
			break;
		}

		case 2:											//se il mese è febbraio allora si controlla se è bisestile
		{
			if ((*anno - 2000) % 4)							//se l'anno meno 2000 è diviibile per 4 (cioè è bisestile) il giorno finale del mese è il 29
			{
				if (*giorno > 29)
				{
					*mese += 1;
					*giorno = 1;
				}
			}
			else											//altrimenti è il 28
			{
				if (*giorno > 28)
				{
					*mese += 1;
					*giorno = 1;
				}
			}
			break;
		}

		default:
			break;
	}

}

/**
 * Funzione per il cambio all'indietro della data.
 * Tale funzione viene richiamata quando viene immesso un anticipo durante l'accettazione del volo
 * al fine di cambiare la data nel modo corretto
 * @param anno Variabile per la modifica dell'anno della data
 * @param mese Variabile per la modifica del mese della data
 * @param giorno Variabile per la modicfica del giorno della data
 */
void cambio_data_indietro (int *anno, int *mese, int *giorno)
{
	switch (*mese)					//in base al mese dell'anno si cambiano l'indicatore per l'ultimo giorno del mese
	{
		case 12:
		case 10:
		case 7:
		case 5:
		{
			if (*giorno < 1)					//se è dicembre, ottobre, luglio o maggio allora il giorno del mese precedente è il 30
			{
				*mese -= 1;
				*giorno = 30;
			}
			break;
		}

		case 11:
		case 9:
		case 8:
		case 6:
		case 4:
		case 2:
		case 1:
		{
			if (*giorno < 1)					//se è novembre, settembre, agosto, giugno, aprile, febbraio o gennaio il giorno del mese precedente è il 31
			{
				if (*mese == 1)
				{
					*mese = 12;
					*giorno = 31;
					*anno -= 1;
				}
				else
				{
					*mese -= 1;
					*giorno = 31;
				}
			}
			break;
		}

		case 3:									//se è marzo allora controlla se l'anno è bisestile
		{
			if (*giorno < 1)
			{
				if ((*anno - 2000) % 4)							//se l'anno meno 2000 è diviibile per 4 (cioè è bisestile) il giorno finale del mese è il 29
				{
					*mese -= 1;
					*giorno = 29;
				}
				else
				{										//altrimenti è il 28
					*mese -= 1;
					*giorno = 28;
				}
			}
			break;
		}

		default:
			break;
	}

}
