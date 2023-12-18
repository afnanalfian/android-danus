package com.example.danusimassi;

import com.google.gson.annotations.SerializedName;
public class DaftarMenuItem {
    @SerializedName("id")
    private String id;
    @SerializedName("menu_makanan")
    private String menu_makanan;
    @SerializedName("harga")
    private String harga;
    public String getId() {
        return id;
    }
    public void setId(String id) {
        this.id = id;
    }
    public String getMenu_makanan() {
        return menu_makanan;
    }
    public void setMenu_makanan(String menu_makanan) {
        this.menu_makanan = menu_makanan;
    }
    public String getHarga() {
        return harga;
    }
    public void setHarga(String harga) {
        this.harga = harga;
    }
    @Override
    public String toString() {
        return "{" + "id:" + id + ",menu_makanan:" + menu_makanan + ",harga:" + harga + "}";
    }
}
