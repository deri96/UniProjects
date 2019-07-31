package watark;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import watark.ServletLayout;

/**
 * Servlet implementation class Home
 */
@WebServlet("/home")
public class Home extends HttpServlet {
	
	private static final long serialVersionUID = 1L;
    
	
    /**
     * Costruttore della servlet Home
     */
    public Home() {

    	super();
    }

    
	/**
	 * Metodo per l'acquisizione del contenuto in get
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

		// definizione del tipo di documento
		response.setContentType("text/html");

		// definizione della pagina di output e del suo contenuto
		PrintWriter output = response.getWriter();


		// header
		output.println(ServletLayout.getHeader(request.getContextPath()));

		// inizializzazione body
		output.println(ServletLayout.getBodyInit());

		// home page
		output.println(ServletLayout.getHomePage());

		// chiusura tag div, body e html
		output.println(ServletLayout.getClosing());
	}


	/**
	 * Metodo per l'acquisizione del contenuto in post
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

		switch(request.getParameter("tiporicerca")) {
		
			case "cliente":
				response.sendRedirect(request.getContextPath() + "/listaClienti?valore=" + request.getParameter("ricerca"));
				return;
			case "biglietto":
				response.sendRedirect(request.getContextPath() + "/listaBiglietti?valoreCliente=" + request.getParameter("ricerca") + "&valoreData=");
				return;
			case "abbonamento":
				response.sendRedirect(request.getContextPath() + "/listaAbbonamenti?valoreCliente=" + request.getParameter("ricerca") + "&valoreData=");
				return;
			case "priority":
				response.sendRedirect(request.getContextPath() + "/listaPriority?valoreCliente=" + request.getParameter("ricerca") + "&valoreData=");
				return;
			case "evento":
				response.sendRedirect(request.getContextPath() + "/listaEventi?nome=" + request.getParameter("ricerca"));
				return;
			case "spettacolo":
				response.sendRedirect(request.getContextPath() + "/listaSpettacoli?valore=" + request.getParameter("ricerca"));
				return;
			case "attrazione":
				response.sendRedirect(request.getContextPath() + "/listaAttrazioni?valore=" + request.getParameter("ricerca"));
				return;
		}
	}

}