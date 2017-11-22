package pak1;


public interface I_User_DB {
	
	public Object getUserInfo(String email);
	
	public void createUser(String email, String password, String name, String birthday);
	
	public void deleteUser(String email);
	
}
