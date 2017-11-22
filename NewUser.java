package pak1;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class UserFront
 */
@WebServlet("/NewUser")
public class NewUser extends HttpServlet {
	private static final long serialVersionUID = 1L;
	private Main main;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public NewUser() {
        super();
        main = new Main();
        
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String email = request.getParameter("email");
		String password = request.getParameter("password");
		String name = request.getParameter("name");
		String birthday = request.getParameter("birthday");
		
		main.connect();
		
		main.createUser(email, password, name, birthday);
		
		String verifyName = main.getUserName(email);
		//response.sendRedirect("index.jsp");
		PrintWriter writer = response.getWriter();
		writer.println("You are: " + verifyName);
		writer.flush();
		
	}

}
