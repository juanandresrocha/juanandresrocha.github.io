package pak1;

public class User {
	
	private String email;
	private String password;
	private String name;
	private String birthday;
	
	public User(String email, String name, String birthday){
		this.email = email;
		this.name = name;
		this.birthday = birthday;
	}
	
	 public String getBirthday() {
		return birthday;
	}
	 
	 public String getName() {
		return name;
	}
	
	 public String getEmail() {
		return email;
	}
	 
	 public void setBirthday(String birthday) {
		this.birthday = birthday;
	}
	 
	 public void setEmail(String email) {
		this.email = email;
	}
	 
	 public void setName(String name) {
		this.name = name;
	}
}
