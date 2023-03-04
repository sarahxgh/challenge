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
}