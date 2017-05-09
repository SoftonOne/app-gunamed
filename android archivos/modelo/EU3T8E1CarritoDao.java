package ejercicios.pe.edu.upeu.misejercicios.modelo;

import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;

import ejercicios.pe.edu.upeu.misejercicios.bean.EU3T8E1CarritoBE;

/**
 * Created by USUARIO on 7/05/2017.
 */

public class EU3T8E1CarritoDao {
    Context context;
    public EU3T8E1CarritoDao(Context context) {
        this.context = context;
    }
    public ArrayList<EU3T8E1CarritoBE> listar(){
        ArrayList<EU3T8E1CarritoBE> listaCarrito=null;
        listaCarrito=new ArrayList<EU3T8E1CarritoBE>();
        EU3T8E1CarritoBE bean;
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getReadableDatabase();
        Cursor curs=db.rawQuery(" select * from carrito ",null);
        while (curs.moveToNext()){
            bean=new EU3T8E1CarritoBE();
            bean.setCodProducto(curs.getLong(0));
            bean.setDesProducto(curs.getString(1));
            bean.setCantidad(curs.getLong(2));
            bean.setPrecio(curs.getFloat(3));
            bean.setTotal(curs.getFloat(4));
            listaCarrito.add(bean);
        }
        return listaCarrito;
    }

    public void insertar(EU3T8E1CarritoBE bean){
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getWritableDatabase();
        db.execSQL(" insert into carrito (codProducto,desProducto,cantidad,precio,total) " +
                        "values(?,?,?,?,?) ",
                new Object[] {bean.getCodProducto(),bean.getDesProducto(),bean.getCantidad(),
                        bean.getPrecio(),bean.getTotal()});
    }

    public void update(EU3T8E1CarritoBE bean){
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getWritableDatabase();
        db.execSQL(" update carrito set cantidad=? where codProducto=?",
                new Object[] {bean.getCantidad(),bean.getCodProducto()});
    }

    public void delete(Long codProducto){
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getWritableDatabase();
        db.execSQL(" delete from carrito where codProducto=?", new Object[] {codProducto});
    }

    public Long getMax(){
        Long valMax=new Long(1);
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getReadableDatabase();
        Cursor curs=db.rawQuery(" select max(codProducto)+1 from carrito ",null);
        if(curs.moveToNext()){
            return curs.getLong(0);
        }
        return valMax;
    }

    public Float getTotal(){
        Float total=new Float(0);
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getReadableDatabase();
        Cursor curs=db.rawQuery(" select sum(cantidad*precio) from carrito ",null);
        if(curs.moveToNext()){
            return curs.getFloat(0);
        }
        return total;
    }

    public EU3T8E1CarritoBE encontrar(Long codProducto){
        EU3T8E1CarritoBE bean;
        EU3T8E1MiConexion conexion=new EU3T8E1MiConexion(context,null,null,1);
        SQLiteDatabase db=conexion.getReadableDatabase();
        Cursor curs=db.rawQuery(" select * from carrito where  codProducto="+codProducto,null);
        if (curs.moveToNext()){
            bean=new EU3T8E1CarritoBE();
            bean.setCodProducto(curs.getLong(0));
            bean.setDesProducto(curs.getString(1));
            bean.setCantidad(curs.getLong(2));
            bean.setPrecio(curs.getFloat(3));
            bean.setTotal(curs.getFloat(4));
            return bean;
        }
        return null;
    }

}
