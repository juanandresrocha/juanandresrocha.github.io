package pak1;


import org.junit.Assert;
import org.junit.BeforeClass;
import org.junit.Test;

import com.google.firebase.auth.UserRecord;

public class User_DBTest {
	
	public static DB_connection dbConnect = new DB_connection("authKey.json");
	public User_DB userTest = new User_DB();
	
	@BeforeClass
	public static void beforeClass(){
		dbConnect.setupDBConnection();
	}

	@Test
	public void getUserInfo() {
		UserRecord user = userTest.getUserInfo("cris@mail.com");
		Assert.assertEquals("cris@mail.com", user.getEmail());
	}
	
//	@Test
//	public void createUser(){
//		
//		//User u = new User("joel@mail.com", "pass1234", "Joel Miguel", "1/1/1990");
//		userTest.createUser("jose@mail.com", "contraseña", "Jose Mujica", "1/1/1990");
//		
//		UserRecord user = userTest.getUserInfo("jose@mail.com");
//		Assert.assertEquals("jose@mail.com", user.getEmail());
//
//	}
	
//	@Test
//	public void writeUserToDB(){
//		User u = new User("carlos@mail.com", "carlos123", "Carlos Glez", "2/12/1992");
//		userTest.createUser(u);
//		
//		UserRecord user = userTest.getUserInfo("carlos@mail.com");
//		
//		
//		String id = user.getUid();
//
//		System.out.println("id is: " + id);
//		System.out.println(u);
//		
//		//userTest.writeUserToDB("Gg7HPAqCtkXXa6PKK4CxDw5I4eF2", u);
//	}
	
	@Test
	public void deleteUser(){
		
		//userTest.getUserInfo("joel@mail.com");
		userTest.deleteUser("luis@mail.com");
		
		
		//Assert.assertEquals("cris@mail.com", user.getEmail());
		
	}

}
