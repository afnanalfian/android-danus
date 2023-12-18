package com.example.danusimassi;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.danusimassi.API.Interface;
import com.example.danusimassi.API.Utils;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Home extends AppCompatActivity {

    private Button btnUpdate, btnLogout, btnOrder;
    private TextView txtUsername, txtEmail, txtNama, txtAlamat, txtBelum;
    private SharedPrefManager spManager;
    private RecyclerView viewmenu;
    private ProgressDialog loading;
    private Context mediaCtxt;
    private List<DaftarMenuItem> listmenu = new ArrayList<>();
    private MenuAdapter menuAdapter;
    private Interface mApiInterface;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        spManager = new SharedPrefManager(this);
        mApiInterface = Utils.getAPIService();
        mediaCtxt = this;
        txtBelum = (TextView) findViewById(R.id.teks_menu);
        viewmenu = (RecyclerView) findViewById(R.id.menu);
        txtUsername = (TextView) findViewById(R.id.usernameprofile);
        txtEmail = (TextView) findViewById(R.id.emailprofile);
        txtNama = (TextView) findViewById(R.id.nameprofile);
        txtAlamat = (TextView) findViewById(R.id.addressprofile);
        btnLogout = (Button) findViewById(R.id.logout);
        btnUpdate = (Button) findViewById(R.id.updateprofil);
        btnOrder = (Button) findViewById(R.id.list_order);
        txtUsername.setText(spManager.getSpUsername());
        txtEmail.setText(spManager.getSPEmail());
        txtNama.setText(spManager.getSPNama());
        txtAlamat.setText(spManager.getSpAlamat());
        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                spManager.saveSPBoolean(SharedPrefManager.SP_SUDAH_LOGIN, false);
                startActivity(new Intent(Home.this, SignIn.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                finish();
            }
        });
        btnUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(Home.this, UpdateProfile.class));
            }
        });
        btnOrder.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(Home.this, DaftarPesanan.class));
            }
        });
        menuAdapter = new MenuAdapter(this, listmenu);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(this);
        viewmenu.setLayoutManager(mLayoutManager);
        viewmenu.setItemAnimator(new DefaultItemAnimator());
        getDataMenu();
    }
    private void getDataMenu() {
        loading = ProgressDialog.show(mediaCtxt, null, "Harap Tunggu...",true, false);
        mApiInterface.getDaftarMenu().enqueue(new Callback<ResponseMenu>()
        {
            @Override
            public void onResponse(Call<ResponseMenu> call, Response<ResponseMenu> response) {
                if (response.isSuccessful()) {
                    loading.dismiss();
                    final List<DaftarMenuItem> daftarMenuItems = response.body().getDaftarmenu();
                    viewmenu.setAdapter(new MenuAdapter(mediaCtxt, daftarMenuItems));
                    menuAdapter.notifyDataSetChanged();
                    initDataIntent(daftarMenuItems);
                } else {
                    loading.dismiss();
                    Toast.makeText(mediaCtxt, "Gagal mengambil data menu", Toast.LENGTH_SHORT).show();
                }
            }
            @Override
            public void onFailure(Call<ResponseMenu> call, Throwable t) {
                loading.dismiss();
                Toast.makeText(mediaCtxt, "Koneksi internet bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }
    private void initDataIntent(List<DaftarMenuItem> daftarMenuItems) {
        viewmenu.addOnItemTouchListener(
                new RecyclerItemClickListener(mediaCtxt, new RecyclerItemClickListener.OnItemClickListener() {
                            @Override
                            public void onItemClick(View view, int position) {
                                String id = daftarMenuItems.get(position).getId();
                                String menu_makanan = daftarMenuItems.get(position).getMenu_makanan();
                                String harga = daftarMenuItems.get(position).getHarga();
                                Intent detailMenu = new Intent(mediaCtxt, OrderMenu.class);
                                detailMenu.putExtra("KEY_ID_MENU", id);
                                detailMenu.putExtra("KEY_USERNAME", spManager.getSpUsername());
                                detailMenu.putExtra("KEY_MENU_MAKANAN", menu_makanan);
                                detailMenu.putExtra("KEY_HARGA", harga);
                                startActivity(detailMenu);
                            }
                        }));
    }
}