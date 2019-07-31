package watark;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class VisualizzaEvento
 */
@WebServlet("/visualizzaEvento")
public class VisualizzaEvento extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet VisualizzaEvento
     */
    public VisualizzaEvento() {
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

			DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy/MM/dd");
			// definizione della query
			String query = "select e.codice as Codice, e.Nome as Nome, e.Descrizione as Descrizione, SpettacoliPassati, SpettacoliFuturi\r\n" + 
					"from evento e LEFT JOIN \r\n" + 
					"	(SELECT count(*) as SpettacoliPassati, s.Evento as EventoSP\r\n" + 
					"	FROM spettacolo s\r\n" + 
					"	where s.Evento = ? and s.Data < ?\r\n" + 
					"	group by s.Evento) as SpettPassati ON EventoSP = e.codice LEFT JOIN\r\n" + 
					"	(select count(*) as SpettacoliFuturi, s.Evento as EventoSF\r\n" + 
					"	from spettacolo s\r\n" + 
					"	where s.Evento = ? and s.data >= ?\r\n" + 
					"	group by s.Evento) AS SpettFuturi on EventoSF = e.codice\r\n" + 
					"WHERE e.Codice = ?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("codice"));
			stmt.setString(2, dtf.format(LocalDateTime.now()));
			stmt.setString(3, request.getParameter("codice"));
			stmt.setString(4, dtf.format(LocalDateTime.now()));
			stmt.setString(5, request.getParameter("codice"));
			
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
				output.println(ServletLayout.getVisualizzaEventoPage(result));

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
