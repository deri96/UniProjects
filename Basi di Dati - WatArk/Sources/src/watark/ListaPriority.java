package watark;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class ListaPriority
 */
@WebServlet("/listaPriority")
public class ListaPriority extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
       
	
    /**
     * Costruttore della servlet
     */
    public ListaPriority() {
        super();
    }

    
	/**
	 * Metodo per l'acquisizione del contenuto in get
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

		// definizione delle variabili per l'accesso al database
		String user = "root";
		String password = "";
		String db = "watark";
		String host = "localhost";
		int port = 3306;

		// definizione dell'url della pagina
		String url = "jdbc:mysql://" + host + ":" + port + "/" + db + "?serverTimezone=UTC";
		System.out.println(url);

		try {

			// acqusiizione del driver del jdbc
			Class.forName("com.mysql.cj.jdbc.Driver");

			// inizializzazione della connessione al database
			Connection conn = DriverManager.getConnection(url, user, password);
			
			// definizione della query
			String query = "SELECT distinct p.Cliente, p.Data FROM Priority p  JOIN " + 
					"(SELECT Cognome, Email from CLIENTE) " + 
					"AS CognomiClienti ON CognomiClienti.Email = p.Cliente ";

			// definizione della eventuale ricerca da effettuare
			if(request.getParameter("valoreCliente") != null) 	 {
				
				query += " WHERE Cognome LIKE '%" + request.getParameter("valoreCliente") + "%' ";
				
				if(request.getParameter("valoreData") != null && !request.getParameter("valoreData").equals(""))
					query += " AND Data = DATE_sub(?, interval -1 day) ";
				
			}
			
			query += "ORDER BY Data DESC, Cliente ASC";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);

			// definizione della ricerca da effettuare
			if(request.getParameter("valoreData") != null && !request.getParameter("valoreData").equals(""))
				stmt.setDate(1, Date.valueOf(request.getParameter("valoreData")));
			 
			// esecuzione della query
			ResultSet results = stmt.executeQuery();

			// definizione del tipo di documento
			response.setContentType("text/html");

			// definizione della pagina di output e del suo contenuto
			PrintWriter output = response.getWriter();


			// header
			output.println(ServletLayout.getHeader(request.getContextPath()));

			// inizializzazione body
			output.println(ServletLayout.getBodyInit());

			// pagina di gestione del cliente
			output.println(ServletLayout.getListaPriorityPage(results));


			// chiusura tag div, body e html
			output.println(ServletLayout.getClosing());


			// chiusura dell'oggetto dei risultati acquisiti
			results.close();

			// chiusura dello statement
			stmt.close();

			// chiusura della connessione
			conn.close();


		} catch (SQLException e) {

			System.out.println(e.getClass() + " " + e.getMessage());

		} catch (ClassNotFoundException e) {

			System.out.println(e.getClass() + " " + e.getMessage());

		} catch (Exception e) {

			System.out.println(e.getClass() + " " + e.getMessage());

		}
	}


	/**
	 * metodo per l'acquisizione del contenuto in post
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
