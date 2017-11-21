package pak1;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;

import com.google.firebase.FirebaseApp;
import com.google.firebase.FirebaseOptions;
import com.google.firebase.auth.FirebaseCredentials;

@SuppressWarnings("deprecation")
public class DB_connection implements I_DB_connection {
	
	private String pathToFile;
	
	public DB_connection(String pathToFile){
		this.pathToFile = pathToFile;
	}

	public void setupDBConnection() {
		
		FileInputStream serviceAccount;
		try {
			
			
			serviceAccount = new FileInputStream(this.pathToFile);
			
			FirebaseOptions options = new FirebaseOptions.Builder()
			  .setCredential(FirebaseCredentials.fromCertificate(serviceAccount))
			  .setDatabaseUrl("https://finalprojectarq.firebaseio.com")
			  .build();
			
			FirebaseApp.initializeApp(options);
			
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		}
		
	}

}
