package pak1;

import java.util.concurrent.ExecutionException;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.UserRecord;
import com.google.firebase.auth.UserRecord.CreateRequest;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class User_DB implements I_User_DB {

	public UserRecord getUserInfo(String email) {
		UserRecord userRecord = null;
		try {
			userRecord = FirebaseAuth.getInstance().getUserByEmailAsync(email).get();
			
			System.out.println("Successfully fetched user data: " + userRecord.getEmail());
			
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		} catch (ExecutionException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		}
		return userRecord;
	}

	public void createUser(String email, String password, String name, String birthday) {
		
		User user = new User(email, name, birthday);
		
		CreateRequest request = new CreateRequest()
		.setEmail(email)
	    .setEmailVerified(false)
	    .setPassword(password)
	    .setDisplayName(name)
	    .setDisabled(false);

		UserRecord userRecord = null;
		try {
			userRecord = FirebaseAuth.getInstance().createUserAsync(request).get();
			System.out.println("Successfully created new user: " + userRecord.getUid());
			
			writeUserToDB(userRecord.getUid(), user);
			Thread.sleep(2000);
			
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		} catch (ExecutionException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		}

		
	}
	
	private void writeUserToDB(String id, User user){
		final FirebaseDatabase database = FirebaseDatabase.getInstance();
		DatabaseReference ref = database.getReference("server");
		DatabaseReference usersRef = ref.child("users");
		
		usersRef.child(id).setValueAsync(user);
	}

	public void deleteUser(String email) {
		UserRecord user = getUserInfo(email);
		
		String uid = user.getUid();
		
		try {
			FirebaseAuth.getInstance().deleteUserAsync(uid).get();
			System.out.println("Successfully deleted user.");
			writeUserToDB(uid, null);
			Thread.sleep(2000);
			
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (ExecutionException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}

}
