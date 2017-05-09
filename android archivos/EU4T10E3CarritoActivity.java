package ejercicios.pe.edu.upeu.misejercicios;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

import ejercicios.pe.edu.upeu.misejercicios.bean.EU3T8E1CarritoBE;
import ejercicios.pe.edu.upeu.misejercicios.modelo.EU3T8E1CarritoDao;

public class EU4T10E3CarritoActivity extends AppCompatActivity {
    TextView u04t10TextViewSubTotal,u04t10TextViewEnvio,u04t10TextViewTotal;
    TableLayout tableLayoutCarrito;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eu4_t10_e3_carrito);
        cargaTablaLayout();
        modificaTotal();
    }

    public void cargaTablaLayout(){

        tableLayoutCarrito=(TableLayout)findViewById(R.id.u4t10e3IdTableLayout);
        u04t10TextViewSubTotal=(TextView)findViewById(R.id.u04t10TextViewSubTotal);
        u04t10TextViewEnvio=(TextView)findViewById(R.id.u04t10TextViewEnvio);
        u04t10TextViewTotal=(TextView)findViewById(R.id.u04t10TextViewTotal);
        int count = tableLayoutCarrito.getChildCount();
        for (int i = 1; i < count; i++) {
            View child = tableLayoutCarrito.getChildAt(i);
            if (child instanceof TableRow) ((ViewGroup) child).removeAllViews();
        }

        EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(this);
        ArrayList<EU3T8E1CarritoBE> lista=dao.listar();
        EU3T8E1CarritoBE bean;
        for(int i=0;i<lista.size();i++){
            bean=lista.get(i);
            TableRow filaTableRow=new TableRow(this);
            TextView textViewDesProducto=new TextView(this);
            textViewDesProducto.setText(bean.getDesProducto());
            filaTableRow.addView(textViewDesProducto);
            EditText editTextCantida=new EditText(this);
            editTextCantida.setText(bean.getCantidad().toString());
            final EU3T8E1CarritoBE finalBean1 = bean;
            editTextCantida.addTextChangedListener(new TextWatcher() {
                @Override
                public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                }
                @Override
                public void onTextChanged(CharSequence s, int start, int before, int count) {
                    EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(getBaseContext());
                    if(s.toString().trim().length()>0){
                        finalBean1.setCantidad(new Long(s.toString()));
                        dao.update(finalBean1);
                        modificaTotal();
                    }
                }
                @Override
                public void afterTextChanged(Editable s) {
                }
            });
            filaTableRow.addView(editTextCantida);
            ImageButton imageButton=new ImageButton(this);
            imageButton.setImageResource(android.R.drawable.ic_menu_delete);
            final EU3T8E1CarritoBE finalBean = bean;
            imageButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(getBaseContext());
                    dao.delete(finalBean.getCodProducto());
                    Toast.makeText(getBaseContext(),"Se ha eliminado el producto "+finalBean.getDesProducto(),Toast.LENGTH_SHORT).show();
                    refreshActivity();
                }
            });
            filaTableRow.addView(imageButton);
            tableLayoutCarrito.addView(filaTableRow);
        }
        estilo();
    }

    public void refreshActivity(){
        // Refresh main activity upon close of dialog box
        Intent refresh = new Intent(this, EU4T10E3CarritoActivity.class);
        startActivity(refresh);
        this.finish(); //
    }

    public void modificaTotal(){
        EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(getBaseContext());
        String subtotal=dao.getTotal().toString();
        u04t10TextViewSubTotal.setText("S/."+subtotal);
        u04t10TextViewEnvio.setText("S/. 0 ");
        u04t10TextViewTotal.setText("S/."+subtotal);
    }

    public void estilo(){
        TableLayout mTable = (TableLayout)findViewById(R.id.u4t10e3IdTableLayout);
        if(mTable.getChildCount()>1){
            for(int i = 1; i < mTable.getChildCount(); i++){
                TableRow tr =  (TableRow)mTable.getChildAt(i);
                TextView textView = (TextView)tr.getChildAt(0);
                ViewGroup.LayoutParams params1= textView.getLayoutParams();
                params1.width = 300;
                textView.setLayoutParams(params1);
                EditText editText = (EditText)tr.getChildAt(1);
                ViewGroup.LayoutParams params= editText.getLayoutParams();
                params.width = 10;
                editText.setLayoutParams(params);
            }
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater=getMenuInflater();
        inflater.inflate(R.menu.mimenu,menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.itemBusarMiProducto:
                Intent inten=new Intent(EU4T10E3CarritoActivity.this,EU4T10E3BuscarProductoActivity.class);
                startActivity(inten);
                break;
        }
        return super.onOptionsItemSelected(item);
    }

}
