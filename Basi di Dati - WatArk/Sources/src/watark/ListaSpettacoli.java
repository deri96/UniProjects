package watark;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
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
 * Servlet implementation class ListaSpettacoli
 */
@WebServlet("/listaSpettacoli")
public class ListaSpettacoli extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
       
	
    /**
     * Costruttore della servlet
     */
    public ListaSpettacoli() {
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
			String query = "SELECT * FROM Spettacolo s JOIN Evento e ON e.Codice = s.Evento ";
			
			// definizione della eventuale ricerca da effettuare
			if(request.getParameter("valore") != null) { 

				if(request.getParameter("escluso") != null && request.getParameter("escluso").equals("1"))
					query += " WHERE s.Data > CURDATE() AND ";
				else
					query += " WHERE ";
					
				query += " e.Nome LIKE '%" + request.getParameter("valore") + "%' ";
			}
			
			query += " ORDER BY Data DESC";
			
			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);

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
			output.println(ServletLayout.getListaSpettacoliPage(results));


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
		
		doGet(request, response);
	}

}
