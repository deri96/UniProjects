/*
 * test.h
 *
 *  Created on: 06 giu 2017
 *      Author: Andrea
 */

#ifndef SRC_TEST_H_
#define SRC_TEST_H_

#include <stdio.h>
#include <stdlib.h>
#include "CUnit/Basic.h"

#define NDEBUG

/**
 * Funzione di inizializzazione della suite
 *
 * @return 0
 */
int init_suite ();

/**
 * Funzione di pulitura della suite
 *
 * @return 0
 */
int clean_suite ();

/**
 * Test method per il test della funzione 'cambio_data_avanti()'.
 */
void test_cambio_data_avanti ();

/**
 * Test method per il test della funzione 'cambio_data_indietro()'.
 */
void test_cambio_data_indietro ();

/**
 * Test method per il test della funzione 'caricamento_info_modelli_aerei'.
 */
void test_caricamento_info_modelli_aerei ();

/**
 * Test method per il test della funzione 'caricamento_info_aereomobili'.
 */
void test_caricamento_info_aeromobili ();

/**
 * Test method per il test della funzione 'caricamento_info_voli'.
 */
void test_caricamento_info_voli ();

/**
 * Test method per il test della funzione 'caricamento_info_aeroporti'.
 */
void test_caricamento_info_aeroporti ();

/**
 * Test method per il test della funzione 'caricamento_info_aeroporti'.
 */
void test_acquisizione_password ();

/**
 * Test method per il test della funzione 'mergesort_data_per_arrivo'.
 */
void test_mergesort_data_per_arrivo ();

/**
 * Test method per il test della funzione 'mergesort_data_per_partenza'.
 */
void test_mergesort_data_per_partenza ();

/**
 * Test method per il test della funzione 'riconoscimento_aeroporto'.
 */
void test_riconoscimento_aeroporto ();



#endif /* SRC_TEST_H_ */
