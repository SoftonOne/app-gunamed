package ejercicios.pe.edu.upeu.misejercicios.bean;

/**
 * Created by USUARIO on 7/05/2017.
 */

public class EU3T8E1CarritoBE {

    private Long codProducto;
    private String desProducto;
    private Long cantidad;
    private Float precio;
    private Float total;

    public EU3T8E1CarritoBE() {
    }

    public EU3T8E1CarritoBE(Long codProducto, String desProducto, Long cantidad,
                            Float precio, Float total) {
        this.codProducto = codProducto;
        this.desProducto = desProducto;
        this.cantidad = cantidad;
        this.precio = precio;
        this.total = total;
    }

    public Long getCodProducto() {
        return codProducto;
    }

    public void setCodProducto(Long codProducto) {
        this.codProducto = codProducto;
    }

    public String getDesProducto() {
        return desProducto;
    }

    public void setDesProducto(String desProducto) {
        this.desProducto = desProducto;
    }

    public Long getCantidad() {
        return cantidad;
    }

    public void setCantidad(Long cantidad) {
        this.cantidad = cantidad;
    }

    public Float getPrecio() {
        return precio;
    }

    public void setPrecio(Float precio) {
        this.precio = precio;
    }

    public Float getTotal() {
        return total;
    }

    public void setTotal(Float total) {
        this.total = total;
    }

}
