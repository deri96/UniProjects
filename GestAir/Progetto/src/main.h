/**
 * @file main.h
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Contenuto:
 * Questo file sorgente contiene le definizioni delle costanti piu utilizzate e
 * contiene le astrazioni di tipo piu usate all'interno del progetto. Questo file sorgente
 * e' usato da tutti gli altri moduli poiche al suo interno contienetutte le defnzioni
 * dei tipi delle strutture, sulle quali il programma va a lavorare e gestire i dati.
 */

#ifndef MAIN_H_
#define MAIN_H_

#include <stdio.h>
#include <stdlib.h>
#include <string.h>				///header per la gestione delle funzioni suulle stringhe
#include <time.h>				///header per la gestione del tempo e dell'orologio interno all'elaboratore

//DEFINIZIONE DELLE COSTANTI-----------------------------------------------------------------------------------
/**
 * Costante per la definizone della dimensione del nome dell'azienda costruttrice degli aerei.
 */
#define DIMENSIONE_NOME_AZIENDA_COSTRUTTRICE 20

/**
 * Costante per la definizione della dimensione del nome del modello dell'aereo
 */
#define DIMENSIONE_NOME_MODELLO_AEREO 20

/**
 * Costante per la definizone del numero di lettere della targa dell'aereo
 */
#define NUMERO_LETTERE_TARGA 6

/**
 * Costante per la definizione della dimensione del codice di volo
 */
#define DIMENSIONE_CODICE_VOLO 6

/**
 * Costante per la definizone della dimenzione del nome della compagnia aerea
 */
#define DIMENSIONE_NOME_COMPAGNIA_AEREA 20

/**
 * Costante per la definizone della dimensione del nome del gate
 */
#define DIMENSIONE_NOME_GATE 2

/**
 * Costante per la definizione della dimensione del codice IATA di un volo
 */
#define DIMENSIONE_CODICE_IATA 3

/**
 * Costante per la definizione del massimo numero di modelli di aerei
 */
#define MAX_NUMERO_MODELLI 200

/**
 * Costante per la definizione del amssimo numero di aeromobili
 */
#define MAX_NUMERO_AEROMOBILI 200

/**
 * Costante per la definizione del massimo numero di voli
 */
#define MAX_NUMERO_VOLI 200

/**
 * Costante per la definizione del massimo numero di aeroporti di arrivo-partenza
 */
#define MAX_NUMERO_AEROPORTI 100

/**
 * Costante per la definizione della dimensione del nome dell'aeroporto
 */
#define DIMENSIONE_NOME_AEROPORTO 25

/**
 * Costante per la definizione della dimensione della stringa del menu
 */
#define DIMENSIONE_STRINGA_MENU 30

//ASTRAZIONE DI NUOVI TIPI-------------------------------------------------------------------------------
/**
 * Il nuovo tipo string permette la creazione di array di caratteri senza dover ricorrere sempre all'utilizzo
 * della dicitura char*
 */
typedef char* string;

/**
 * Il nuovo tipo _DATA permette la creazione di strutture dati per la data di un volo
 */
typedef struct
{
	int giorno;					///campo per la definizione del giorno del volo
	int mese;					///campo per la definizione del mese del volo
	int anno;					///campo per la definizione dell'anno del volo
	int minuto;					///campo per la definizione del minuto del volo
	int ora;					///campo per la definizione dell'ora del volo
	double data_estesa;				///questo campo della struttura serve per la creazione della data estesa, ovvero una tipologia di data in cui tutti i sottocampi sono uniti (utile per l'ordinamento)
} _DATA;

/**
 * Il nuovo tipo _MODELLO permette la crezione di strutture dati per la tipologia di un modello di aereo
 */
typedef struct
{
	string azienda;					///campo per la definizione del nome dell'azienda del modello
	string modello;					///campo per la definizione del tipo di modello
	char propulsore;					///campo per la definizione del tipo di propulsore
	int numero_motori;					///campo per la definizione del numero di motori del modello
	int numero_massimo_passeggeri;		///campo per la definizione del numero massimo di passeggeri del modello
} _MODELLO;

/**
 * Il nuovo tipo _AEROMOBILE permette la creazione di strutture dati per la definizione di aerei
 */
typedef struct
{
	string modello;					///campo per la definizione del nome del modello dell'aereo
	string targa;					///campo per la definizione della targa dell'aereo
} _AEROMOBILE;

/**
 * Il nuovo tipo _VOLO permette la creazione di strutture dati per la definizione di voli in
 *  transito all'aeroporto
 */
typedef struct
{
	string codice_id;						///campo per la definizione del codice di volo
	string nome_compagnia;					///campo per la definizione del nome della compagnaia aerea
	string targa;							///campo per la determinazione della targa del volo
	char partenza_arrivo;					///campo per la determinazione del tipo di volo (partenza o arrivo)
	string codice_iata;						///campo per la determinazione del codice iata dell'aeroporto
	_DATA partenza;							///campo per la definizione della partenza del volo
	_DATA arrivo;							///campo per la definizione dell'arrivo del volo
	_DATA effettiva;						///campo per la defnizione della data effettiva di arrivo a Bari-Palese
	int numero_passeggeri;					///campo per la definizione del numero di passeggeri del volo
	string gate;							///campo per la determinazione del tipo di gate del volo
	char cancellato;						///campo per la determinazione del flag di cancellazione
	char emergenza;							///campo per la determinazione del lfag di emergenza
	char autorizzato;						///campo per la determinazione del flag di autorizzazione
} _VOLO;

/**
 * Il nuovo tipo _AEROPORTO permette la creazione di strutture dati per la definizione del nome
 * degli aeroporti
 */
typedef struct
{
	string codice;				///campo per la definizione del codice dell'aeroporto
	string nome;					///campo per la definizione del nome dell'aeroporto
} _AEROPORTO;

#endif /* MAIN_H_ */
