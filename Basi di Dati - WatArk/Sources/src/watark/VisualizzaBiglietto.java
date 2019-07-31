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
 * Servlet implementation class VisualizzaBiglietto
 */
@WebServlet("/visualizzaBiglietto")
public class VisualizzaBiglietto extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet VisualizzaCliente
     */
    public VisualizzaBiglietto() {
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
			String query = "SELECT p.Data AS Data, p.Ora AS Ora, p.Categoria AS Categoria, c.Costo AS Costo, " +
					"t.Descrizione AS Pagamento, cl.Nome AS Nome, cl.Cognome AS Cognome " +
					"FROM Biglietto p JOIN Categoria c ON p.Categoria = c.Nome "+
					"JOIN TipoPagamento t ON p.TipoPagamento = t.Codice " +
					"JOIN Cliente cl ON p.Cliente = cl.Email " +
					"WHERE Data=? AND Ora=? AND Cliente=?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("data"));
			stmt.setString(2, request.getParameter("ora"));
			stmt.setString(3, request.getParameter("cliente"));
			
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

			// pagina di visualizzazione del biglietto
			if(result.next())
				output.println(ServletLayout.getVisualizzaBigliettoPage(result));

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
