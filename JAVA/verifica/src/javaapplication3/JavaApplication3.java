package javaapplication3;

import br.com.ConexaoBanco.ConexaoMySQL;
import br.pro.turing.javino.*;            // Javino - Para comunicação com Arduino via porta serial (USB)
import model.dao.temDAO;

public class JavaApplication3 {

    public static Javino jBridge = new Javino();
    //private static String port = "/dev/cu.usbmodemFA131"; // Porta serial no MacOS
    private static final String port = "COM4";              // Porta serial no Windows
    //private static final String port2 = "COM5";
    
    public static void main(String[] args) {
       
        while (true) {
          
            if (jBridge.listenArduino(port)) {
                
                String v = jBridge.getData();
                
                if (v != null) {
                    String[] v2 = v.split(";");
              
                    System.out.println(v2[0] + " " + v2[1] + " " + v2[2]);
                
                    Temperatura t = new Temperatura();
                    temDAO dao = new temDAO();
                    t.setTemperatura(Integer.parseInt(v2[1]));
                    t.setLocaliza(v2[0]);
                    t.setState(v2[2]);
                    dao.create(t);
                }             
            }          
        }
    }
}
