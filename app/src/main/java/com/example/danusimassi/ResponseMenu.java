package com.example.danusimassi;

import com.google.gson.annotations.SerializedName;
import java.util.List;

public class ResponseMenu {
    @SerializedName("menu")
    private List<DaftarMenuItem> daftarmenu;
    @SerializedName("order")
    private List<DaftarOrderItem> daftarpesanan;
    @SerializedName("error")
    private boolean error;
    @SerializedName("message")
    private String message;
    public List<DaftarMenuItem> getDaftarmenu() {
        return daftarmenu;
    }
    public void setDaftarmenu(List<DaftarMenuItem> daftarmenu) {
        this.daftarmenu = daftarmenu;
    }
    public List<DaftarOrderItem> getDaftarpesanan() {
        return daftarpesanan;
    }
    public void setDaftarpesanan(List<DaftarOrderItem> daftarpesanan) {
        this.daftarpesanan = daftarpesanan;
    }
    public boolean isError() {
        return error;
    }
    public void setError(boolean error) {
        this.error = error;
    }
    public String getMessage() {
        return message;
    }
    public void setMessage(String message) {
        this.message = message;
    }
    @Override
    public String toString() {
        return "{"+ "error="+error+ ",message="+message+",menu="+daftarmenu + "}";
    }
}
