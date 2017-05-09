package ejercicios.pe.edu.upeu.misejercicios;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import java.util.ArrayList;

import ejercicios.pe.edu.upeu.misejercicios.bean.EU3T8E1CarritoBE;
import ejercicios.pe.edu.upeu.misejercicios.modelo.EU3T8E1CarritoDao;

public class EU3T9E1SQLiteMVCActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eu3_t9_e1_sqlite_mvc);
        TableLayout tableLayoutCarrito=(TableLayout)findViewById(R.id.tblLayout);
        EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(this);
        ArrayList<EU3T8E1CarritoBE> lista=dao.listar();
        EU3T8E1CarritoBE bean;
        for(int i=0;i<lista.size();i++){
            bean=lista.get(i);
            TableRow filaTableRow=new TableRow(this);
            TextView textViewDesProducto=new TextView(this);
            textViewDesProducto.setText(bean.getDesProducto());
            filaTableRow.addView(textViewDesProducto);
            TextView textViewSubtotal=new TextView(this);
            textViewSubtotal.setText(new Float(bean.getPrecio()*bean.getCantidad()).toString());
            filaTableRow.addView(textViewSubtotal);
            EditText editTextCantida=new EditText(this);
            editTextCantida.setText(bean.getCantidad().toString());
            filaTableRow.addView(editTextCantida);
            tableLayoutCarrito.addView(filaTableRow);
        }
    }
}
