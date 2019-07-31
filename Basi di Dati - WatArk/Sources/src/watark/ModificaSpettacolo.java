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
 * Servlet implementation class ModificaSpettacolo
 */
@WebServlet("/modificaSpettacolo")
public class ModificaSpettacolo extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	// data dell'evento che si sta modificando
	private String dateOnEdit = null;
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet
     */
    public ModificaSpettacolo() {
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
			String query = "SELECT * FROM Spettacolo WHERE Evento=? AND Data=?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("evento"));
			stmt.setString(2, request.getParameter("dataSp"));
			
			// esecuzione della query
			ResultSet result = stmt.executeQuery();
			
			// definizione della query
			query = "SELECT * FROM Attrazione WHERE Latitudine IS NOT NULL AND Longitudine IS NOT NULL";

			// definizione della query da eseguire sul database
			stmt = conn.prepareStatement(query);

			// esecuzione della query
			ResultSet attractions = stmt.executeQuery();
			
			// definizione del tipo di documento
			response.setContentType("text/html");

			// definizione della pagina di output e del suo contenuto
			PrintWriter output = response.getWriter();
			
			// header
			output.println(ServletLayout.getHeader(request.getContextPath()));

			// inizializzazione body
			output.println(ServletLayout.getBodyInit());
			
			// pagina di modifica del cliente
			if(result.next()) 
				output.println(ServletLayout.getModificaSpettacoloPage(result, attractions, error));
			
			// chiusura tag div, body e html
			output.println(ServletLayout.getClosing());
			
			error = -1;
			
		} catch (SQLException e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			error = 1;

		} catch (ClassNotFoundException e) {

			System.out.println(e.getClass() + " " + e.getMessage());

		} catch (Exception e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			
		}
	}

	
	/**
	 * Metodo per l'acquisizione del contenuto in get
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

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

			dateOnEdit = request.getParameter("dataSp");
			
			// acqusiizione del driver del jdbc
			Class.forName("com.mysql.cj.jdbc.Driver");

			// inizializzazione della connessione al database
			Connection conn = DriverManager.getConnection(url, user, password);
			
			// definizione della query
			String query = "UPDATE Spettacolo SET AttrazioneVicina=?, Data=? WHERE Evento=? AND Data=?";
			
			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);

			// binding dei parametri
			stmt.setString(1, request.getParameter("attrazione"));
			stmt.setString(2, request.getParameter("data").concat(" " + request.getParameter("ora") + ":00"));
			stmt.setString(3, request.getParameter("evento"));
			stmt.setString(4, request.getParameter("dataSp"));
			
			// esecuzione della query
			int res = stmt.executeUpdate();
			
			// modifica della data dello spettacolo al quale poter accedere tramite la pagina
			if(res == 1) 	dateOnEdit = request.getParameter("data").concat(" " + request.getParameter("ora"));

			// chiusura dello statement
			stmt.close();

			// chiusura della connessione
			conn.close();
			
			error = 0;
			

		} catch (SQLException e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			error = 1;

		} catch (ClassNotFoundException e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			error = 1;

		} catch (Exception e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			
		}
		
		response.sendRedirect(request.getContextPath() + "/modificaSpettacolo?evento=" + 
				request.getParameter("evento") + "&dataSp=" + dateOnEdit);
		return;
	}

}
