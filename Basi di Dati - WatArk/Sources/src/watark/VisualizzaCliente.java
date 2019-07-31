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
 * Servlet implementation class VisualizzaCliente
 */
@WebServlet("/visualizzaCliente")
public class VisualizzaCliente extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
	
	
	private int error = -1;
    
	
    /**
     * Costruttore della servlet VisualizzaCliente
     */
    public VisualizzaCliente() {
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
			String query = "select cl.Email, cl.Nome, cl.Cognome, cl.DataNascita, cl.Indirizzo, cl.VIP, " +
					"NumeroAbbonamenti, NumeroBiglietti, NumeroServiziPriority, NumeroSaltiPriority " + 
					"FROM cliente cl LEFT JOIN " + 
					"(select count(*) as NumeroAbbonamenti, c.email as Cliente " + 
					"from Abbonamento a, cliente c where a.Cliente = c.Email group by a.cliente" + 
					") as AbbonamentiCliente ON AbbonamentiCliente.Cliente = cl.Email " + 
					"left join (select count(*) as NumeroBiglietti, c.email as Cliente " + 
					"from Biglietto b, cliente c where b.Cliente = c.Email group by b.cliente" + 
					") as BigliettiCliente on cl.email = BigliettiCliente.Cliente " + 
					"left join (select count(*) as NumeroServiziPriority, Cliente " + 
					"from (select count(*) as NumeroServiziPriority, c.email as Cliente " + 
					"from Priority p, cliente c where p.Cliente = c.Email " + 
					"group by p.cliente, p.Data) as Conteggio " + 
					"group by Cliente) as ServiziPriorityCliente on cl.email = ServiziPriorityCliente.Cliente " + 
					"left join (select count(*) as NumeroSaltiPriority, c.email as Cliente " + 
					"from Priority sp, cliente c where sp.Cliente = c.Email group by sp.Cliente" + 
					") as SaltiPriorityCliente on SaltiPriorityCliente.Cliente = cl.Email " + 
					"WHERE cl.email = ?";

			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
			// binding dei parametri
			stmt.setString(1, request.getParameter("email"));
			
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
				output.println(ServletLayout.getVisualizzaClientePage(result));

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
