package pak1;

public class Main {
	
	private DB_connection dbConnect = new DB_connection("/home/cparra/authKey.json");
	
	private User_DB userOps = new User_DB();
	
	public void connect(){
		dbConnect.setupDBConnection();
	}
	
	public void getUser(String email){
		userOps.getUserInfo(email);
	}
	
	public String getUserName(String email){
		return userOps.getUserInfo(email).getDisplayName();
	}
	
	public void createUser(String email, String password, String name, String birthday){
		userOps.createUser(email, password, name, birthday);
	}
	
	public void deleteUser(String email){
		userOps.deleteUser(email);
	}
	

//	public static void main(String[] args) {
//		
//		Main main = new Main();
//		System.out.println("About to connect: " + new java.util.Date());
//		main.connect();
//		System.out.println("Connected at: " + new java.util.Date());
//		
//		
//		String name = main.getUserName("carlos@mail.com");
//		System.out.println("Name is: " + name);
//	}

}
