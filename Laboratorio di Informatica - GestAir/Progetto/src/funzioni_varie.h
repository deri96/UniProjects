/**
 * @file funzioni_varie.h
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * In questo file header ci sono i prototipi delle funzioni che sono state definite nel file sorgente 'funzioni_varie.c'.
 */

#ifndef FUNZIONI_VARIE_H_
#define FUNZIONI_VARIE_H_

#include "main.h"

/**
 * Procedura per il settaggio del colore del sistema  e della dimensione della finestra del programma.
 */
void settaggio_schermo ();

/**
 * Procedura per la stampa del menu inizale appena il programma viene avviato.
 */
void stampa_menu_iniziale ();

/**
 * Funzione per la conversione di una stringa in caratteri minuscoli.
 *
 * @param stringa_da_convertire determina la stringa che deve essere convertita
 * @return la stringa convertita in minuscolo
 */
string converti_minuscolo (string);

/**
 * Funzione per la conversione di una stringa in caratteri maiuscolo.
 *
 * @param stringa_da_convertire determina la stringa che deve essere convertita
 * @return la stringa convertita in maiuscolo
 */
string converti_maiuscolo (string stringa_da_convertire);

/**
 * Procedura per la stampa del menu della tabella dei voli.
 */
void stampa_menu_tabella_voli ();

/**
 * Procedura per la stampa del menu dell'area riservata
 */
void stampa_menu_area_riservata ();

/**
 * Funzione per il cambio in avanti della data.
 *
 * @param anno determina la variabile dell'anno da cambiare eventualmente
 * @param mese determina la variabile del mese da cambiare eventualmente
 * @param giorno determina la variabile del giorno da cambiare eventualmente
 */
void cambio_data_avanti (int *anno, int *mese, int *giorno);

/**
 * Funzione per il cambio all'indietro della data.
 *
 * @param anno determina la variabile dell'anno da cambiare eventualmente
 * @param mese determina la variabile del mese da cambiare eventualmente
 * @param giorno determina la variabile del giorno da cambiare eventualmente
 */
void cambio_data_indietro (int *anno, int *mese, int *giorno);

#endif /* FUNZIONI_VARIE_H_ */
