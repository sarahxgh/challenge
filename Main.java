//run db
//java -cp hsqldb-2.7.1.jar org.hsqldb.Server --database test
//java -jar hsqldb-2.7.1.jar

public class Main {
	public static void main(String[] args) {
		try {
			MyFrame f = new MyFrame();
			Class.forName("org.hsqldb.jdbc.JDBCDriver");
			
		} catch (Exception e) {
			throw new RuntimeException (e);		
		}
	
	}
}
