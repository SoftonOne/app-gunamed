package ejercicios.pe.edu.upeu.misejercicios;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import java.util.ArrayList;

import ejercicios.pe.edu.upeu.misejercicios.bean.EU3T8E1CarritoBE;
import ejercicios.pe.edu.upeu.misejercicios.modelo.EU3T8E1CarritoDao;

public class EU3T8E1PersistenciaSQLiteActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eu3_t8_e1_persistencia_sqlite);
        EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(this);
        EU3T8E1CarritoBE bean=new EU3T8E1CarritoBE();
        bean.setCodProducto(new Long(2));
        bean.setDesProducto(" Producto 1");
        bean.setCantidad(new Long(1));
        bean.setPrecio(new Float(15.5));
        bean.setTotal(new Float(15.5));
        dao.insertar(bean);
        ArrayList<EU3T8E1CarritoBE> listar=dao.listar();
        for (int i=0;i<listar.size();i++){
            bean=new EU3T8E1CarritoBE();
            bean=listar.get(i);
            Log.d("MiProyecto"," Codigo Producto:"+bean.getCodProducto()+" , " +
                    "descripción producto : "+bean.getDesProducto());
        }
    }
}
