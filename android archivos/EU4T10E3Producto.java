package ejercicios.pe.edu.upeu.misejercicios;

/**
 * Created by USUARIO on 7/05/2017.
 */

public class EU4T10E3Producto {

    private Long codigo;
    private String titulo;
    private String anio;
    private String tipo;
    private Double pactual;
    private Double panterior;

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public String getAnio() {
        return anio;
    }

    public void setAnio(String anio) {
        this.anio = anio;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public Double getPactual() {
        return pactual;
    }

    public void setPactual(Double pactual) {
        this.pactual = pactual;
    }

    public Double getPanterior() {
        return panterior;
    }

    public void setPanterior(Double panterior) {
        this.panterior = panterior;
    }

    public Long getCodigo() {
        return codigo;
    }

    public void setCodigo(Long codigo) {
        this.codigo = codigo;
    }


}
