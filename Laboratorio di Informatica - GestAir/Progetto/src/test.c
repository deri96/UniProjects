/**
 * @file test.c
 *
 * @author Andrea De Rinaldis
 * @version 0.1
 * @copyright GNU Public Licence
 *
 * Questo file sorgente contiene tutte le funzioni per il testing del programma
 */

#include "main.h"
#include "test.h"
#include "gestione_dati.h"
#include "funzioni_varie.h"
#include "gestione_aeroporto.h"


//FUNZIONI DI INIZIALIZZAZIONE DELLE SUITE--------------------------------------------------------------------------------------------------
/**
 * Funzione di inizializzazione della suite
 *
 * @return 0
 */
int init_suite()
{
	return 0;
}

/**
 * Funzione di pulitura della suite
 *
 * @return 0
 */
int clean_suite()
{
	return 0;
}

//TEST DELLE FUNZIONI DEL FILE SORGENTE 'funzioni_varie.c'----------------------------------------------------------------------------------
/**
 * Test method per il test della funzione 'cambio_data_avanti()'.
 */
void test_cambio_data_avanti ()
{
	int anno = 2017; 				//variabile intera da analizzare per l'anno
	int mese = 2;					//variabile intera da analizzare per il mese
	int giorno = 29;				//variabile intera da analizzare per il giorno

	cambio_data_avanti(&anno, &mese, &giorno);					//chiamata della funzione da analizzare

	//------------------TESTING---------------------------
	CU_ASSERT_NOT_EQUAL (anno, 0);						//determina se l'anno è diverso da 0
	CU_ASSERT_TRUE (anno >= 2017);						//determina se l'anno è maggiore o uguale a 2017

	CU_ASSERT_NOT_EQUAL (mese, 0);						//determina se il mese è diverso da 0
	CU_ASSERT_TRUE (mese >= 1);							//determina se il mese è maggiore o uguale ad 1
	CU_ASSERT_TRUE (mese <= 12);						//determina se l'anno è minore o uguale a 12

	CU_ASSERT_NOT_EQUAL (giorno, 0);					//determina se il giorno è diverso da 0
	CU_ASSERT_TRUE (giorno >= 1);						//determina se il giorno è maggiore o uguale ad 1
	CU_ASSERT_TRUE (giorno <= 31);						//determina se il giorno è minore o uguale a 31

	if (mese == 2)
		CU_ASSERT_TRUE (giorno <= 29);					//se il mese è sabato allora determina che il giorno è minore o uguale a 29
}

/**
 * Test method per il test della funzione 'cambio_data_indietro()'.
 */
void test_cambio_data_indietro ()
{
	int anno = 2017; 				//variabile intera da analizzare per l'anno
	int mese = 2;					//variabile intera da analizzare per il mese
	int giorno = 29;				//variabile intera da analizzare per il giorno

	cambio_data_avanti(&anno, &mese, &giorno);					//chiamata della funzione da analizzare

	//------------------TESTING---------------------------
	CU_ASSERT_NOT_EQUAL (anno, 0);						//determina se l'anno è diverso da 0
	CU_ASSERT_TRUE (anno >= 2017);						//determina se l'anno è maggiore o uguale a 2017

	CU_ASSERT_NOT_EQUAL (mese, 0);						//determina se il mese è diverso da 0
	CU_ASSERT_TRUE (mese >= 1);							//determina se il mese è maggiore o uguale ad 1
	CU_ASSERT_TRUE (mese <= 12);						//determina se l'anno è minore o uguale a 12

	CU_ASSERT_NOT_EQUAL (giorno, 0);					//determina se il giorno è diverso da 0
	CU_ASSERT_TRUE (giorno >= 1);						//determina se il giorno è maggiore o uguale ad 1
	CU_ASSERT_TRUE (giorno <= 31);						//determina se il giorno è minore o uguale a 31

	if (mese == 2)
		CU_ASSERT_TRUE (giorno <= 29);					//se il mese è sabato allora determina che il giorno è minore o uguale a 29
}

//TEST DELLE FUNZIONI DEL FILE SORGENTE 'gestione_dati.c'--------------------------------------------------------------------------------------------------------
/**
 * Test method per il test della funzione 'caricamento_info_modelli_aerei'.
 */
void test_caricamento_info_modelli_aerei ()
{
	_MODELLO *modello;					//Struttura dati i cui campi sono da analizzare
	int numero_modelli = 0;				//variabile intera da analizzare per il numero di modelli

	modello = (_MODELLO*) malloc (MAX_NUMERO_MODELLI * sizeof(_MODELLO));					//allocazione della memoria per la struttura dati
	for (int i = 0; i < MAX_NUMERO_MODELLI; i ++)
	{
		modello[i].azienda = (string) malloc (DIMENSIONE_NOME_AZIENDA_COSTRUTTRICE * sizeof(string));
		modello[i].modello = (string) malloc (DIMENSIONE_NOME_MODELLO_AEREO * sizeof(string));
	}

	caricamento_info_modelli_aerei (modello, &numero_modelli);				//chiamata di funzione

	//-------TESTING---------------------------------------
	if ((CU_ASSERT_TRUE (numero_modelli > 0)))					//se si determina che il numero dei modelli è maggiore di 0
	{
		for (int i = 0; i < numero_modelli; i ++)						//allora si valutano tutti i modelli
		{
			CU_ASSERT_NOT_EQUAL (modello[i].azienda, '\0');						//che il nome dell'azoenda non deve essere una stringa vuota
			CU_ASSERT_NOT_EQUAL (modello[i].modello, '\0');						//che il nome del modello non deve essere una stringa vuota
			CU_ASSERT_TRUE (modello[i].propulsore == 'g' || modello[i].propulsore == 'e');			//che il propulsore deve essere od 'e' oppure 'g'
			CU_ASSERT_TRUE (modello[i].numero_motori > 0);						//che il numero di motori deve essere maggiore di 0
			CU_ASSERT_TRUE (modello[i].numero_massimo_passeggeri > 0);			//che il numero di posti per i passeggeri deve essere maggiore di 0
		}
	}

	free (modello);
}

/**
 * Test method per il test della funzione 'caricamento_info_aereomobili'.
 */
void test_caricamento_info_aeromobili ()
{
	_AEROMOBILE *aereo;					//Struttura dati i cui campi sono da analizzare
	int numero_aerei = 0;				//variabile intera da analizzare per il numero di aerei

	aereo = (_AEROMOBILE*) malloc (MAX_NUMERO_AEROMOBILI * sizeof(_AEROMOBILE));				//allocazione della memoria per la struttura dati
	for (int i = 0; i < MAX_NUMERO_AEROMOBILI; i ++)
	{
		aereo[i].modello = (string) malloc (DIMENSIONE_NOME_MODELLO_AEREO * sizeof(string));
		aereo[i].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
	}

	caricamento_info_aeromobili (aereo, &numero_aerei);						//chiamata della funzione da analizzare

	//-------TESTING---------------------------------------
	if ((CU_ASSERT_TRUE (numero_aerei > 0)))					//se si determina che il numero degli aerei è maggiore di 0
	{
		for (int i = 0; i < numero_aerei; i ++)						//allora si valutano tutti gli aerei
		{
			CU_ASSERT_NOT_EQUAL (aereo[i].modello, '\0');					//che il nome del modello non sia una stringa vuota
			CU_ASSERT_NOT_EQUAL (aereo[i].targa, '\0');						//che la targa dell'aereo non si auna stringa vuota
		}
	}

	free (aereo);
}

/**
 * Test method per il test della funzione 'caricamento_info_voli'.
 */
void test_caricamento_info_voli()
{
	_VOLO *volo;						//Struttura dati i cui campi sono da analizzare
	int numero_voli = 0;				//variabile intera da analizzare per il numero di voli

	volo = (_VOLO*) malloc (MAX_NUMERO_VOLI * sizeof(_VOLO));						//allocazione della memoria della struttura dati
	for (int i = 0; i < MAX_NUMERO_VOLI; i ++)
	{
		volo[i].codice_id = (string) malloc (DIMENSIONE_CODICE_VOLO * sizeof(string));
		volo[i].nome_compagnia = (string) malloc (DIMENSIONE_NOME_COMPAGNIA_AEREA * sizeof(string));
		volo[i].targa = (string) malloc (NUMERO_LETTERE_TARGA * sizeof(string));
		volo[i].gate = (string) malloc (DIMENSIONE_NOME_GATE * sizeof(string));
		volo[i].codice_iata = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
	}

	caricamento_info_voli(volo, &numero_voli);						//chiamata della funzione da analizzare

	//-------TESTING---------------------------------------
	if ((CU_ASSERT_TRUE (numero_voli > 0)))							//se si determina che il numero dei voli è maggiore di 0
	{
		for (int i = 0; i < numero_voli; i ++)						//allora si valutano tutti i voli
		{
			CU_ASSERT_NOT_EQUAL (volo[i].codice_id, '\0');								//che il codice del volo non sia una stringa vuota
			CU_ASSERT_NOT_EQUAL (volo[i].nome_compagnia, '\0');							//che il nome della compagnia aerea non sia una stringa vuota
			CU_ASSERT_NOT_EQUAL (volo[i].targa, '\0');									//che la targa del veicolo non sia una stringa vuota
			CU_ASSERT_TRUE (volo[i].partenza_arrivo == 'p' || volo[i].partenza_arrivo == 'P' || volo[i].partenza_arrivo == 'a' || volo[i].partenza_arrivo == 'A');				//che i flag di partenza e arrivo siano accettati
			CU_ASSERT_NOT_EQUAL (volo[i].codice_iata, '\0');							//che il codice iata dell'aeroporto non sia una stringa vuota
			CU_ASSERT_TRUE (volo[i].partenza.minuto >= 0 && volo[i].partenza.minuto < 60);			//che il minuto di partenza sia tra 0 e 59
			CU_ASSERT_TRUE (volo[i].partenza.ora >= 0 && volo[i].partenza.ora < 24);				//che l'ora di partenza sia tra 0 e 23
			CU_ASSERT_TRUE (volo[i].partenza.giorno >=1 && volo[i].partenza.giorno <= 31);			//che il giorno di partenza sia tra 1 e 31
			CU_ASSERT_TRUE (volo[i].partenza.mese >= 1 && volo[i].partenza.mese <= 12);			//che il mese di partenza sia tra 1 e 12
			CU_ASSERT_TRUE (volo[i].partenza.anno >= 2017);											//che l'anno di partenza sia maggiore di 2017
			CU_ASSERT_NOT_EQUAL (volo[i].partenza.data_estesa, 0);									//che la data estesa di partenza sia diverso da 0
			CU_ASSERT_TRUE (volo[i].arrivo.minuto >= 0 && volo[i].arrivo.minuto < 60);			//la stessa cosa per l'orario di arrivo
			CU_ASSERT_TRUE (volo[i].arrivo.ora >= 0 && volo[i].arrivo.ora < 24);
			CU_ASSERT_TRUE (volo[i].arrivo.giorno >=1 && volo[i].arrivo.giorno <= 31);
			CU_ASSERT_TRUE (volo[i].arrivo.mese >= 1 && volo[i].arrivo.mese <= 12);
			CU_ASSERT_TRUE (volo[i].arrivo.anno >= 2017);
			CU_ASSERT_NOT_EQUAL (volo[i].arrivo.data_estesa, 0);
			CU_ASSERT_TRUE (volo[i].numero_passeggeri > 0);									//che il numero di passeggeri sia maggiore di 0
			CU_ASSERT_NOT_EQUAL (volo[i].gate, '\0');										//che il nome del gate non sia una stringa vuota
			CU_ASSERT_TRUE (volo[i].cancellato == 'n' || volo[i].cancellato == 'N');		//che il flag di cancellazione sia disattivato
			CU_ASSERT_TRUE (volo[i].emergenza == 'n' || volo[i].emergenza == 'N');		//che il flag di emergenza sia disattivato
			CU_ASSERT_TRUE (volo[i].autorizzato == 'n' || volo[i].autorizzato == 'N');		//che il flag di autorizzazione sia disattivato
		}
	}

	free(volo);
}

/**
 * Test method per il test della funzione 'caricamento_info_aeroporti'.
 */
void test_caricamento_info_aeroporti ()
{
	_AEROPORTO *aeroporto;						//Struttura dati i cui campi sono da analizzare
	int numero_aeroporti = 0;					//variabile intera da analizzare per il numero di aeroporti

	aeroporto = (_AEROPORTO*) malloc (MAX_NUMERO_AEROPORTI * sizeof(_AEROPORTO));				//allocazione dinamica sella struttura dati
	for (int i = 0; i < MAX_NUMERO_AEROPORTI; i ++)
	{
		aeroporto[i].codice = (string) malloc (DIMENSIONE_CODICE_IATA * sizeof(string));
		aeroporto[i].nome = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));
	}

	caricamento_info_aeroporti(aeroporto, &numero_aeroporti);					//chiamata della funzione da analizzare

	//----------------TESTING-------------------------------
	if ((CU_ASSERT_TRUE (numero_aeroporti > 0)))							//se si determina che il numero degli aeroporti è maggiore di 0
	{
		for (int i = 0; i < numero_aeroporti; i ++)						//allora si valutano tutti gli aeroporti
		{
			CU_ASSERT_NOT_EQUAL (aeroporto[i].codice, '\0');				//che il codice dell'aeroporto non sia una stringa vuota
			CU_ASSERT_NOT_EQUAL (aeroporto[i].nome, '\0');					//che il nome dell'aeroporto non sia una stringa vuota
		}
	}

	free (aeroporto);
}

/**
 * Test method per il test della funzione 'caricamento_info_aeroporti'.
 */
void test_acquisizione_password()
{
	long int test_password = 0;							//variabile per la password da testare

	test_password = acquisizione_password();			//chiamata della funzione da testare

	//----------------TESTING-------------------------------
	CU_ASSERT_TRUE (test_password > 0);					//valuta se la password è maggiore di 0
}


//TEST DELLE FUNZIONI DEL FILE SORGENTE 'gestione_aeroporto.c'--------------------------------------------------------------------------------------------------------
/**
 * Test method per il test della funzione 'mergesort_data_per_arrivo'.
 */
void test_mergesort_data_per_arrivo ()
{
	_VOLO *test_volo;							//struttura dati per il volo da testare
	const int NUMERO_VALORI_TEST = 5;				//costante per il numero dei valori da testare

	test_volo = (_VOLO*) malloc (NUMERO_VALORI_TEST * sizeof(_VOLO));					//allocazione dinamica della memoria della struttura dati di test

	test_volo[0].arrivo.data_estesa = 3;						//definizione dei valori di arrivo della struttura dati
	test_volo[1].arrivo.data_estesa = 1;
	test_volo[2].arrivo.data_estesa = 4;
	test_volo[3].arrivo.data_estesa = 5;
	test_volo[4].arrivo.data_estesa = 2;

	mergesort_data_per_arrivo(test_volo, 0, NUMERO_VALORI_TEST - 1);					//chiamata della funzione di ordinamento

	//----------------TESTING-------------------------------
	CU_ASSERT_TRUE (test_volo[0].arrivo.data_estesa > test_volo[1].arrivo.data_estesa);				//valuta se i valori del volo sono maggiori dei successivi (ovvero se l'ordinamento decrescente è ok)
	CU_ASSERT_TRUE (test_volo[1].arrivo.data_estesa > test_volo[2].arrivo.data_estesa);
	CU_ASSERT_TRUE (test_volo[2].arrivo.data_estesa > test_volo[3].arrivo.data_estesa);
	CU_ASSERT_TRUE (test_volo[3].arrivo.data_estesa > test_volo[4].arrivo.data_estesa);

	free (test_volo);				//libera la memoria allocata dinamicamente
}

/**
 * Test method per il test della funzione 'mergesort_data_per_partenza'.
 */
void test_mergesort_data_per_partenza ()
{
	_VOLO *test_volo;							//struttura dati per il volo da testare
	const int NUMERO_VALORI_TEST = 5;				//costante per il numero dei valori da testare

	test_volo = (_VOLO*) malloc (NUMERO_VALORI_TEST * sizeof(_VOLO));					//allocazione dinamica della memoria della struttura dati di test

	test_volo[0].partenza.data_estesa = 3;						//definizione dei valori di arrivo della struttura dati
	test_volo[1].partenza.data_estesa = 1;
	test_volo[2].partenza.data_estesa = 4;
	test_volo[3].partenza.data_estesa = 5;
	test_volo[4].partenza.data_estesa = 2;

	mergesort_data_per_partenza(test_volo, 0, NUMERO_VALORI_TEST - 1);					//chiamata della funzione di ordinamento

	//----------------TESTING-------------------------------
	CU_ASSERT_TRUE (test_volo[0].partenza.data_estesa < test_volo[1].partenza.data_estesa);				//valuta se i valori del volo sono minori dei successivi (ovvero se l'ordinamento crescente è ok)
	CU_ASSERT_TRUE (test_volo[1].partenza.data_estesa < test_volo[2].partenza.data_estesa);
	CU_ASSERT_TRUE (test_volo[2].partenza.data_estesa < test_volo[3].partenza.data_estesa);
	CU_ASSERT_TRUE (test_volo[3].partenza.data_estesa < test_volo[4].partenza.data_estesa);

	free (test_volo);				//libera la memoria allocata dinamicamente
}

/**
 * Test method per il test della funzione 'riconoscimento_aeroporto'.
 */
void test_riconoscimento_aeroporto ()
{
	const int NUMERO_VALORI_TEST = 5;			//costante del numero di test da effettuare
	_AEROPORTO *aeroporto;						//struttura dati da analizzare
	string test_aeroporto;						//stringa per il nome dell'aeroporto da testare
	string test_codice_da_cercare = "FCO";		//stringa pèer il codice dell'aeroporto da testare

	aeroporto = (_AEROPORTO*) malloc (NUMERO_VALORI_TEST * sizeof(_AEROPORTO));					//allocazione dinamica della struttura dati

	aeroporto[0].nome = "Milano Linate";			aeroporto[0].codice = "LIN";				//definizione della struttura dati
	aeroporto[1].nome = "Londra Gatwick";			aeroporto[1].codice = "LGK";
	aeroporto[2].nome = "Roma Fiumicino";			aeroporto[2].codice = "FCO";
	aeroporto[3].nome = "Riga";						aeroporto[3].codice = "RIX";
	aeroporto[4].nome = "Zurigo";					aeroporto[4].codice = "ZRH";

	test_aeroporto = (string) malloc (DIMENSIONE_NOME_AEROPORTO * sizeof(string));			//allocazione dinamica della memoria della stringa

	test_aeroporto = riconoscimento_aeroporto(test_codice_da_cercare, aeroporto, NUMERO_VALORI_TEST);				//chiamata della funzione da analizzare

	//----------------TESTING-------------------------------
	CU_ASSERT_STRING_EQUAL (test_aeroporto, "Roma Fiumicino");		//se cercando il nome dell'aereoporto partendo dal codice FCO si ottiene come risultato la stringa 'roma fiumicino' allora è corretto

	free (test_aeroporto);				//libera la memoria allocata dinamicamente
}
