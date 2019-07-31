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
 * Servlet implementation class NuovoBiglietto
 */
@WebServlet("/nuovoBiglietto")
public class NuovoBiglietto extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
       
	private int error = -1;
	
	private boolean notify3x2 = false;
	
	private boolean notifyVIP = false;
	
    /**
     * Costruttore della servlet
     */
    public NuovoBiglietto() {
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
    		String query = "SELECT * FROM Categoria ";
    					
    		// definizione della query da eseguire sul database
    		PreparedStatement stmt = conn.prepareStatement(query);
    		
    		// esecuizone della query
    		ResultSet categories = stmt.executeQuery();
    		
    		// ridefinizione della query
    		query = "SELECT * FROM TipoPagamento ";
			
    		// definizione della query da eseguire sul database
    		stmt = conn.prepareStatement(query);
    		
    		// esecuzione della query
    		ResultSet payments = stmt.executeQuery();
    		

    		// definizione del tipo di documento
    		response.setContentType("text/html");

    		// definizione della pagina di output e del suo contenuto
    		PrintWriter output = response.getWriter();

    		// header
    		output.println(ServletLayout.getHeader(request.getContextPath()));

    		// inizializzazione body
    		output.println(ServletLayout.getBodyInit());

    		// pagina di gestione del cliente
    		output.println(ServletLayout.getNuovoBigliettoPage(payments, categories, notify3x2, notifyVIP, error));


    		// chiusura tag div, body e html
    		output.println(ServletLayout.getClosing());

    		error = -1;
    		notify3x2 = false;
    		notifyVIP = false;
    		
    		// esecuzione della query
    		categories.close();
    		payments.close();

    		// chiusura dello statement
    		stmt.close();

    		// chiusura della connessione
    		conn.close();

    		


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
			String query = "INSERT INTO Biglietto (Data, Ora, Cliente, TipoPagamento, Categoria) VALUES (?, ?, ?, ?, ?)";
			
			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei dati
			stmt.setString(1, request.getParameter("data"));
			stmt.setString(2, request.getParameter("ora"));
			stmt.setString(3, request.getParameter("cliente"));
			stmt.setString(4, request.getParameter("tipopagamento"));
			stmt.setString(5, request.getParameter("categoria"));
			
			 
			// esecuzione della query
			stmt.executeUpdate();
			
			// definizione della query
			query = "SELECT COUNT(*) as NumeroBigliettiAcquistatiInGiornata " + 
					"FROM Biglietto b " + 
					"WHERE b.Data = ?  and b.Cliente = ?";
			
			// definizione della query da eseguire sul database
			stmt = conn.prepareStatement(query);
			
			// binding dei dati
			stmt.setString(1, request.getParameter("data"));
			stmt.setString(2, request.getParameter("cliente"));
			
			// esecuzione della query
			ResultSet rs = stmt.executeQuery();
			
			if(rs.next()) {
				
				int ticketsFor3x2 = Integer.parseInt(rs.getString("NumeroBigliettiAcquistatiInGiornata"));
				
				System.out.println(ticketsFor3x2);
				
				if(ticketsFor3x2 % 3 == 0) {
				
					// definizione della query
					query = "SELECT c.VIP FROM Cliente c WHERE c.Email = ?";

					// definizione della query da eseguire sul database
					stmt = conn.prepareStatement(query);

					// binding dei dati
					stmt.setString(1, request.getParameter("cliente"));

					// esecuzione della query
					rs = stmt.executeQuery();
					
					if(rs.next()) {
						
						if(rs.getString("VIP") != null) 
							notify3x2 = true;
						else
							notify3x2 = false;
					}
				
				} else
					notify3x2 = false;
			}
			
			// definizione della query
			query = "SELECT COUNT(*) as NumeroBigliettiTotali " + 
					"FROM Biglietto bg " + 
					"WHERE bg.Cliente = ?";

			// definizione della query da eseguire sul database
			stmt = conn.prepareStatement(query);

			// binding dei dati
			stmt.setString(1, request.getParameter("cliente"));

			// esecuzione della query
			rs = stmt.executeQuery();

			if(rs.next()) {
				
				int ticketsForVIP = Integer.parseInt(rs.getString("NumeroBigliettiTotali"));
				
				if(ticketsForVIP == 20) {

					// definizione della query
					query = "UPDATE Cliente SET VIP = CASE WHEN VIP IS NULL THEN ? ELSE VIP END WHERE Email = ?";

					// definizione della query da eseguire sul database
					stmt = conn.prepareStatement(query);

					// binding dei dati
					stmt.setString(1, request.getParameter("data"));
					stmt.setString(2, request.getParameter("cliente"));

					// esecuzione della query
					if(stmt.executeUpdate() >= 0)
						notifyVIP = true;
					else
						notifyVIP = false;

				} else
					notifyVIP = false;
			}

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
		
		response.sendRedirect(request.getContextPath() + "/nuovoBiglietto");
		return;
	}

}
