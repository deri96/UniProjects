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
 * Servlet implementation class VisualizzaAbbonamento
 */
@WebServlet("/visualizzaAbbonamento")
public class VisualizzaAbbonamento extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
       
	private int error = -1;
	
    /**
     * Costruttore della servlet
     */
    public VisualizzaAbbonamento() {
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
    		String query = "SELECT c.Email, c.Nome, c.Cognome, a.AnnoValidita, a.DataSottoscrizione " + 
    				"FROM abbonamento a JOIN Cliente c " + 
    				"ON a.Cliente = c.Email " +
    				"WHERE a.Cliente = ? AND a.AnnoValidita = ?";
    					
    		// definizione della query da eseguire sul database
    		PreparedStatement stmt = conn.prepareStatement(query);
    		
    		// binding dei paramentri
    		stmt.setString(1, request.getParameter("cliente"));
    		stmt.setInt(2, Integer.parseInt(request.getParameter("anno")));
    		
    		// esecuizone della query
    		ResultSet result = stmt.executeQuery();

    		// definizione del tipo di documento
    		response.setContentType("text/html");

    		// definizione della pagina di output e del suo contenuto
    		PrintWriter output = response.getWriter();

    		// header
    		output.println(ServletLayout.getHeader(request.getContextPath()));

    		// inizializzazione body
    		output.println(ServletLayout.getBodyInit());

    		// pagina di gestione del cliente
    		if(result.next())
    			output.println(ServletLayout.getVisualizzaAbbonamentoPage(result, error));


    		// chiusura tag div, body e html
    		output.println(ServletLayout.getClosing());

    		error = -1;
    		
    		// esecuzione della query
    		result.close();

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
		
		doGet(request, response);
	}

}
