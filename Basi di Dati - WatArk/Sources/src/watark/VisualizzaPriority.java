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
 * Servlet implementation class VisualizzaBiglietto
 */
@WebServlet("/visualizzaPriority")
public class VisualizzaPriority extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet VisualizzaCliente
     */
    public VisualizzaPriority() {
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
			String query = "SELECT DISTINCT p.Data AS Data, p.Cliente as Email, c.Nome AS Nome, c.Cognome AS Cognome, NumeroSalti " +
					"FROM Priority p LEFT JOIN Cliente c ON p.Cliente = c.Email " +
					"LEFT JOIN (SELECT Cliente, Data, COUNT(*) AS NumeroSalti " +
					"FROM Priority GROUP BY Cliente, Data) AS NumeroSaltiPerData " +
					"ON NumeroSaltiPerData.Cliente = p.Cliente AND NumeroSaltiPerData.Data = p.Data " + 
					"WHERE p.Data=? AND p.Cliente=? ";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("data"));
			stmt.setString(2, request.getParameter("cliente"));
			
			// esecuzione della query
			ResultSet genericInfo = stmt.executeQuery();
			
			query = "SELECT * FROM Priority WHERE Data=? AND Cliente=?";
			
			stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("data"));
			stmt.setString(2, request.getParameter("cliente"));
			
			// esecuzione della query
			ResultSet jumps = stmt.executeQuery();
			
			// definizione del tipo di documento
			response.setContentType("text/html");

			// definizione della pagina di output e del suo contenuto
			PrintWriter output = response.getWriter();
			
			// header
			output.println(ServletLayout.getHeader(request.getContextPath()));

			// inizializzazione body
			output.println(ServletLayout.getBodyInit());

			// pagina di visualizzazione del biglietto
			if(genericInfo.next())
				output.println(ServletLayout.getVisualizzaPriorityPage(genericInfo, jumps));

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
	 * Metodo per l'acquisizione del contenuto in post
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

		doGet(request, response);
	}

}
