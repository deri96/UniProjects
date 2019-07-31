/**
 * @file gestione_dati.h
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * Questo file header contiene i prototipi delle funzioni create ed organizzate nel file "gestione_dati.c"
 */

#ifndef GESTIONE_DATI_H_
#define GESTIONE_DATI_H_

#include "main.h"


/**
 * Funzione per il caricamento delle informazioni dei modelli degli aerei
 *
 * @param modello determina una struttura dati per il tipo di aerei e le varie informazioni
 * @param numero_modelli determina un puntatore di tipo intero per il passaggio del numero di modelli degli aerei
 */
void caricamento_info_modelli_aerei(_MODELLO *modello, int *numero_modelli);

/**
 * Funzione per il caricamento delle informazioni degli aerei
 *
 * @param aereo determina una struttura dati per i vari aeromobili e le varie informazioni
 * @param numero_aerei determina un puntatore di tipo intero per il passaggio del numero di aerei
 */
void caricamento_info_aeromobili (_AEROMOBILE *aereo, int *numero_aerei);

/**
 * Funzione per il caricamento delle informazioni dei voli
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni
 * @param numero_voli determina un puntatore di tipo intero per il passaggio del numero di voli
 */
void caricamento_info_voli (_VOLO *volo, int *numero_voli);

/**
 * Funzione per il caricamento delle informazioni sui codici IATA degli aeroporti
 *
 * @param aeroporto determina una struttura dati per i vari codici IATA e le varie informazioni
 * @param numero_aeroporti determina un puntatore di tipo intero per il passaggio del numero di aeroporti
 */
void caricamento_info_aeroporti (_AEROPORTO *aeroporto, int *numero_aeroporti);

/**
 * Funzione per l'acquisizione da file della password.
 *
 * @return Il valore della password in cifre
 */
long int acquisizione_password ();

/**
 * Funzione per la creazione del file di log.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni
 * @param numero_voli determina un puntatore di tipo intero per il passaggio del numero di voli
 */
void creazione_log (_VOLO *volo, const int numero_voli);

#endif /* GESTIONE_DATI_H_ */
