package model.dao;

import br.com.ConexaoBanco.ConexaoMySQL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javaapplication3.Temperatura;
import javax.swing.JOptionPane;

public class temDAO {
    
    public void create(Temperatura t){
        Connection con = ConexaoMySQL.getConexaoMySQL();
        PreparedStatement stmt = null;
        
        try {
            stmt = con.prepareStatement("INSERT INTO TEMPERATURA (LOCALIZA,TEMPERATURA,STATE, DATA_SENSOR) VALUES(?,?,?,now())");
            stmt.setString(1, t.getLocaliza());
            stmt.setInt(2, t.getTemperatura());
            stmt.setString(3, t.getState());
                       
            stmt.executeUpdate();
            //JOptionPane.showMessageDialog(null, "Salvo com sucesso!");
            
        } catch (SQLException ex) {
            JOptionPane.showMessageDialog(null, "Erro ao salvar."+ex);
            // Logger.getLogger(temDAO.class.getName()).log(Level.SEVERE, null, ex);
        }finally{
            ConexaoMySQL.FecharConexao();
        }
        
    }   
    
}
