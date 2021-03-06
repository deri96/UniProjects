package watark;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Types;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class ModificaAttrazione
 */
@WebServlet("/modificaAttrazione")
public class ModificaAttrazione extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	// nome della categoria che si sta modificando
	private String nameOnEdit = null;
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet
     */
    public ModificaAttrazione() {
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
			String query = "SELECT * FROM Attrazione WHERE Nome=?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("nomeAtt"));
			
			// esecuzione della query
			ResultSet result = stmt.executeQuery();
			
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
				output.println(ServletLayout.getModificaAttrazionePage(result, error));
			
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

			// acqusiizione del driver del jdbc
			Class.forName("com.mysql.cj.jdbc.Driver");

			// inizializzazione della connessione al database
			Connection conn = DriverManager.getConnection(url, user, password);
			
			// definizione della query
			String query = "UPDATE Attrazione " +
					"SET Nome=?, Latitudine=?, Longitudine=?, AltezzaMinima=?, EtaMinima=?, Estrema=? " + 
					"WHERE Nome=?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);

			// binding dei parametri
			stmt.setString(1, request.getParameter("nome"));
			stmt.setFloat(2, Float.parseFloat(request.getParameter("latitudine")));
			stmt.setFloat(3, Float.parseFloat(request.getParameter("longitudine")));

			if(!request.getParameter("altezza").trim().equals(""))
				stmt.setInt(4, Integer.parseInt(request.getParameter("altezza").trim()));
			else
				stmt.setNull(4, Types.INTEGER);
			
			if(!request.getParameter("eta").trim().equals(""))
				stmt.setInt(5, Integer.parseInt(request.getParameter("eta").trim()));
			else
				stmt.setNull(5, Types.INTEGER);
			
			stmt.setInt(6, Integer.parseInt(request.getParameter("tipo")));
			stmt.setString(7, request.getParameter("nomeAtt"));
			
			// esecuzione della query
			int res = stmt.executeUpdate();
			
			// modifica della nome dell'attrazione al quale poter accedere tramite la pagina
			if(res == 1) 	nameOnEdit = request.getParameter("nome");
			else			nameOnEdit = request.getParameter("nomeAtt");

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

		} catch (Exception e) {

			System.out.println(e.getClass() + " " + e.getMessage());
			
		}
		
		response.sendRedirect(request.getContextPath() + "/modificaAttrazione?nomeAtt=" + nameOnEdit + "");
		return;
	}

}
