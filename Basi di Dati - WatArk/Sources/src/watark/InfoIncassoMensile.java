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

import watark.ServletLayout;

/**
 * Servlet implementation class Home
 */
@WebServlet("/infoIncassoMensile")
public class InfoIncassoMensile extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
    
	
    /**
     * Costruttore della servlet Home
     */
    public InfoIncassoMensile() {

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
			String query = "SELECT \r\n" + 
					"        ((`guadagnopriority`.`GuadagnoPriority` + `guadagnobiglietti`.`GuadagnoBiglietti`) + `guadagnoabbonamenti`.`GuadagnoAbbonamenti`) AS `GuadagnoMensile`,\r\n" + 
					"        MONTH((CURDATE() - INTERVAL 1 MONTH)) AS `Mese`,\r\n" + 
					"        YEAR((CURDATE() - INTERVAL 1 MONTH)) AS `Anno`,\r\n" + 
					"        `guadagnopriority`.`ServiziPriorityVenduti` AS `ServiziPriorityVenduti`,\r\n" + 
					"        `guadagnobiglietti`.`BigliettiVenduti` AS `BigliettiVenduti`,\r\n" + 
					"        `guadagnoabbonamenti`.`AbbonamentiVenduti` AS `AbbonamentiVenduti`\r\n" + 
					"    FROM\r\n" + 
					"        (((SELECT \r\n" + 
					"            SUM(`guadagnopriorityperpersona`.`Costo`) AS `GuadagnoPriority`,\r\n" + 
					"                COUNT(0) AS `ServiziPriorityVenduti`\r\n" + 
					"        FROM\r\n" + 
					"            (SELECT DISTINCT\r\n" + 
					"            `p`.`Data` AS `data`,\r\n" + 
					"                `p`.`Cliente` AS `Cliente`,\r\n" + 
					"                IF((`p`.`Data` >= `c`.`VIP`), 5, 10) AS `Costo`\r\n" + 
					"        FROM\r\n" + 
					"            (`priority` `p`\r\n" + 
					"        JOIN `cliente` `c` ON ((`p`.`Cliente` = `c`.`Email`)))) `guadagnopriorityperpersona`) `guadagnopriority`\r\n" + 
					"        JOIN (SELECT \r\n" + 
					"            SUM(`guadagnobigliettiperpersona`.`CostoPagato`) AS `GuadagnoBiglietti`,\r\n" + 
					"                SUM(`guadagnobigliettiperpersona`.`BigliettiVenduti`) AS `BigliettiVenduti`\r\n" + 
					"        FROM\r\n" + 
					"            (SELECT \r\n" + 
					"            `b`.`Cliente` AS `cliente`,\r\n" + 
					"                `b`.`Data` AS `data`,\r\n" + 
					"                COUNT(0) AS `BigliettiVenduti`,\r\n" + 
					"                IF(((COUNT(0) > 3)\r\n" + 
					"                    AND (`cl`.`VIP` >= `b`.`Data`)), ((SUM(`c`.`Costo`) / 3) * 2), SUM(`c`.`Costo`)) AS `CostoPagato`\r\n" + 
					"        FROM\r\n" + 
					"            ((`biglietto` `b`\r\n" + 
					"        JOIN `categoria` `c`)\r\n" + 
					"        JOIN `cliente` `cl`)\r\n" + 
					"        WHERE\r\n" + 
					"            ((`cl`.`Email` = `b`.`Cliente`)\r\n" + 
					"                AND (`b`.`Categoria` = `c`.`Nome`)\r\n" + 
					"                AND (MONTH(`b`.`Data`) = MONTH((CURDATE() - INTERVAL 1 MONTH)))\r\n" + 
					"                AND (YEAR(`b`.`Data`) = YEAR((CURDATE() - INTERVAL 1 MONTH))))\r\n" + 
					"        GROUP BY `b`.`Cliente` , `b`.`Data`) `guadagnobigliettiperpersona`) `guadagnobiglietti`)\r\n" + 
					"        JOIN (SELECT \r\n" + 
					"            (COUNT(0) * 100) AS `GuadagnoAbbonamenti`,\r\n" + 
					"                COUNT(0) AS `AbbonamentiVenduti`\r\n" + 
					"        FROM\r\n" + 
					"            `abbonamento` `a`\r\n" + 
					"        WHERE\r\n" + 
					"            ((MONTH(`a`.`DataSottoscrizione`) = MONTH((CURDATE() - INTERVAL 1 MONTH)))\r\n" + 
					"                AND (YEAR(`a`.`DataSottoscrizione`) = YEAR((CURDATE() - INTERVAL 1 MONTH))))) `guadagnoabbonamenti`)";
			
			// definizione della query da eseguire sul database
			PreparedStatement stmt = conn.prepareStatement(query);
			
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
		
			// pagina dell'incasso mensile
			if(result.next())
				output.println(ServletLayout.getInfoIncassoMensilePage(result));
			
			// chiusura tag div, body e html
			output.println(ServletLayout.getClosing());
			
			
			// chiusura dell'oggetto dei risultati acquisiti
			result.close();
			
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
	 * Metodo per l'acquisizione del contenuto in post
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		doGet(request, response);
	}

}