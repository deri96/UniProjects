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
 * Servlet implementation class AggiungiSalto
 */
@WebServlet("/aggiungiSalto")
public class AggiungiSalto extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
       
	private int error = -1;
	
    /**
     * Costruttore della servlet
     */
    public AggiungiSalto() {
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
			String query = "SELECT a.Nome as Nome " + 
					"from attrazione a " + 
					"where a.Latitudine is not null and a.Longitudine is not null and a.Nome not in (" + 
					"select p.attrazione as Nome " + 
					"from priority p " + 
					"where p.Cliente = ? and p.data = DATE_sub(?, interval -1 day))";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("cliente"));
			stmt.setDate(2, Date.valueOf(request.getParameter("data")));

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

			// pagina di gestione del cliente
			output.println(ServletLayout.getAggiungiSaltoPage(attractions, request.getParameter("cliente"),
					request.getParameter("data"), error));


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
	 * metodo per l'acquisizione del contenuto in post
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
			String query = "INSERT INTO Priority (Cliente, Data, Attrazione) VALUES (?, DATE_sub(?, interval -1 day), ?)";
			
			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei dati
			stmt.setString(1, request.getParameter("cliente"));
			stmt.setDate(2, Date.valueOf(request.getParameter("data")));
			stmt.setString(3, request.getParameter("attrazione"));
			 
			// esecuzione della query
			stmt.executeUpdate();
			
			// definizione della query
			query = "SELECT COUNT(*) AS NumeroSalti FROM PRIORITY WHERE Cliente=? AND Data=DATE_SUB(?, Interval -1 day)";
			
			// definizione della query da eseguire sul database
			stmt = conn.prepareStatement(query);
						
			// binding dei dati
			stmt.setString(1, request.getParameter("cliente"));
			stmt.setDate(2, Date.valueOf(request.getParameter("data")));
			
			// acquisizione dei risultati
			ResultSet rs = stmt.executeQuery();
			
			if(rs.next()) {
				
				if(rs.getInt("NumeroSalti") == 10) {
				
					error = 2;
					response.sendRedirect(request.getContextPath() + "/aggiungiSalto?cliente=" + request.getParameter("cliente") + 
							"&data=" + request.getParameter("data"));
					return;
				}
			}
			
			
			// chiusura del resultset
			rs.close();
			
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
		
		response.sendRedirect(request.getContextPath() + "/aggiungiSalto?cliente=" + request.getParameter("cliente") + 
				"&data=" + request.getParameter("data"));
		return;
	}

}
