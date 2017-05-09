package ejercicios.pe.edu.upeu.misejercicios;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import java.io.IOException;

public class EU4T10E1ServicioClienteActivity extends AppCompatActivity {
    TextView textView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_eu4_t10_e1_servicio_cliente);
        textView=(TextView)findViewById(R.id.textViewMyApp);
        new TareaCargar().execute();
    }

    class TareaCargar extends AsyncTask<String,Void,String> {
        ProgressDialog progressDialog;
        @Override
        protected String doInBackground(String... params) {
            String rptaDatos=null;
            HttpGet httpget = new HttpGet("http://192.168.8.100/comercio/Producto.json");
            HttpClient httpclient = new DefaultHttpClient();
            try{
                HttpResponse response = httpclient.execute(httpget);
                HttpEntity entity = response.getEntity();
                rptaDatos = EntityUtils.toString(entity);
                Log.d("APP:",rptaDatos);
            } catch (IOException e) {
                e.printStackTrace();
            }
            return rptaDatos;
        }

        protected void onPostExecute(String rptaDatos) {
            textView.setText(rptaDatos);
            progressDialog.dismiss();
        }
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(EU4T10E1ServicioClienteActivity.this);
            progressDialog.setMessage("Cargando, por favor espere!");
            progressDialog.setTitle("Conectando con el Servidor");
            progressDialog.show();
            progressDialog.setCancelable(false);
        }
    }


}
