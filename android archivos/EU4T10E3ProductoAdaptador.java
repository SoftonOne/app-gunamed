package ejercicios.pe.edu.upeu.misejercicios;


import android.content.Context;
import android.graphics.Paint;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

import ejercicios.pe.edu.upeu.misejercicios.bean.EU3T8E1CarritoBE;
import ejercicios.pe.edu.upeu.misejercicios.modelo.EU3T8E1CarritoDao;

/**
 * Created by USUARIO on 7/05/2017.
 */

public class EU4T10E3ProductoAdaptador extends BaseAdapter {

    Context context;
    ArrayList<EU4T10E3Producto> productos;

    public EU4T10E3ProductoAdaptador(EU4T10E3BuscarProductoActivity context, ArrayList<EU4T10E3Producto> productos) {
        this.context = context;
        this.productos = productos;
    }

    @Override
    public int getCount() {
        return productos.size();
    }
    @Override
    public Object getItem(int position) {
        return productos.get(position);
    }
    @Override
    public long getItemId(int position) {
        return position;
    }
    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        TextView u4t10TxtViewTitulo,u4t10TxtTipo,u4t10TxtAnio,u4t10TxtPanterior,u4t10TxtPactual;
        Button u4t10Adicionar;
        LayoutInflater layoutInflater;
        View view;
        layoutInflater=(LayoutInflater)context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        view=layoutInflater.inflate(R.layout.activity_eu4_t10_e3_fila_producto,parent,false);

        u4t10TxtViewTitulo=(TextView)view.findViewById(R.id.u4t10TxtViewTitulo);
        u4t10TxtTipo=(TextView)view.findViewById(R.id.u4t10TxtTipo);
        u4t10TxtAnio=(TextView)view.findViewById(R.id.u4t10TxtAnio);
        u4t10TxtPanterior=(TextView)view.findViewById(R.id.u4t10TxtPanterior);
        u4t10TxtPactual=(TextView)view.findViewById(R.id.u4t10TxtPactual);
        u4t10Adicionar=(Button)view.findViewById(R.id.u4t10Adicionar);

        u4t10TxtViewTitulo.setText(productos.get(position).getTitulo());
        u4t10TxtTipo.setText(productos.get(position).getTipo());
        u4t10TxtAnio.setText(productos.get(position).getAnio());
        u4t10TxtPanterior.setText("S/. "+productos.get(position).getPanterior().toString());
        // estilo para tachado
        u4t10TxtPanterior.setPaintFlags(u4t10TxtPanterior.getPaintFlags() | Paint.STRIKE_THRU_TEXT_FLAG);
        u4t10TxtPactual.setText("S/. "+productos.get(position).getPactual().toString());

        u4t10Adicionar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EU4T10E3Producto U4T10E3Producto=(EU4T10E3Producto) getItem(position);
                EU3T8E1CarritoDao dao=new EU3T8E1CarritoDao(context);
                EU3T8E1CarritoBE bean=dao.encontrar(U4T10E3Producto.getCodigo());
                if(bean==null){
                    bean=new EU3T8E1CarritoBE();
                    bean.setCodProducto(dao.getMax());
                    bean.setDesProducto(productos.get(position).getTitulo()+" "+productos.get(position).getTipo()+" "+productos.get(position).getAnio()+" \n "+" "+"S/. "+productos.get(position).getPactual().toString());
                    bean.setPrecio(new Float(productos.get(position).getPactual().toString()));
                    bean.setCantidad(new Long(1));
                    dao.insertar(bean);
                }else{
                    bean.setCantidad(bean.getCantidad()+1);
                    dao.update(bean);
                }
                Toast.makeText(context,"Producto "+U4T10E3Producto.getTitulo()+" Adicionado en Carrito ",Toast.LENGTH_SHORT).show();
            }
        });

        return view;
    }

}

