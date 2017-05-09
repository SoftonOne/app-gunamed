package ejercicios.pe.edu.upeu.misejercicios;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;


import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

public class EU4T10E3BuscarProductoActivity extends AppCompatActivity implements View.OnClickListener {

    ListView listViewProductos;
    ArrayList<EU4T10E3Producto> productos=new ArrayList<>();
    EU4T10E3Producto  u4T10E3Producto;
    EU4T10E3ProductoAdaptador miAdaptador;
    Button u4t10buttonBuscar;
    EditText u4t10editTextBuscar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eu4_t10_e3_buscar_producto);
        u4t10buttonBuscar=(Button)findViewById(R.id.u4t10ButtonBuscar);
        u4t10buttonBuscar.setOnClickListener(this);
        listViewProductos=(ListView)findViewById(R.id.u4t10ListViewProductos);
        miAdaptador= new EU4T10E3ProductoAdaptador(this,productos);
        listViewProductos.setAdapter(miAdaptador);
        listViewProductos.deferNotifyDataSetChanged();
        u4t10editTextBuscar=(EditText)findViewById(R.id.u4t10editTextBuscar);
        new Cargar().execute("");
        miAdaptador= new EU4T10E3ProductoAdaptador(this,productos);
        listViewProductos.setAdapter(miAdaptador);
    }

    @Override
    public void onClick(View v) {
        new Cargar().execute("");
        miAdaptador= new EU4T10E3ProductoAdaptador(this,productos);
        listViewProductos.setAdapter(miAdaptador);
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
                //  Toast.makeText(this," Buscar mi producto",Toast.LENGTH_SHORT).show();
                break;
            case R.id.itemMiCarritoCompras :
                Intent inten=new Intent(EU4T10E3BuscarProductoActivity.this,EU4T10E3CarritoActivity.class);
                startActivity(inten);
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    class Cargar extends AsyncTask<String,Void,Boolean> {
        ProgressDialog dialog;
        @Override
        protected Boolean doInBackground(String... params) {
            Bitmap bitmapImg;
            String data=null;
            //HttpGet httpget = new HttpGet("http://10.0.13.197/respuesta.json/?s="+params[0]);
            HttpGet httpget = new HttpGet("http://192.168.8.100/comercio/respuesta.json");
            HttpClient httpclient = new DefaultHttpClient();
            try{
                HttpResponse response = httpclient.execute(httpget);
                HttpEntity entity = response.getEntity();
                data = EntityUtils.toString(entity);
                JSONObject jsono = new JSONObject(data);
                JSONArray jarray = jsono.getJSONArray("Search");
                for (int i = 0; i < jarray.length(); i++) {
                    JSONObject object = jarray.getJSONObject(i);
                    Log.d("Debug My APP ",""+object);
                    //object.getString("Poster");
                    u4T10E3Producto=new EU4T10E3Producto();
                    u4T10E3Producto.setCodigo(new Long(i+1));
                    u4T10E3Producto.setTitulo(object.getString("Title"));
                    u4T10E3Producto.setAnio(object.getString("Year"));
                    u4T10E3Producto.setTipo(object.getString("Type"));
                    u4T10E3Producto.setPactual(new Double(10));
                    u4T10E3Producto.setPanterior(new Double(20));

                    productos.add(u4T10E3Producto);
                }
            } catch (IOException e) {
                e.printStackTrace();
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }
        protected void onPostExecute(Boolean aBoolean) {
            dialog.dismiss();
        }
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            dialog = new ProgressDialog(EU4T10E3BuscarProductoActivity.this);
            dialog.setMessage("Cargando, por favor esperar");
            dialog.setTitle("Conectando con el servidor");
            dialog.show();
            dialog.setCancelable(false);
        }

    }

}
