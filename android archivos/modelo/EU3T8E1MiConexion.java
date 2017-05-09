package ejercicios.pe.edu.upeu.misejercicios.modelo;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

/**
 * Created by USUARIO on 7/05/2017.
 */

public class EU3T8E1MiConexion extends SQLiteOpenHelper {
    public EU3T8E1MiConexion(Context context, String name,
                            SQLiteDatabase.CursorFactory factory, int version) {
        super(context, "dbU3T8E1Carrito", factory, version);
    }
    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        sqLiteDatabase.execSQL(" create table carrito " +
                "(codProducto integer, desProducto text, cantidad real, " +
                " precio real, total real, primary key (codProducto) )");
    }
    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
    }
}
