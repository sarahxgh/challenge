import java.awt.Color;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Date;
import javax.swing.*;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;
import java.awt.Rectangle;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;


public class MyFrame extends JFrame {
	static int counter;
	JLabel lblNewLabel_4 = new JLabel();
	/**
	 * 
	 */
	private static final long serialVersionUID = 3866707498457681736L;
	static final String URL = "jdbc:hsqldb:hsql://localhost/";
	JTable table = new JTable();
	 Object [] row = new Object [6];
	 Object [] columns = {"ID" , "TITLE" , "DESCRIPTION" , "PRICE" , "QTE" , "DATE"};
	 DefaultTableModel model = new DefaultTableModel();
	MyFrame() {
		//utilities
		try {
			this.initCounter(counter);
		} catch (SQLException e2) {
			// TODO Auto-generated catch block
			e2.printStackTrace();
		}
		
		//default framing
		 this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		 this.getContentPane().setLayout(null);
		 this.setLocationRelativeTo(null);
		 this.setBounds(500,200,973,651);
		 this.setResizable(false);
		//table
		 model.setColumnIdentifiers(columns);
		 table.setModel(model);
		 
		 table.setBackground(Color.WHITE);
		 table.setForeground(Color.black);
		 table.setSelectionBackground(Color.red);
		 table.setGridColor(Color.red);
		 table.setSelectionForeground(Color.white);
		 table.setFont(new Font("Tahoma" , Font.PLAIN , 17));
		 table.setRowHeight(30);
		 table.setAutoCreateRowSorter(true);
		 
		 
		 JScrollPane pane = new JScrollPane(table);
		 getContentPane().add(pane);
		 pane.setBounds(new Rectangle(0, 0, 900, 300));
		 pane.setForeground(Color.red);
		 pane.setBackground(Color.white);
		 pane.setBounds(32,174,891,340);
		 
		 JButton btnNewButton = new JButton("Remove..");
		 btnNewButton.setFont(new Font("Tahoma", Font.PLAIN, 15));
		 btnNewButton.setForeground(new Color(255, 0, 0));
		 btnNewButton.addActionListener(new ActionListener() {
		 	public void actionPerformed(ActionEvent e) {
		 		int column = 0;
		 		int row = table.getSelectedRow();
		 		int value = Integer.parseInt(table.getModel().getValueAt(row, column).toString());
		 		
		 		if (row>=0) {
		 			try {
		 				removeExpense(value);
		 				model.removeRow(row);
		 				validate();
		 				return;	
					} catch (Exception e1) {
						e1.printStackTrace();
						return;
					}
		 		}

		 	}
		 });
		 btnNewButton.setBounds(793, 140, 118, 29);
		 getContentPane().add(btnNewButton);
		 
		 JLabel lblNewLabel = new JLabel("WELCOME TO THE EXPENSE TRACKER !");
		 lblNewLabel.setForeground(new Color(64, 0, 128));
		 lblNewLabel.setHorizontalAlignment(SwingConstants.CENTER);
		 lblNewLabel.setFont(new Font("Futura MdCn BT", Font.BOLD, 30));
		 lblNewLabel.setBounds(10, 31, 933, 68);
		 getContentPane().add(lblNewLabel);
		 
		 JButton btnNewButton_1 = new JButton("ADD..");
		 btnNewButton_1.addActionListener(new ActionListener() {
		 	public void actionPerformed(ActionEvent e) {
		 		newFrame();	
	 	}
		 });
		 btnNewButton_1.setFont(new Font("Tahoma", Font.PLAIN, 17));
		 btnNewButton_1.setForeground(new Color(0, 255, 64));
		 btnNewButton_1.setBackground(new Color(240, 240, 240));
		 btnNewButton_1.setBounds(669, 140, 103, 29);
		 getContentPane().add(btnNewButton_1);
		 
		 JLabel lblNewLabel_3 = new JLabel("TOTAL :");
		 lblNewLabel_3.setFont(new Font("Futura Md BT", Font.PLAIN, 20));
		 lblNewLabel_3.setBounds(32, 140, 109, 25);
		 getContentPane().add(lblNewLabel_3);
		 
		 
		 lblNewLabel_4.setFont(new Font("Futura", Font.PLAIN, 18));
		 lblNewLabel_4.setBounds(108, 142, 208, 29); 
		 try {
			lblNewLabel_4.setText(getTotal() + " $");
		} catch (Exception e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		 getContentPane().add(lblNewLabel_4);
		 
		 try {displayExpense();} catch (Exception e) {};
		 this.setVisible(true);
	}
	public String getTotal () throws Exception{
        Connection conn = DriverManager.getConnection(URL , "SA" , ""); //connect to db
        Statement stmt = conn.createStatement(); //discuuss with db
        int total=0;
        ResultSet rs = stmt.executeQuery("SELECT E_PRICE , E_QTE FROM EXPENSE;"); //query give it to stmt
        while (rs.next()) {
            total += rs.getInt("E_QTE") * rs.getDouble("E_PRICE");
        }
        return Integer.toString(total);
    }
	public void addOneRow (int id,String t, String d, String ds, double p, int q) {
		row[0] = id;
		row[1] = t;
		row[2] = ds;
		row[3] = p ;
		row [4] = q;
		row[5] = d;
		model.addRow(row);
	}
	void newFrame () {
		 setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
			setBounds(761, 379, 450, 300);
			this.setResizable(false);
			JPanel contentPane = new JPanel();
			contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

			setContentPane(contentPane);
			contentPane.setLayout(null);
			
			
			
			JTextField id = new JTextField();
			
			id.setBounds(100, 60, 86, 20);
			contentPane.add(id);
			id.setColumns(10);
			
			JLabel lblNewLabel = new JLabel("ADD NEW EXPENSE");
			lblNewLabel.setBounds(100, 11, 225, 24);
			lblNewLabel.setFont(new Font("Futura", Font.BOLD, 23));
			lblNewLabel.setForeground(new Color(0, 255, 0));
			contentPane.add(lblNewLabel);
			
			JLabel lblNewLabel_1 = new JLabel("E_ID");
			lblNewLabel_1.setBounds(44, 63, 46, 14);
			contentPane.add(lblNewLabel_1);
			
			JLabel lblNewLabel_2 = new JLabel("E_TITLE");
			lblNewLabel_2.setBounds(44, 111, 46, 14);
			contentPane.add(lblNewLabel_2);
			
			JTextField t = new JTextField();
			t.setColumns(10);
			t.setBounds(100, 108, 86, 20);
			contentPane.add(t);
			
			JLabel lblNewLabel_2_1 = new JLabel("E_DESC");
			lblNewLabel_2_1.setBounds(44, 164, 46, 14);
			contentPane.add(lblNewLabel_2_1);
			
			JTextField desc = new JTextField();
			desc.setColumns(10);
			desc.setBounds(100, 161, 86, 20);
			contentPane.add(desc);
			
			JLabel lblNewLabel_1_1 = new JLabel("E_PRICE");
			lblNewLabel_1_1.setBounds(234, 63, 61, 14);
			contentPane.add(lblNewLabel_1_1);
			
			JTextField p = new JTextField();
			p.setColumns(10);
			p.setBounds(305, 60, 86, 20);
			contentPane.add(p);
			
			JLabel lblNewLabel_1_1_1 = new JLabel("E_DATE");
			lblNewLabel_1_1_1.setBounds(234, 111, 46, 14);
			contentPane.add(lblNewLabel_1_1_1);
			
			JTextField d = new JTextField();
			d.setColumns(10);
			d.setBounds(305, 108, 86, 20);
			contentPane.add(d);
			
			JTextField q = new JTextField();
			q.setColumns(10);
			q.setBounds(305, 161, 86, 20);
			contentPane.add(q);
			
			JLabel lblNewLabel_1_1_1_1 = new JLabel("E_QTE");
			lblNewLabel_1_1_1_1.setBounds(234, 164, 46, 14);
			contentPane.add(lblNewLabel_1_1_1_1);
			
			JButton btnNewButton = new JButton("OK!");
			btnNewButton.addActionListener(new ActionListener()  {
				public void actionPerformed(ActionEvent e)  {
					boolean success=false;
					
					if (isEmpty(id) || isEmpty (t) || isEmpty(p)) {
						JOptionPane.showMessageDialog(null, "Empty fields");
						setVisible(false);
						new MyFrame();
					}
					try {
						LocalDate currentDate = LocalDate.now();
						if (isEmpty(desc)) desc.setText("-");
						if (isEmpty(d)) d.setText(currentDate.format(DateTimeFormatter.ofPattern("dd-MM-yyyy")));
						if (isEmpty(q)) q.setText("1");
						
						success = addExpense (Integer.parseInt(id.getText()),t.getText(),d.getText(),desc.getText(),Double.parseDouble(p.getText()),Integer.parseInt(q.getText()));
					if (success) {
						setVisible(false);
						addOneRow(Integer.parseInt(id.getText()),t.getText(),d.getText(),desc.getText(),Double.parseDouble(p.getText()),Integer.parseInt(q.getText()));
						new MyFrame();
						return;
					}
					else {
						JOptionPane.showMessageDialog(null, "Something went Wrong with the insertion");
						return;
					}
					}
				}
			}
	}
	private void initCounter(int c) throws SQLException {
		c=0;
		Connection conn = DriverManager.getConnection(URL , "SA" , ""); //connect to db
		Statement stmt = conn.createStatement(); //discuuss with db

		ResultSet rs = stmt.executeQuery("SELECT E_ID FROM EXPENSE;"); //query give it to stmt
		while (rs.next()) {
			c++;
		}
	}

	public boolean addExpense(int id,String t, String d, String ds, double p, int q) throws Exception {
		Connection conn = DriverManager.getConnection(URL , "SA" , ""); //connect to db
		counter++;
		Statement stmt = conn.createStatement(); //discuuss with db

		ResultSet rs = stmt.executeQuery("SELECT E_ID FROM EXPENSE;"); //query give it to stmt

		while (rs.next()) {
			if (rs.getInt("E_ID") == id) {
				setVisible(false);
				JOptionPane.showMessageDialog(new MyFrame(), "INTEGRITY CONSTRAINT VIOLATION");
				return false;
			}}

		rs = stmt.executeQuery("INSERT INTO EXPENSE VALUES (" + id + ",'" + t + "','" + ds + "'," + p + "," + q + ",to_date ('" + d +"','dd-mm-yyyy'));"); //query give it to stmt
		rs.next();
		lblNewLabel_4.setText(getTotal() + " $");
		return true;
	}
	/**
      * @author oumaima
      * This function would add rows to the table and display all the expenses.
      * @throws SQLException
      */
    public void displayExpense () throws SQLException{
        Connection conn = DriverManager.getConnection(URL , "SA" , ""); //connect to db
        
        Statement stmt = conn.createStatement(); //discuuss with db
        ResultSet rs = stmt.executeQuery("SELECT * FROM EXPENSE;"); //query give it to stmt
        
        while (rs.next()) {
            int id = rs.getInt("E_ID");
            String t = rs.getString("E_TITLE");
            Date d = rs.getDate("E_DATE");
            
            String ds = rs.getString("E_DESC");
            float p = rs.getFloat("E_PRICE");
            int q = rs.getInt("E_QTE");
            
            row[0] = id;
            row[1] = t;
            row[2] = ds;
            row[3] = p ;
            row [4] = q;
            row[5] = d;
            model.addRow(row);
            
        }
    }
}
}
