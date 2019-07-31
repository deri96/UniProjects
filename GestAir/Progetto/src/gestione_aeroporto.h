/**
 * @file gestione_aeroporto.h
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * Questo file contiene i prototipi delle funzioni create e gestite ne file sorgente "gestione_aeroporto.c"
 */

#ifndef GESTIONE_AEROPORTO_H_
#define GESTIONE_AEROPORTO_H_

/**
 * Funzione per la stampa ordinata della lista dei voli in partenza.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 */
void stampa_lista_ordinata_voli_in_partenza (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti);

/**
 * Funzione per la stampa ordinata della lista dei voli in arrivo.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 */
void stampa_lista_ordinata_voli_in_arrivo (_VOLO *volo, const int numero_voli, _AEROPORTO *aerooporto, const int numero_aeroporti);

/**
 * Funzione per l'ordinamento della lista dei voli in arrivo.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param sinistra determina un intero per la variabile di individuazione del primo elemento da sinistra dell'array.
 * @param destra determina un intero per la variabile di individuazione dell'ultimo elemento da sinistra dell'array.
 */
void mergesort_data_per_arrivo (_VOLO *volo, int sinistra, int destra);

/**
 * Funzione per l'ordinamento delle sottostrutture dell'array.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param sinistra determina un intero per la variabile di individuazione del primo elemento da sinistra dell'array.
 * @param centro determina un intero per la variabile di individuazione del valore centrale dell'array
 * @param destra determina un intero per la variabile di individuazione dell'ultimo elemento da sinistra dell'array.
 */
void merge_data_per_arrivo (_VOLO *volo, int sinistra, int centro, int destra);

/**
 * Funzione per l'ordinamento della lista dei voli in partenza.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param sinistra determina un intero per la variabile di individuazione del primo elemento da sinistra dell'array.
 * @param destra determina un intero per la variabile di individuazione dell'ultimo elemento da sinistra dell'array.
 */
void mergesort_data_per_partenza (_VOLO *volo, int sinistra, int destra);

/**
 * Funzione per l'ordinamento delle sottostrutture dell'array.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param sinistra determina un intero per la variabile di individuazione del primo elemento da sinistra dell'array.
 * @param centro determina un intero per la variabile di individuazione del valore centrale dell'array
 * @param destra determina un intero per la variabile di individuazione dell'ultimo elemento da sinistra dell'array.
 */
void merge_data_per_partenza (_VOLO *volo, int sinistra, int centro, int destra);


/**
 * Funzione per la ricerca dell'aereoporto partendo dal codice IATA
 *
 * @param codice_da_cercare determina una stringa per l'individuazione del codice IATA da cercare
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 * @return
 */
string riconoscimento_aeroporto (string codice_da_cercare, _AEROPORTO *aeroporto, const int numero_aeroporti);

/**
 * Funzione per la stampa a video del volo partendo dal codice.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 */
void stampa_volo_ricerca_per_codice (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti);

/**
 * Funzione per la stampa a video dell'aeromobile partendo dal codice.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 * @param aereo determina una struttura dati per i vari aerei
 * @param numero_aerei determina una costante di tipo intero per il numero degli aerei
 * @param modello determina una struttura dati per i vari modelli degli aerei
 * @param numero_modelli determina una costante di tipo intero per il numero di modelli di aerei
 */
void stampa_aereo_ricerca_per_codice (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti, _AEROMOBILE* aereo, const int numero_aerei, _MODELLO* modello, const int numero_modelli);

/**
 * Funzione per la cancellazione di un volo.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 */
void cancellazione_volo (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti);


/**
 * Funzione per la modifica del gate di attracco-partenza un volo.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 * @param aeroporto determina una struttura dati per i vari aeroporti e le varie informazioni.
 * @param numero_aeroporti determina una costante di tipo intero per il numero di aeroporti
 */
void modifica_gate (_VOLO *volo, const int numero_voli, _AEROPORTO *aeroporto, const int numero_aeroporti);

/**
 * Funzione per la gestione dei voli di'emergenza.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 */
void gestione_emergenze (_VOLO *volo, const int numero_voli);

/**
 * Funzione per l'autorizzazione dei voli in partenza e arrivo.
 *
 * @param volo determina una struttura dati per i vari voli e le varie informazioni.
 * @param numero_voli determina una costante di tipo intero per il numero di voli.
 */
void autorizzazione_voli (_VOLO *volo, const int numero_voli);

#endif /* GESTIONE_AEROPORTO_H_ */
