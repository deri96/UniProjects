package watark;

import java.sql.Date;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;


public class ServletLayout {

	static String root = "";
	
	/**
	 * Metodo per la restituzione del layout dell'header
	 * @param root radice per l'acqusizione dei file
	 * @return testo del layout dell'header
	 */
	public static String getHeader(String passedRoot) {
		
		root = passedRoot;
		
		String header = 
				"<!DOCTYPE html>" + 
				"<html lang='en'>" +
				"<head> \r\n" + 
				"<meta charset='UTF-8'> \r\n" + 
				"<title>WatArk</title>" +  // <--- cambiare il titolo\r\n
				"<link rel='stylesheet' type='text/css' href='" + root + "/static/style.css' />\r\n" + 
				"<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">\r\n" + 
				"<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>\r\n" + 
				"<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>\r\n" + 
				"<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>\r\n" + 
				"</head> \r\n" + 
				"<header>\r\n" + 
				
				"<nav id='ddmenu'>\r\n" + 
				"<div class='menu-icon'></div> \r\n" + 
				"<ul><li class='no-sub'><a class='top-heading' href='" + root + "/home'>HOME</a></li> \r\n" + 
				"<li><div class='top-heading'>Clienti</div> \r\n" + 
				"<i class='caret'></i>\r\n" + 
				"<div class='dropdown'>\r\n" + 
				"<div class='dd-inner'>\r\n" + 
				"<div class='column'> \r\n" + 
				"<h3>Operazioni sui clienti</h3>\r\n" + 
				"<div style='border-top: black; border-top-style:double; border-top-width: 2px;'>" +
				"<a href='" + root + "/listaClienti'>Lista clienti</a> \r\n" + 
				"</div><div style='border-top: black; border-top-style:double;'>" +
				"<a href='" + root + "/nuovoCliente'>Aggiungi cliente</a>\r\n" + "</div>" +
				"</div></div></div></li>\r\n" + 
				"<li><div class='top-heading'>Biglietteria</div> \r\n" + 
				"<i class='caret'></i>\r\n" + 
				"<div class='dropdown'>\r\n" + 
				"<div class='dd-inner'>\r\n" + 
				"<div class='column'> \r\n" + 
				"<h3>Operazioni sulla biglietteria</h3>\r\n" + 
				"<div style='border-top: black; border-top-style:double; border-top-width: 2px;'>" +
				"<a href='" + root + "/listaBiglietti'>Lista biglietti</a> \r\n" + 
				"<a href='" + root + "/listaAbbonamenti'>Lista abbonamenti</a>\r\n" + 
				"<a href='" + root + "/listaPriority'>Lista Priority</a>\r\n" + 
				"</div><div style='border-top: black; border-top-style:double;'>" +
				"<a href='" + root + "/nuovoBiglietto'>Aggiungi biglietto</a>\r\n" + 
				"<a href='" + root + "/nuovoAbbonamento'>Aggiungi abbonamento</a>\r\n" + 
				"<a href='" + root + "/nuovoPriority'>Aggiungi servizio Priority</a>\r\n" + 
				"</div></div></div></div></li>\r\n" +
				"<li><div class='top-heading'>Eventi</div> \r\n" + 
				"<i class='caret'></i>\r\n" + 
				"<div class='dropdown'>\r\n" + 
				"<div class='dd-inner'>\r\n" + 
				"<div class='column'> \r\n" + 
				"<h3>Operazioni sugli eventi</h3>\r\n" + 
				"<div style='border-top: black; border-top-style:double; border-top-width: 2px;'>" +
				"<a href='" + root + "/listaSpettacoli'>Lista spettacoli</a> \r\n" + 
				"<a href='" + root + "/listaEventi'>Lista eventi</a>\r\n" + 
				"</div><div style='border-top: black; border-top-style:double;'>" +
				"<a href='" + root + "/nuovoSpettacolo'>Aggiungi spettacolo</a>\r\n" + 
				"<a href='" + root + "/nuovoEvento'>Aggiungi evento</a>\r\n" + 
				"</div></div></div></div></li>\r\n" +
				"<li><div class='top-heading'>Altro</div> \r\n" + 
				"<i class='caret'></i>\r\n" + 
				"<div class='dropdown'>\r\n" + 
				"<div class='dd-inner'>\r\n" + 
				"<div class='column'> \r\n" + 
				"<h3>Altre operazioni</h3>\r\n" + 
				"<div style='border-top: black; border-top-style:double; border-top-width: 2px;'>" +
				"<a href='" + root + "/listaTipiPagamento'>Lista tipi di pagamento</a> \r\n" + 
				"<a href='" + root + "/listaCategorie'>Lista categorie</a>\r\n" + 
				"<a href='" + root + "/listaAttrazioni'>Lista attrazioni</a>\r\n" + 
				"</div><div style='border-top: black; border-top-style:double;'>" +
				"<a href='" + root + "/nuovoTipoPagamento'>Aggiungi tipo di pagamento</a>\r\n" + 
				"<a href='" + root + "/nuovaCategoria'>Aggiungi categoria</a>\r\n" + 
				"<a href='" + root + "/nuovaAttrazione'>Aggiungi attrazione</a>\r\n" + 
				"</div><div style='border-top: black; border-top-style:double;'>" +
				"<a href='" + root + "/infoIncassoMensile'>Informazioni sull'incasso</a>\r\n" + 
				"</div></div></div></div></li>\r\n" +
				"<script src='" + root + "/static/script.js'></script>\r\n" + 
				"</header>";
		
		return header;
	}

	
	/**
	 * Metodo per la restituzione del layout dell'inizializzazione del body
	 * @return testo del layout dell'inizializzazione del body
	 */
	public static String getBodyInit() {
		
		String body = "<body style='background-color:#6b88a7; color:whitesmoke; font-family:\"HWYGOTH\";'><div id='textbody'>";
		
		return body;
	}


	/**
	 * Metodo per la restituzione del layout della chiusura dei
	 * @return testo del layout della chiusura dei tag
	 */
	public static String getClosing() {
		
		String closing = "</div></body></html>";
		
		return closing;
	}
	
	
	/**
	 * Metodo per la restituzione del layout della homepage
	 * @return testo del layout della homepage
	 */
	public static String getHomePage() {
		
		String page = "";
		
		page += "<h1 style='font-size:250%;'><strong>BENVENUTO/A SU WATARK!</strong><h1>" +
				"<h2><form method='post' class='rapidsearch'>" + 
				"<p><h5>Inizia subito effettuando una <strong>ricerca rapida</strong> o scorrendo la navbar.</h5></p>" +
				"<p><input type='text' name='ricerca'>" +
				"<button type='submit' class='btn btn-info' style='margin-left: 2%'>Cerca</button></p>" +
				"<h6><p><input type='radio' name='tiporicerca' value='cliente' style='margin-left: 2%; margin-right: 0.5%;' checked>Clienti " +
				"<input type='radio' name='tiporicerca' value='biglietto' style='margin-left: 2%; margin-right: 0.5%;'>Biglietti " +
				"<input type='radio' name='tiporicerca' value='abbonamento' style='margin-left: 2%; margin-right: 0.5%;'>Abbonamenti" +
				"<input type='radio' name='tiporicerca' value='priority' style='margin-left: 2%; margin-right: 0.5%;'>Priority" +
				"<input type='radio' name='tiporicerca' value='evento' style='margin-left: 2%; margin-right: 0.5%;'>Evento" +
				"<input type='radio' name='tiporicerca' value='spettacolo' style='margin-left: 2%; margin-right: 0.5%;'>Spettacolo" +
				"<input type='radio' name='tiporicerca' value='attrazione' style='margin-left: 2%; margin-right: 0.5%;'>Attrazione</p></h6>" +
				"</h2></form>" +
				"<p><h2><strong>Guida alla ricerca rapida</strong></h2></p>" +
				"<p><h5 style='text-align: justify;'>La ricerca rapida permette di poter effettuare una veloce interrogazione del sistema " +
				"riguardo una particolare categoria. Basta inserire l'elemento e selezionare " +
				"la categoria nella quale andare ad effettuare la ricerca ed inviare la richiesta.</p><p> " +
				"Il risultato dell'interrogazione del sistema sarà visibile a video in modo tale da poter " +
				"proseguire con il proprio scopo.</p><p>" +
				"Le ricerche vengono effettuate in base al cognome del cliente per le categorie " +
				"<strong>\"Cliente\"</strong>, <strong>\"Biglietti\"</strong>, <strong>\"Abbonamenti\"</strong> e " +
				"<strong>\"Priority\"</strong>, in base al nome dell'evento per le categorie " +
				"<strong>\"Evento\"</strong> e <strong>\"Spettacolo\"</strong>, in base al nome dell'attrazione " +
				"per la categoria <strong>\"Attrazione\"</strong>.</h5>";
		
		
						
//				"<h3>Scegli dalla navbar l'azione che vuoi compiere.</h3>";
		
		return page;
	}
	
	
	/**
	 * Metodo per la restituzione del layout della pagina della lista dei clienti
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getListaClientiPage(ResultSet results) {
	
		String page = "";
		
		try {	
			
			page = "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEI CLIENTI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valore' placeholder='Cerca cliente per cognome'>" +
					"<button type='submit' class='btn btn-info' style='margin-left: 2%; margin-right: 45%;'>Cerca</button></form>" +
					"<a href='"+ root + "/nuovoCliente' role='button' " +
					"class='btn btn-info'>Nuovo cliente</a></p></div>" + 
					"<th>E-mail</th><th>Cognome</th><th>Nome</th><th>Data di nascita</th><th>Operazioni</th>";

			while(results.next()) {

				LocalDate localBirthDate = LocalDate.parse(results.getString("DataNascita"));
				String birth = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBirthDate);
				
				page += "<tr><td>" + results.getString("Email") + "</td><td>" + 
						results.getString("Cognome") + "</td><td>" + 
						results.getString("Nome") + "</td><td>" + 
						birth + "</td><td>";
				
				page += "<a type='button' class='btn btn-primary' href='" + root + "/visualizzaCliente?email=" +
						results.getString("Email") + "'>Visualizza</a></td></tr>";
				
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}

	
	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo cliente
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoClientePage(int error) {
		
		String page = "";

		LocalDate localDate = LocalDate.now().minusYears(18);
		String legalAgeDate = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		page += "<p><label class='titlepage'><strong>INSERIMENTO NUOVO CLIENTE</strong></label></p>";
						
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" Esiste gia un altro account con tale email</div>";
		else if(error == 0)
			page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
					" L'account è stato inserito con successo</div>";
		
		page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
				"<td><strong>E-MAIL </strong></td><td><input type='email' name='email' required></td></tr>" +
				"<td><strong>PASSWORD </strong></td><td><input type='text' name='password' required></td></tr>" +
				"<td><strong>COGNOME </strong></td><td><input type='text' name='cognome' required></td></tr>" +
				"<td><strong>NOME </strong></td><td><input type='text' name='nome' required></td></tr>" +
				"<td><strong>INDIRIZZO </strong></td><td><input type='text' name='indirizzo' required></td></tr>" +
				"<td><strong>DATA DI NASCITA </strong></td><td><input type='date' name='datanascita' min='1900-01-01' " +
				"max='" + legalAgeDate + "' required></td><tr></table>" +
				"<div class='opbar'><a href='"+ root + "/listaClienti' role='button' class='btn btn-primary'>Torna alla lista</a>" +
				"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
		
		return page;
	}

	
	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica di un cliente
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaClientePage(ResultSet result, int error) {
		
		String page = "";

		try {
			
			LocalDate localDate = LocalDate.now().minusYears(18);
			String legalAgeDate = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);

			page += "<p><label class='titlepage'><strong>MODIFICA CLIENTE</strong></label></p>";
					
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un account con la stessa e-mail</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" L'account è stato modificato con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<td><strong>E-MAIL </strong></td><td><input type='email' name='email' value='" + result.getString("email") + "' required></td></tr>" +
					"<td><strong>PASSWORD </strong></td><td><input type='text' name='password' value='" + result.getString("password") + "' required></td></tr>" +
					"<td><strong>COGNOME </strong></td><td><input type='text' name='cognome' value='" + result.getString("cognome") + "' required></td></tr>" +
					"<td><strong>NOME </strong></td><td><input type='text' name='nome' value='" + result.getString("nome") + "' required></td></tr>" +
					"<td><strong>INDIRIZZO </strong></td><td><input type='text' name='indirizzo' value='" + result.getString("indirizzo") + "' required></td></tr>" +
					"<td><strong>DATA DI NASCITA </strong></td><td><input type='date' name='datanascita' min='1900-01-01' " +
					"max='" + legalAgeDate + "'" + "value='" + Date.valueOf(result.getString("datanascita")) + "' required></td><tr></table>" +
					"<div class='opbar'><a href='"+ root + "/listaClienti' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;

		} catch (SQLException e) {

			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina di cancellazione dell'utente
	 * @param email
	 * @param error
	 * @return
	 */
	public static String getCancellaClientePage(String email, int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>CANCELLAZIONE CLIENTE</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" La cancellazione dell'account non è avvenuta.</div>";
		
		page += "<p style='font-size: 150%;'><Strong>Attenzione!</Strong> Si sta cercando di cancellare il cliente associato "
				+ "all'e-mail " + email + ".</p>"
				+ "<p style='font-size: 150%;'>Questo è un processo irreversibile, eliminerà definitivamente il cliente ed ogni"
				+ " oggetto associato ad esso, ovvero i biglietti acquistati, gli abbonamenti acquistati"
				+ " e le informazioni riguardo il servizio Priority.</p>"
				+ "<p style='font-size: 150%;'>Sei sicuro di voler proseguire?</p>"
				+ "<form method='post'><input type='hidden' value='\" + email + \"'>"
				+ "<p><a type='button' class='btn btn-primary' href='" + root + "/listaClienti'>No</a>"
				+ "<button type='submit' class='btn btn-danger' style='margin-left: 5%'>Si</button></form></p>";
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista dei tipi di pagamento
	 * @param results
	 * @return
	 */
	public static String getListaTipiPagamentoPage(ResultSet results) {

		String page = "";

		try {
			
			page += "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEI TIPI DI PAGAMENTO</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<a href='"+ root + "/nuovoTipoPagamento' role='button' " +
					"class='btn btn-info' style='margin-left:78%;'>Nuovo tipo pagamento</a></p></div>" + 
					"<th>Codice</th><th>Descrizione</th><th>Operazioni</th><th></th>";

			while(results.next()) {

				page += "<tr><td>" + results.getString("Codice") + "</td><td>" + 
						results.getString("Descrizione") + "</td><td>" +
						"<a type='button' class='btn btn-success' href='" + root + "/modificaTipoPagamento?codice=" + 
						results.getString("Codice") + "' id='editbutton' style='margin-right:-2%;'>Modifica</a></td>" + 
						"<td><a type='button' class='btn btn-danger' href='" + root + "/cancellaTipoPagamento?codice=" +
						results.getString("Codice") + "'>Elimina</a></td></tr>";
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina di inserimento di un nuovo tipo di pagamento
	 * @param error
	 * @return
	 */
	public static String getNuovoTipoPagamentoPage(int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>INSERIMENTO NUOVO TIPO DI PAGAMENTO</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" Esiste gia un altro tipo di pagamento uguale</div>";
		else if(error == 0)
			page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
					" Un nuovo tipo di pagamento è stato aggiunto con successo</div>";
		
		page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
				"<tr><td><strong>DESCRIZIONE </strong></td><td><input type='text' name='descrizione' required></td></tr></table>" +
				"<div class='opbar'><a href='"+ root + "/listaTipiPagamento' role='button' class='btn btn-primary'>Torna alla lista</a>" +
				"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista delle categorie del blglietto
	 * @param results
	 * @return
	 */
	public static String getListaCategoriePage(ResultSet results) {

		String page = "";

		try {
			
			page += "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DELLE CATEGORIE DEI BIGLIETTI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<a href='"+ root + "/nuovaCategoria' role='button' " +
					"class='btn btn-info' style='margin-left:80%;'>Nuova categoria</a></p></div>" + 
					"<th>Nome</th><th>Costo</th><th>Operazioni</th><th></th>";

			while(results.next()) {

				page += "<tr><td>" + results.getString("Nome") + "</td><td>" + 
						results.getString("Costo") + "</td><td>" + 
						"<a type='button' class='btn btn-success' href='" + root + "/modificaCategoria?nomeCat=" + 
						results.getString("Nome") + "' id='editbutton' style='margin-right:-2%;'>Modifica</a></td>" +
						"<td><a type='button' class='btn btn-danger' href='" + root + "/cancellaCategoria?nome=" + 
						results.getString("Nome") + "'>Elimina</a></td></tr>";
				
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}

	
	/**
	 * Metodo per la restituzione del layout della pagina di inserimento di una nuova categoria
	 * @param error
	 * @return
	 */
	public static String getNuovaCategoriaPage(int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>INSERIMENTO NUOVA CATEGORIA</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" Esiste gia una categoria con lo stesso nome</div>";
		else if(error == 0)
			page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
					" Una nuova categoria è stata aggiunta con successo</div>";
		
		page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
				"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' required></td></tr>" +
				"<tr><td><strong>COSTO </strong></td><td><input type='number' step='0.01' min='0.01' name='costo' required></td></tr></table>" +
				"<div class='opbar'><a href='"+ root + "/listaCategorie' role='button' class='btn btn-primary'>Torna alla lista</a>" +
				"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
		
		return page;
	}

	
	/**
	 * Metodo per la restituzione del layout della pagina dell'incasso del mese scorso
	 * @param result
	 * @return
	 */
	public static String getInfoIncassoMensilePage(ResultSet result) {
		
		String page = "";
		
		try {
			
			int monthIncomes = (int)Float.parseFloat(result.getString("GuadagnoMensile"));
			
			page += "<p><label class='titlepage'><strong>INFORMAZIONI SULL'INCASSO MENSILE</strong></label></p>\r\n" + 
					"<h3><p style='font-syze:150%;'>Nello scorso mese (" + result.getString("Mese") + "/" + result.getString("Anno") + 
					") si è avuto un guadagno totale di circa " + monthIncomes + " euro.</p>" + 
					"<p style='font-syze:150%;'>Nello specifico, sono stati acquistati " + result.getString("ServiziPriorityVenduti") + " servizi priority, " + 
					 result.getString("BigliettiVenduti")  + " biglietti e " +  result.getString("AbbonamentiVenduti")  +
					 " abbonamenti. </p></h3>";
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}

	
	/**
	 * Metodo per la restituzione del layout della pagina della visualizzazione delle info del cliente
	 * @param result
	 * @return
	 */
	public static String getVisualizzaClientePage(ResultSet result) {
		
		String page = "";
		
		try {
			
			LocalDate localBirthDate = LocalDate.parse(result.getString("DataNascita"));
			String birth = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBirthDate);
			
			page += "<label class='titlepage'><strong>INFORMAZIONI SUL CLIENTE</strong></label>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" +
					"<a href='"+ root + "/listaClienti' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<a type='button' class='btn btn-success' href='" + root + "/modificaCliente?emailPassata=" + 
					result.getString("Email") + "' id='editbutton'>Modifica</a>" + 
					"<a type='button' class='btn btn-danger' href='" + root + "/cancellaCliente?email=" +
					result.getString("Email") + "'>Elimina</a></div>";

			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni anagrafiche</strong></h3></p>" +
					"<tr><td><strong>NOME </strong></td><td>" + result.getString("Nome") +"</td></tr>" +
					"<tr><td><strong>COGNOME </strong></td><td>" + result.getString("Cognome") +"</td></tr>" +
					"<tr><td><strong>EMAIL </strong></td><td>" + result.getString("Email") +"</td></tr>" +
					"<tr><td><strong>DATA DI NASCITA </strong></td><td>" + birth +"</td></tr>" +
					"<tr><td><strong>INDIRIZZO DI RESIDENZA </strong></td><td>" + result.getString("Indirizzo") + "</td></tr>";
			
			if(result.getString("VIP") != null) {
			
				LocalDate localVIPDate = LocalDate.parse(result.getString("VIP"));
				String VIP = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localVIPDate);
				
				page += "<tr><td><strong>CLIENTE VIP DA <strong></td><td>" + VIP +"</td></tr></table>";
			
			}else
				page += "<tr><td><strong>CLIENTE VIP DA </strong></td><td>Non ancora cliente VIP</td></tr></table>";
			
			page += "<table id='infos' class='table table-striped'><p><h3 style='margin-top:5%;'><strong>Informazioni biglietteria</strong></h3></p>";
			
			page += "<tr><td><strong>TOTALE NUMERO BIGLIETTI ACQUISTATI </strong></td><td>";
			if(result.getString("NumeroBiglietti") != null)
				page += result.getString("NumeroBiglietti") +" biglietto/i </td></tr>";
			else
				page += "Nessun biglietto </td></tr>";
			
			page += "<tr><td><strong>TOTALE NUMERO ABBONAMENTI ACQUISTATI </strong></td><td>" ;
			if(result.getString("NumeroAbbonamenti") != null)
				page += result.getString("NumeroAbbonamenti") +" abbonamento/i </td></tr>";
			else
				page += "Nessun abbonamento </td></tr>";
			
			page += "<tr><td><strong>TOTALE NUMERO SERVIZI PRIORITY ACQUISTATI </strong></td><td>" ;
			if(result.getString("NumeroServiziPriority") != null)
				page += result.getString("NumeroServiziPriority") +" servizi </td></tr>";
			else
				page += "Nessun servizio </td></tr>";
			
			page += "<tr><td><strong>TOTALE NUMERO SALTI PRIORITY EFFETTUATI </strong></td><td>" ;
			if(result.getString("NumeroSaltiPriority") != null)
				page += result.getString("NumeroSaltiPriority") +" salti</td></tr></table>";
			else
				page += "Nessun salto della fila </td></tr></table>";
			
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}

	
	/** 
	 * Metodo per la restituzione del layout della pagina di cancellazione della categoria
	 * @param email
	 * @param error
	 * @return
	 */
	public static String getCancellaCategoriaPage(String nome, int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>CANCELLAZIONE CATEGORIA</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" La cancellazione della categoria non è avvenuta.</div>";
		
		
		page += "<p style='font-size: 150%;'><Strong>Attenzione!</Strong> Si sta cercando di cancellare la categoria associata "
				+ "al nome " + nome+ ".</p>"
				+ "<p style='font-size: 150%;'>Questo è un processo irreversibile, eliminerà definitivamente la categoria. "
				+ "Tuttavia, la cancellazione non può essere effettuata se esiste almeno un biglietto "
				+ "associato, al fine di garantire l'integrità delle informazioni presenti nel sistema.</p>"
				+ "<p style='font-size: 150%;'>Sei sicuro di voler proseguire?</p>"
				+ "<form method='post'><input type='hidden' value='" + nome + "'>"
				+ "<p style='font-size: 150%;'><a type='button' class='btn btn-primary' href='" + root + "/listaCategorie'>No</a>"
				+ "<button type='submit' class='btn btn-danger' style='margin-left: 5%'>Si</button></form></p>";
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica di una categoria
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaCategoriaPage(ResultSet result, int error) {
		
		String page = "";

		try {

			page += "<p><label class='titlepage'><strong>MODIFICA CATEGORIA</strong></label></p>";			
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia una categoria con lo stesso nome</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" La categoria è stata modificata con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' value='" + result.getString("nome") + "' required></td></tr>" +
					"<tr><td><strong>COSTO </strong></td><td><input type='number' step='0.01' min='0.01' name='costo' value='" + result.getString("costo") + "' required></td></tr></table>" +
					"<input type='hidden' name='nomeCat' value='" + result.getString("nome") + "'>" +
					"<div class='opbar'><a href='"+ root + "/listaCategorie' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;

		} catch (SQLException e) {

			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica di un tipo di pagamento
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaTipoPagamentoPage(ResultSet result, int error) {
		
		String page = "";

		try {

			page += "<p><label class='titlepage'><strong>MODIFICA TIPO DI PAGAMENTO</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un'altro tipo di pagamento con lo stesso nome</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Il tipo di pagamento è stata modificato con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>DESCRIZIONE </strong></td><td><input type='text' name='descrizione' value='" + result.getString("descrizione") + "' required></td></tr></table>" +
					"<input type='hidden' name='codice' value='" + result.getString("codice") +"'>" +
					"<div class='opbar'><a href='"+ root + "/listaTipiPagamento' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
			
					
			
			return page;

		} catch (SQLException e) {

			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina di cancellazione del tipo di pagamento
	 * @param email
	 * @param error
	 * @return
	 */
	public static String getCancellaTipoPagamentoPage(String codice, int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>CANCELLAZIONE TIPO PAGAMENTO</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" La cancellazione del tipo di pagamento non è avvenuta.</div>";
		
		page += "<p style='font-size: 150%;'><Strong>Attenzione!</Strong> Si sta cercando di cancellare il tipo di pagamento associata "
				+ "al codice " + codice + ".</p>"
				+ "<p style='font-size: 150%;'>Questo è un processo irreversibile, eliminerà definitivamente il tipo di pagamento. "
				+ "Tuttavia, la cancellazione non può essere effettuata se esiste almeno un biglietto "
				+ "associato, al fine di garantire l'integrità delle informazioni presenti nel sistema.</p>"
				+ "<p style='font-size: 150%;'>Sei sicuro di voler proseguire?</p>"
				+ "<form method='post'><input type='hidden' value='" + codice + "'>"
				+ "<p><a type='button' class='btn btn-primary' href='" + root + "/listaTipiPagamento'>No</a>"
				+ "<button type='submit' class='btn btn-danger' style='margin-left: 5%'>Si</button></form></p>";
		
		return page;
	}

	
	/**
	 * Metodo per la restituzione del layout della pagina della lista delle attrazioni
	 * @param results
	 * @return
	 */
	public static String getListaAttrazioniPage(ResultSet results) {

		String page = "";

		try {
			
			page = "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DELLE ATTRAZIONI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valore' placeholder='Cerca attrazione per nome'>" +
					"<button type='submit' class='btn btn-info' style='margin-left: 2%; margin-right: 42%;'>Cerca</button>" +
					"<a href='"+ root + "/nuovaAttrazione' role='button' " +
					"class='btn btn-info'>Nuova attrazione</a></p>" +
					"<input type='checkbox' name='escluso' value='1' style='margin-left: -65%; margin-right: 1%;'>Escludi attrazioni in disuso</form></div>" + 
					"<th>Nome</th><th>Tipologia</th><th>Operazioni</th>";

			while(results.next()) {

				page += "<tr><td>" + results.getString("Nome");
				
				if(results.getString("Latitudine") == null || results.getString("Longitudine") == null)
					page += " (in disuso)";
				
				page += "</td><td>";
				
				if(Integer.parseInt(results.getString("Estrema")) == 1)
					page += "Estrema</td>";
				else
					page += "Moderata</td>";
				
				page += "<td><a type='button' class='btn btn-primary' href='" + root + "/visualizzaAttrazione?nome=" +
						results.getString("Nome") + "'>Visualizza</a></td></tr>";
					
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}

	
	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di una nuova attrazione
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovaAttrazionePage(int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>INSERIMENTO NUOVA ATTRAZIONE</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" Esiste gia un'altra attrazione con tale nome</div>";
		else if(error == 0)
			page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
					" L'attrazione è stato inserito con successo</div>";
		
		page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
				"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' required></td></tr>" +
				"<tr><td><strong>LATITUDINE </strong></td><td><input type='number' name='latitudine' " +
				"step='0.000001' min='41.120470' max='41.120499' required></td></tr>" + 
				"<tr><td><strong>LONGITUDINE </strong></td><td><input type='number' name='longitudine' " +
				"step='0.000001' min='16.866940' max='16.866969' required></td></tr>" +
				"<tr><td><strong>ALTEZZA MINIMA </strong></td><td><input type='number' name='altezza' " +
				"step='1' min='1'></td></tr>" +
				"<tr><td><strong>ETA' MINIMA </strong></td><td><input type='number' name='eta' " +
				"step='1' min='1'></td></tr>" +
				"<tr><td><strong>TIPOLOGIA </strong></td><td><select name='tipo'>" +
				"<option value='0'>Moderata</option><option value='1'>Estrema</option></select></td></tr></table>" +
				"<div class='opbar'><a href='"+ root + "/listaAttrazioni' role='button' class='btn btn-primary'>Torna alla lista</a>" +
				"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
		
		
		return page;
	}
	
	
	/**
	 * Metodo per la restituzione del layout della pagina della visualizzazione 
	 * delle info dell'attrazione
	 * @param result
	 * @return
	 */
	public static String getVisualizzaAttrazionePage(ResultSet result) {
		
		String page = "";
		
		try {
			
			page += "<label class='titlepage'><strong>INFORMAZIONI SULL'ATTRAZIONE</strong></label>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" +
					"<a href='"+ root + "/listaAttrazioni' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<a type='button' class='btn btn-success' id='editbutton' style='margin-left:5%; margin-right:5%;' " +
					"href='" + root + "/modificaAttrazione?nomeAtt=" + 
					result.getString("Nome") + "'>";
			
			if(result.getString("latitudine") == null || result.getString("longitudine") == null) 
				page += "Reinserisci</a></div>";
			else
				page += "Modifica</a><a type='button' class='btn btn-danger' href='" + root + 
					"/cancellaAttrazione?nomeAtt=" + result.getString("Nome") + "'>Imposta come in disuso</a></div>";
			

			
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni generiche</strong></h3></p>" +
					"<tr><td><strong>NOME </strong></td><td>" + result.getString("Nome") +"</td></tr>" +
					"<tr><td><strong>TIPOLOGIA </strong></td><td>";
			
			if(Integer.parseInt(result.getString("Estrema")) == 1)		page += "Estrema</td></tr>";
			else														page += "Moderata</td></tr>";
			
			if(result.getString("Latitudine") == null || result.getString("Latitudine") == null)
				page += "<tr><td><strong>STATO </strong></td><td>Attrazione in disuso</td></tr>";
			else
				page +=	"<tr><td><strong>LATITUDINE </strong></td><td>" + result.getString("Latitudine") +"</td></tr>" +
						"<tr><td><strong>LONGITUDINE </strong></td><td>" + result.getString("Longitudine") +"</td></tr>";
			
			page +=	"<tr><td><strong>ALTEZZA MINIMA </strong></td><td>";
			if(result.getString("AltezzaMinima") != null)
				page += result.getString("AltezzaMinima") +" cm</td></tr>";
			else
				page += "Nessun requisito minimo </td></tr>";
				
			page +=	"<tr><td><strong>ETA' MINIMA </strong></td><td>";
			if(result.getString("EtaMinima") != null)
				page += result.getString("EtaMinima") +" anni </td></tr></table>";
			else
				page += "Nessun requisito minimo </td></tr></table>";
			
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni aggiuntive</strong></h3></p>" +
					"<tr><td><strong>TOTALE SALTI EFFETTUATI SULL'ATTRAZIONE </strong></td><td>" ;
			if(result.getString("NumeroSalti") != null)
				page += result.getString("NumeroSalti") +" salto/i </td></tr>";
			else
				page += "Nessun salto effettuato </td></tr>";
			
			page += "<tr><td><strong>TOTALE NUMERO SPETTACOLI TENUTI IN PROSSIMITA' DELL'ATTRAZIONE </strong></td><td>";
			if(result.getString("NumeroSpettacoli") != null)
				page += result.getString("NumeroSpettacoli") +" spettacolo/i </td></tr>";
			else
				page += "Nessuno spettacolo compiuto </td></tr>";
			
			page += "<tr><td><strong>TOTALE NUMERO CLIENTI USUFRUITORI DELL'ATTRAZIONE (CON PRIORITY) </strong></td><td>";
			if(result.getString("NumeroClienti") != null)
				page += result.getString("NumeroClienti") +" cliente/i</td></tr></table>";
			else
				page += "Nessuno cliente usufruitore </td></tr></table>";
			
			
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica di una attrazione
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaAttrazionePage(ResultSet result, int error) {
		
		String page = "";

		try {

			page += "<p><label class='titlepage'><strong>MODIFICA ATTRAZIONE</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un'attrazione con lo stesso nome</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" L'attrazione è stata modificata con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' value='" + 
					result.getString("nome") + "' required></td></tr>" +
					"<tr><td><strong>LATITUDINE </strong></td><td><input type='number' name='latitudine' " +
					"step='0.000001' min='41.120470' max='41.120499' value='"; 
			
			if(result.getString("latitudine") != null && !result.getString("latitudine").equals("")
					&& !result.getString("latitudine").equals(" "))
				page += Float.parseFloat(result.getString("latitudine")) + "' required></td></tr>";
			else
				page += "41.120475' required></td></tr>";
			
			page += "<tr><td><strong>LONGITUDINE </strong></td><td><input type='number' name='longitudine' " +
					"step='0.000001' min='16.866940' max='16.866969' value='";
			if(result.getString("longitudine") != null && !result.getString("longitudine").equals("")
					&& !result.getString("longitudine").equals(""))
				page += Float.parseFloat(result.getString("longitudine").trim()) + "' required></td></tr>";
			else
				page += "16.866947' required></td></tr>";
			
			page += "<tr><td><strong>ALTEZZA MINIMA </strong></td><td><input type='number' name='altezza' " +
					"step='1' min='1' value='";
			if(result.getString("altezzaminima") != null)
				page += Integer.parseInt(result.getString("altezzaminima").trim()) + "'></td></tr>";
			else
				page += "'></td></tr>";

			page += "<tr><td><strong>ETA' MINIMA </strong></td><td><input type='number' name='eta' " +
					"step='1' min='1' value='";
			if(result.getString("etaminima") != null)
				page += Integer.parseInt(result.getString("etaminima").trim()) + "'></td></tr>";
			else
				page += "'></td></tr>";
			
			if(result.getString("estrema").equals("1"))
				page +="<tr><td><strong>TIPOLOGIA </strong></td><td><select name='tipo'>" +
						"<option value='1'>Estrema</option><option value='0'>Moderata</option>" +
						"</select></td></tr></table>";
			else
				page +="<tr><td><strong>TIPOLOGIA </strong></td><td><select name='tipo'>" +
						"<option value='0'>Moderata</option><option value='1'>Estrema</option>" +
						"</select></td></tr></table>";
			
			page += "<div class='opbar'><a href='"+ root + "/listaAttrazioni' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;

		} catch (SQLException e) {

			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina di 
	 * impostazione di disuso dell'attrazione
	 * @param email
	 * @param error
	 * @return
	 */
	public static String getCancellaAttrazionePage(String nome, int error) {
		
		String page = "";
		
		page += "<p><label class='titlepage'><strong>IMPOSTAZIONE DISUSO ATTRAZIONE</strong></label></p>";
		
		if(error == 1)
			page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
					" L'impostazione di disuso dell'attrazione non è avvenuta.</div>";
		
		page += "<p style='font-size: 150%;'><Strong>Attenzione!</Strong> Si sta cercando di impostare in disuso l'attrazione associata "
				+ "al nome " + nome + ".</p>"
				+ "<p style='font-size: 150%;'>Una attrazione viene impostata in disuso quando essa non esiste più all'interno del parco "
				+ "oppure quando è momentaneamente chiusa al pubblico. "
				+ "Ciò permette di avere traccia delle attrazioni presenti in passato e di"
				+ " garantire l'integrità delle informazioni presenti nel sistema.</p>"
				+ "<p style='font-size: 150%;'>La procedura non è irreversibile e l'attrazione potrà essere ripristinata in"
				+ "un secondo momento selezionando la voce \"Reinserisci\".</p>"
				+ "<p style='font-size: 150%;'>Sei sicuro di voler proseguire?</p>"
				+ "<form method='post'><input type='hidden' value='" + nome + "'>"
				+ "<p><a type='button' class='btn btn-primary' href='" + root + "/listaAttrazioni'>No</a>"
				+ "<button type='submit' class='btn btn-danger' style='margin-left: 5%'>Si</button></form></p>";
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista delle attrazioni
	 * @param results
	 * @return
	 */
	public static String getListaBigliettiPage(ResultSet results) {

		String page = "";

		try {
			
			page = "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEI BIGLIETTI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valoreCliente' placeholder='Cerca biglietto per cliente'>" +
					"<input type='date' name='valoreData' style='margin-left:2%;'>"+
					"<button type='submit' class='btn btn-info' style='margin-right: 22%; margin-left: 3%;'>Cerca</button></form>" +
					"<a href='"+ root + "/nuovoBiglietto' role='button' " +
					"class='btn btn-info'>Nuovo biglietto</a></p></div>" + 
					"<th>Cliente</th><th>Data</th><th>Ora</th><th>Operazioni</th>";

			while(results.next()) {
				
				LocalDate buyDate = LocalDate.parse(results.getString("Data"));
				String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(buyDate);

				page += "<tr><td>" + results.getString("Cliente") + "</td><td>" + 
						buy + "</td><td>" + results.getString("Ora") + "</td><td>" + 
						"<a type='button' class='btn btn-primary' href='" + root + "/visualizzaBiglietto?cliente=" +
						results.getString("Cliente") + "&data=" + results.getString("Data") + 
						"&ora=" + results.getString("Ora") + "'>Visualizza</a></td></tr>";
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo biglietto
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoBigliettoPage(ResultSet payments, ResultSet category, boolean notify3x2, 
			boolean notifyVIP, int error) {
		
		LocalDate localDate = LocalDate.now();
		String now = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		try {

			String page = "";
			
			page += "<label class='titlepage'><strong>INSERIMENTO NUOVO BIGLIETTO</strong></label>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Il cliente non esiste oppure esiste gia un altro biglietto effettuato dallo " +
						"stesso cliente a quell'istante</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Il biglietto è stato inserito con successo</div>";

			if(notify3x2)
				page += "<div class='alert alert-success'><strong>Attenzione!</strong>" +
						" Il cliente ha diritto allo sconto 3x2!</div>";
			if(notifyVIP)
				page += "<div class='alert alert-success'><strong>Attenzione!</strong>" + 
						" Il cliente è diventato di livello VIP!</div>";
			
			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<td><strong>DATA </strong></td><td><input type='date' name='data' step='1' min='2010-01-01' max='" + 
					now + "' required></td></tr>" +
					"<td><strong>ORA </strong></td><td><input type='time' name='ora' required></td></tr>" +
					"<td><strong>E-MAIL CLIENTE </strong></td><td><input type='email' name='cliente' required></td></tr>" +
					"<td><strong>CATEGORIA </strong></td><td><select name='categoria'>";

			while(category.next()) 
				page += "<option value='" + category.getString("Nome") + "'>" + category.getString("Nome") +
				"</option>";

			page += "</select></td></tr><td><strong>TIPO DI PAGAMENTO </strong></td><td><select name='tipopagamento'>";
			
			while(payments.next())
				page += "<option value='" + payments.getInt("Codice") + "'>" + payments.getString("Descrizione") +
				"</option>";
				
			page += "</select></td></tr></table>";

			page +=	"<div class='opbar'><a href='"+ root + "/listaBiglietti' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
			
			
			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della 
	 * visualizzazione delle info del biglietto
	 * @param result
	 * @return
	 */
	public static String getVisualizzaBigliettoPage(ResultSet result) {
		
		String page = "";
		
		try {
			
			LocalDate localBuyDate = LocalDate.parse(result.getString("Data"));
			String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBuyDate);
						
			page += "<label class='titlepage'><strong>INFORMAZIONI SUL BIGLIETTO</strong></label>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" + 
					"<a href='"+ root + "/listaBiglietti' role='button' class='btn btn-primary'>Torna alla lista</a></div>";
			
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni generali</strong></h3></p>" +
					"<tr><td><strong>DATA E ORA ACQUISTO </strong></td><td>" + buy + 
					" alle ore " + result.getString("Ora") +"</td></tr>" +
					"<tr><td><strong>CLIENTE </strong></td><td>" + result.getString("Nome") + " " + result.getString("Cognome") + "</td></tr>" +
					"<tr><td><strong>CATEGORIA DI BIGLIETTO </strong></td><td>" + result.getString("Categoria") +"</td></tr>" +
					"<tr><td><strong>COSTO DEL BIGLIETTO </strong></td><td>" + result.getString("Costo") + " euro </td></tr>" +
					"<tr><td><strong>TIPO DI PAGAMENTO </strong></td><td>" + result.getString("Pagamento") + "</td></tr></table>";
					
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista dei servizi priority
	 * @param results
	 * @return
	 */
	public static String getListaPriorityPage(ResultSet results) {

		String page = "";

		try {
			
			page = "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEI SERVIZI PRIORITY</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valore' placeholder='Cerca cliente per cognome'>" +
					"<input type='date' name='valoreData' style='margin-left: 5%'>" +
					"<button type='submit' class='btn btn-info' style='margin-left: 2%; margin-right: 20%;'>Cerca</button></form>" +
					"<a href='"+ root + "/nuovoPriority' role='button' " +
					"class='btn btn-info'>Nuovo Priority</a></p></div>" + 
					"<th>Cliente</th><th>Data</th><th>Operazioni</th>";

			while(results.next()) {
				
				LocalDate localBuyDate = LocalDate.parse(results.getString("Data"));
				String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBuyDate);

				page += "<tr><td>" + results.getString("Cliente") + "</td><td>" + 
						buy + "</td><td>" + 
						"<a type='button' class='btn btn-primary' href='" + root + "/visualizzaPriority?cliente=" +
						results.getString("Cliente") + "&data=" + results.getString("Data") + 
						"'>Visualizza</a></td></tr>";
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo priority
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoPriorityPage(ResultSet attractions, int error) {
		
		LocalDate localDate = LocalDate.now();
		String now = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		try {

			String page = "";

			page += "<label class='titlepage'><strong>INSERIMENTO NUOVO SERVIZIO PRIORITY</strong></label>";
			
			if(error == 2)
				page += "<div class='alert alert-danger'><p><strong>Operazione fallita!</strong>" +
						" Non è possibile creare un nuovo servizio Priority in quanto il cliente " +
						"ne ha gia acquistato uno nella data inserita.</p><p> Utilizza l'opzione " +
						"\"Aggiungi salto\" in \"Visualizza Priority\" se vuoi aggiungere un salto " +
						"ad una attrazione</p></div>";
			else if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Il cliente inserito non è una e-mail valida.</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Il salto Priority è stato inserito con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<p style='font-size: 150%; text-align: justify;'>N.B. Per l'aggiunta di un nuovo salto al servizio Priority bisogna " +
					"usare l'opzione \"Aggiungi salto\" in \"Visualizza Priority\". " +
					"Questa finestra permette unicamente l'aggiunta di un nuovo servizio " +
					"per una certa data.</p>" +
					"<tr><td><strong>DATA </strong></td><td><input type='date' name='data' tep='1' min='2010-01-01' max='" + 
					now + "' required></td></tr>" +
					"<tr><td><strong>E-MAIL CLIENTE </strong></td><td><input type='email' name='cliente' required></td></tr>" +
					"<tr><td><strong>ATTRAZIONE </strong></td><td><select name='attrazione'>";

			while(attractions.next()) 
				page += "<option value='" + attractions.getString("Nome") + "'>" + attractions.getString("Nome") +
				"</option>";

			page += "</select></td></tr></table>";

			page +=	"<div class='opbar'><a href='"+ root + "/listaPriority' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della 
	 * visualizzazione delle info sul priority
	 * @param result
	 * @return
	 */
	public static String getVisualizzaPriorityPage(ResultSet genericInfo, ResultSet jumps) {
		
		String page = "";
		
		try {
			
			LocalDate localBuyDate = LocalDate.parse(genericInfo.getString("data"));
			String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBuyDate);
			
			page += "<label class='titlepage'><strong>INFORMAZIONI SUL SERVIZIO PRIORITY</strong></label>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>";					
			
			if(Integer.parseInt(genericInfo.getString("NumeroSalti")) < 10) {
				
				page += "<a href='"+ root + "/listaPriority' role='button' class='btn btn-primary'>Torna alla lista</a>" + 
						"<a href='"+ root + "/aggiungiSalto?cliente=" + genericInfo.getString("Email") + "&data=" 
						+ genericInfo.getString("data") + "' role='button' class='btn btn-success' " +
						"id='editbutton' style='margin-right:-2%;'>Aggiungi salto</a></div>";
			
			} else {
				
				page += "<a href='"+ root + "/listaPriority' role='button' class='btn btn-primary'>Torna alla lista</a></div>";
				page += "<div class='alert alert-danger'><strong>Attenzione!</strong>" +
						" Il cliente è giunto al numero massimo di salti effettuabili.</div>";
			}
				
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni generali</strong></h3></p>" +
					"<tr><td><strong>DATA DI ACQUISTO </strong></td><td>" + buy + "</td></tr>" +
					"<tr><td><strong>CLIENTE </strong></td><td>" + genericInfo.getString("Nome") + " " + genericInfo.getString("Cognome") + "</td></tr>" +
					"<tr><td><strong>NUMERO DI SALTI EFFETTUATI </strong></td><td>" + genericInfo.getString("NumeroSalti") +" salto/i </td></tr></table>" +
					"<table class='table table-striped' id='infos'><p><h3><strong>Informazioni sui salti effettuati</strong></h3></p>";
			
			while(jumps.next()) {
				
				page += "<tr><td><strong>ATTRAZIONE </strong></td><td>" + 
						jumps.getString("Attrazione") + "</td></tr>";
			}
			
			page += "</table>";
			
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo salto priority
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getAggiungiSaltoPage(ResultSet attractions, String cliente, String data, int error) {
		
		try {

			LocalDate localBuyDate = LocalDate.parse(data);
			String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localBuyDate);
			
			String page = "";

			page += "<p><label class='titlepage'><strong>AGGIUNTA NUOVO SALTO PRIORITY</strong></label></p>";

			if(error == 2)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Il salto Priority è stato inserito con successo. Tuttavia, il cliente ha " +
						"raggiunto il numero massimo di salti effettuabili, pertanto non può aggiungerne altri.</div>";
			else if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" L'inserimento del salto Priority non è andato a buon fine.</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Il salto Priority è stato inserito con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>DATA </strong></td><td>" + buy + "</td></tr>" +
					"<tr><td><strong>E-MAIL CLIENTE </strong></td><td>" + cliente + "</td></tr>" +
					"<tr><td><strong>ATTRAZIONE </strong></td><td><select name='attrazione'>";
			
			while(attractions.next()) 
				page += "<option value='" + attractions.getString("Nome") + "'>" + attractions.getString("Nome") +
				"</option>";

			page += "</select></td></tr></table>";

			page +=	"<div class='opbar'><a href='"+ root + "/listaPriority' role='button' class='btn btn-primary'>Torna alla lista</a>";
			
			
			if(error != 2)
				page += "<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			
			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista 
	 * degli abbonamenti
	 * @param results
	 * @return
	 */
	public static String getListaAbbonamentiPage(ResultSet results) {

		String page = "";

		try {
			
			page = "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEGLI ABBONAMENTI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valoreCliente' placeholder='Cerca abbonamento per cliente'>" +
					"<input type='number' name='valoreData' min='2000' max='2100' step='1' style='margin-left: 3%'>" +
					"<button type='submit' class='btn btn-info' style='margin-right: 12%; margin-left: 3%;'>Cerca</button></form>" +
					"<a href='"+ root + "/nuovoAbbonamento' role='button' " +
					"class='btn btn-info'>Nuovo abbonamento</a></p></div>" + 
					"<th>Cliente</th><th>Anno validità</th><th>Operazioni</th>";

			while(results.next()) {

				page += "<tr><td>" + results.getString("Cliente") + "</td><td>" + 
						results.getString("AnnoValidita") + "</td><td>" + 
						"<a type='button' class='btn btn-primary' href='" + root + "/visualizzaAbbonamento?cliente=" +
						results.getString("Cliente") + "&anno=" + results.getString("AnnoValidita") + 
						"'>Visualizza</a></td></tr>";
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della 
	 * visualizzazione delle info sull'abbonamento
	 * @param result
	 * @return
	 */
	public static String getVisualizzaAbbonamentoPage(ResultSet result, int error) {
		
		String page = "";
		
		try {
			
			LocalDate localSubscritionDate = LocalDate.parse(result.getString("DataSottoscrizione"));
			String buy = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localSubscritionDate );
						
			page += "<label class='titlepage'><strong>INFORMAZIONI SULL'ABBONAMENTO</strong></label>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" + 
					"<a href='"+ root + "/listaAbbonamenti' role='button' class='btn btn-primary'>Torna alla lista</a></div>";
			
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni generali</strong></h3></p>" +
					"<tr><td><strong>CLIENTE </strong></td><td>" + result.getString("Nome") + " " + result.getString("Cognome") + "</td></tr>" +
					"<tr><td><strong>E-MAIL DEL CLIENTE </strong></td><td>" + result.getString("Email") + "</td></tr>" +
					"<tr><td><strong>DATA DI SOTTOSCRIZIONE </strong></td><td>" + buy + "</td></tr>" +
					"<tr><td><strong>ANNO DI VALIDITA' </strong></td><td>" + result.getString("AnnoValidita") +"</td></tr></table>";

					
			
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo abbonamento
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoAbbonamentoPage(int error) {
		
		LocalDate localDate = LocalDate.now();
		String now = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		try {

			String page = "";

			page += "<label class='titlepage'><strong>INSERIMENTO NUOVO ABBONAMENTO</strong></label>";
			
			if(error == 2)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Il cliente inserito non è un utente VIP</div>";
			else if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste già un altro abbonamento effettuato dallo stesso cliente per lo stesso anno</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" L'abbonamento è stato inserito con successo</div>";
			
			page += "<table class='table table-striped' id='infos'><form method='post'>" +
					"<p><h3><strong>Informazioni generali</strong></h3></p>" +
					"<tr><td><strong>E-MAIL DEL CLIENTE </strong></td><td><input type='email' name='cliente' required></td></tr>" +
					"<tr><td><strong>ANNO DI VALIDITA' </strong></td><td><input type='number' name='anno' min='2010' max='2100' step='1' required></td></tr>" +
					"<tr><td><strong>DATA DI SOTTOSCRIZIONE </strong></td><td><input type='date' name='data' step='1' min='2010-01-01' max='" 
					+ now + "' required></strong></td></tr></table>" +
					"<div class='opbar'><a href='"+ root + "/listaAbbonamenti' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
			
			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della lista 
	 * degli eventi
	 * @param results
	 * @return
	 */
	public static String getListaEventiPage(ResultSet results) {

		String page = "";

		try {
			
			page += "<table class='table table-striped'>\r\n" +
					"<p><label class='titlepage'><strong>LISTA DEGLI EVENTI</strong></label></p>" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valore' placeholder='Cerca evento per nome'>" +
					"<button type='submit' class='btn btn-info' style='margin-left: 2%; margin-right: 45%;'>Cerca</button></form>" +
					"<a href='"+ root + "/nuovoEvento' role='button' " +
					"class='btn btn-info'>Nuovo evento</a></p></div>" + 
					"<th>Codice</th><th>Nome</th><th>Operazioni</th>";

			while(results.next()) {

				page += "<tr><td>" + results.getString("Codice") + "</td><td>" + 
						results.getString("Nome") + "</td><td>" + 
						"<a type='button' class='btn btn-primary' href='" + root + "/visualizzaEvento?codice=" +
						results.getString("Codice") + "'>Visualizza</a></td></tr>";
			}
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * dell'inserimento di un nuovo evento
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoEventoPage(int error) {
		
		try {

			String page = "";

			page += "<p><label class='titlepage'><strong>INSERIMENTO NUOVO EVENTO</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste già un altro evento con lo stesso nome</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" L'evento è stato inserito con successo</div>";
								
			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' required></td></tr>" +
					"<tr><td><strong>DESCRIZIONE </strong></td><td><input type='text' name='descrizione' required></td></tr></table>" +
					"<div class='opbar'><a href='"+ root + "/listaEventi' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";
			
			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		return null;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della 
	 * visualizzazione delle info sull'evento
	 * @param result
	 * @return
	 */
	public static String getVisualizzaEventoPage(ResultSet result) {
		
		String page = "";
		
		try {
			
			page += "<p><label class='titlepage'><strong>INFORMAZIONI SULL'EVENTO</strong></label></p>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" +
					"<a href='"+ root + "/listaEventi' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<a href='" + root + "/modificaEvento?codice=" + result.getString("Codice") + "' role='button'" +
					" class='btn btn-success' id='editbutton' style='margin-right:-2%'>Modifica</a></div>";
			
			page +=	"<table class='table table-striped' id='infos'><p><h3><strong>Informazioni generali</strong></h3></p>" +
					"<tr><td><strong>CODICE </strong></td><td>" + result.getString("Codice") + "</td></tr>" +
					"<tr><td><strong>NOME </strong></td><td>" + result.getString("Nome") + "</td></tr>" + 
					"<tr><td><strong>DESCRIZIONE </strong></td><td>" + result.getString("Descrizione") + "</td></tr></table>";
			
					
			page += "<table class='table table-striped' id='infos'><p><h3><strong>Informazioni sugli spettacoli dell'evento</strong></h3></p>" +
					"<tr><td><strong>NUMERO DI SPETTACOLI EFFETTUATI IN PASSATO </strong></td><td>";
			
			if(result.getString("SpettacoliPassati") != null && !result.getString("SpettacoliPassati").equals("")
					&& !result.getString("SpettacoliPassati").contentEquals(" "))
				page += result.getString("SpettacoliPassati") + " spettacolo/i</td></tr>";
			else
				page += "Nessuno spettacolo </td></tr>";
			
			page +=	"<tr><td><strong>NUMERO DI SPETTACOLI DA EFFETTUARE IN FUTURO </strong></td><td>";
				
			if(result.getString("SpettacoliFuturi") != null && !result.getString("SpettacoliFuturi").equals("")
					&& !result.getString("SpettacoliFuturi").contentEquals(" "))
				page += result.getString("SpettacoliFuturi") + " spettacolo/i</td></tr>";
			else
				page += "Nessuno spettacolo </td></tr>";
			
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}
	

	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica di un'evento
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaEventoPage(ResultSet result, int error) {
		
		String page = "";

		try {

			page += "<p><label class='titlepage'><strong>MODIFICA EVENTO</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un'evento con lo stesso nome</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" L'evento è stata modificato con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>NOME </strong></td><td><input type='text' name='nome' value='" + result.getString("nome") + "' required></td></tr>" +
					"<tr><td><strong>DESCRIZIONE </strong></td><td><input type='text' name='descrizione' value='"; 
			
			if(result.getString("descrizione") != null && !result.getString("descrizione").equals("")
					&& !result.getString("descrizione").equals(" "))
				page += result.getString("descrizione") + "' required></td></tr>";
			else
				page += "Non è disponibile una descrizione per questo evento' required></td></tr>";
			
			page += "</table><div class='opbar'><a href='"+ root + "/listaEventi' role='button' class='btn btn-primary'>Torna alla lista</a>" +
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;

		} catch (SQLException e) {

			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}

	
	/**
	 * Metodo per la restituzione del layout della pagina della lista degli spettacoli
	 * @param results
	 * @return
	 */
	public static String getListaSpettacoliPage(ResultSet results) {

		String page = "";

		try {
			
			page += "<table class='table table-striped'>\r\n" + 
					"<p><label class='titlepage'><strong>LISTA DEGLI SPETTACOLI</strong></label></p>\r\n" + 
					"<div class='advancedsearch'><form method='get'>" +
					"<p><input type='text' name='valore' placeholder='Cerca spettacolo per evento'>" +
					"<input type='date' name='valoreData' style='margin-left:2%;'>"+
					"<button type='submit' class='btn btn-info' style='margin-right: 22%; margin-left: 3%;'>Cerca</button>" +
					"<a href='"+ root + "/nuovoSpettacolo' role='button' " +
					"class='btn btn-info'>Nuovo spettacolo</a></p>" + 
					"<p><input type='checkbox' name='escluso' value='1' style='margin-left: -65%; margin-right: 1%;'>Escludi spettacoli passati</form></div>" + 
					"<th>Evento</th><th>Data</th><th>Operazioni</th>";

			while(results.next()) {
				
				LocalDate eventDate = LocalDate.parse(results.getString("Data").substring(0, 10));
				String event = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(eventDate);

				page += "<tr><td>" + results.getString("Nome") + "</td><td>" +
						event + " " + results.getString("data").substring(11) + "</td><td>" + 
						"<a type='button' class='btn btn-primary' href='" + root + "/visualizzaSpettacolo?evento=" +
						results.getString("Evento") + "&data=" + results.getString("Data") + 
						"'>Visualizza</a></td></tr>";
					
			}
			
			page += "</table>";
		
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		
		return page;
	}


	/**
	 * Metodo per la restituzione del layout della pagina della visualizzazione 
	 * delle info dello spettacolo
	 * @param result
	 * @return
	 */
	public static String getVisualizzaSpettacoloPage(ResultSet result) {
		
		String page = "";
		
		try {

			LocalDate localEventDate = LocalDate.parse(result.getString("Data").substring(0, 10));
			String event = DateTimeFormatter.ofPattern("dd-MM-yyyy").format(localEventDate);
			
			
			page += "<label class='titlepage'><strong>INFORMAZIONI SULLO SPETTACOLO</strong></label>";
			
			if(Integer.parseInt(result.getString("EventoPassato")) == 1)
				page += "<div class='alert alert-danger'><h3><strong>Attenzione!</strong></h3>" + 
						"<h5><p>Il seguente spettacolo è un evento passato già effettuato.</p>" +
						"<p>Non sarà, pertanto, possibile modificare le sue informazioni.</p></h5></div>";
			
			page += "<div class='opbar'>" +
					"<p><h4>Barra delle operazioni</h4></p>" +
					"<a href='"+ root + "/listaSpettacoli' role='button' class='btn btn-primary'>Torna alla lista</a>";
			
			if(Integer.parseInt(result.getString("EventoPassato")) == 0)
				page += "<a type='button' class='btn btn-success' id='editbutton' href='" + root + "/modificaSpettacolo?evento=" + 
						result.getString("Evento") + "&dataSp=" + result.getString("Data") + 
						"' style='margin-right: -2%'>Modifica</a>";
			
			page += "</div><table class='table table-striped' id='infos'><p><h3><strong>Informazioni generiche</strong></h3></p>" +
					"<tr><td><strong>NOME </strong></td><td>" + result.getString("Nome") +"</td><tr>" +
					"<tr><td><strong>DESCRIZIONE </strong></td><td>" + result.getString("Descrizione") + "</td></tr>" +
					"<tr><td><strong>DATA </strong></td><td>" + event + " " + result.getString("Data").substring(11) + "</td></tr>" +
					"<tr><td><strong>VICINO ALL'ATTRAZIONE </strong></td><td>" + result.getString("Attrazione") + "</td></tr></table>";
			
			
		} catch (SQLException e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return page;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * della modifica dello spettacolo
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getModificaSpettacoloPage(ResultSet result, ResultSet attractions, int error) {
		
		LocalDate localDate = LocalDate.now();
		String now = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		try {
			
			String page = "";
			
			page += "<p><label class='titlepage'><strong>MODIFICA SPETTACOLO</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un altro spettacolo dello stesso evento per tale ora.</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Lo spettacolo è stato modificato con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>DATA </strong></td><td><input type='date' name='data' min='" + now + "' max='2099-12-31' " +
					"value='" + (result.getString("Data")).substring(0, 10) + "' required></td></tr>" +
					"<tr><td><strong>ORA </strong></td><td><input type='time' name='ora' min='09:00' max='22:00' " + 
					"value='" + (result.getString("Data")).substring(11, 16) + "' required></td></tr>" +
					"<input type='hidden' name='dataSp' value='" + result.getString("Data") + "'>" +
					"<tr><td><strong>VICINO ALL'ATTRAZIONE </strong></td><td><select name='attrazione'>" +
					"<option value='" + result.getString("AttrazioneVicina") + "'>" + 
					result.getString("AttrazioneVicina") + "</option>";

			while(attractions.next()) {
			
				String attraction = attractions.getString("Nome");
				
				if(!attraction.equals(result.getString("AttrazioneVicina")))
					page += "<option value='" + attraction + "'>" + attraction + "</option>";
			}

			page += "</select></td></tr></table>" +
					"<div class='opbar'><a href='"+ root + "/listaSpettacoli' role='button' class='btn btn-primary'>Torna alla lista</a>" + 
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";

			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}


	/** 
	 * Metodo per la restituzione del layout della pagina 
	 * di creazione dello spettacolo
	 * @param results risultato della query di acquisizione
	 * @return layout della pagina
	 */
	public static String getNuovoSpettacoloPage(ResultSet events, ResultSet attractions, int error) {
		
		LocalDate localDate = LocalDate.now();
		String now = DateTimeFormatter.ofPattern("yyyy-MM-dd").format(localDate);
		
		try {
			
			String page = "";
			
			page += "<p><label class='titlepage'><strong>NUOVO SPETTACOLO</strong></label></p>";
			
			if(error == 1)
				page += "<div class='alert alert-danger'><strong>Operazione fallita!</strong>" +
						" Esiste gia un altro spettacolo dello stesso evento per tale ora.</div>";
			else if(error == 0)
				page += "<div class='alert alert-success'><strong>Operazione eseguita!</strong>" +
						" Lo spettacolo è stato inserito con successo</div>";

			page +=	"<table class='table table-striped' id='formtable'><form method='post'>" + 
					"<tr><td><strong>DATA </strong></td><td><input type='date' name='data' min='" + now + "' max='2099-12-31' required></td></tr>" +
					"<tr><td><strong>ORA </strong></td><td><input type='time' name='ora' min='09:00' max='22:00' required></tr></td>" +
					"<tr><td><strong>EVENTO </strong></td><td><select name='evento'>";

			while(events.next()) 
				page += "<option value='" + events.getString("Codice") + "'>" + events.getString("Nome") + "</option>";
			

			page += "</select></td></tr><tr><td><strong>VICINO ALL'ATTRAZIONE </strong></td><td><select name='attrazione'>";

			while(attractions.next()) {
			
				String attraction = attractions.getString("Nome");
				page += "<option value='" + attraction + "'>" + attraction + "</option>";
			}

			page += "</select></td></tr></table>" +
					"<div class='opbar'><a href='"+ root + "/listaSpettacoli' role='button' class='btn btn-primary'>Torna alla lista</a>" + 
					"<button type='submit' class='btn btn-info' id='submitbutton'>Invio</button></form></div>";


			return page;
			
		} catch (Exception e) {
			
			System.out.println(e.getClass() + " -> " + e.getMessage());
		}
		
		return null;
	}

}
