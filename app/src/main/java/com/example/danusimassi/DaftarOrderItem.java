package com.example.danusimassi;

import com.google.gson.annotations.SerializedName;
public class DaftarOrderItem {
    @SerializedName("id")
    private String id;
    @SerializedName("menu_makanan")
    private String menu_makanan;
    @SerializedName("harga")
    private String harga;
    @SerializedName("username")
    private String username;
    @SerializedName("jumlah")
    private String jumlah;
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
    public String getUsername() {
        return username;
    }
    public void setUsername(String username) {
        this.username = username;
    }
    public String getJumlah() {
        return jumlah;
    }
    public void setJumlah(String jumlah) {
        this.jumlah = jumlah;
    }
}

