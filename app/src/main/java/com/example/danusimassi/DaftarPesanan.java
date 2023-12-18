package com.example.danusimassi;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
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
public class DaftarPesanan extends AppCompatActivity {
    private Button btnkembali;
    private RecyclerView vieworder;
    private ProgressDialog loading;
    private Context mediaCtxt;
    private List<DaftarOrderItem> listorder = new ArrayList<>();
    private OrderAdapter orderAdapter;
    private Interface mApiInterface;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftar_pesanan);
        mApiInterface = Utils.getAPIService();
        mediaCtxt = this;
        btnkembali = (Button) findViewById(R.id.backhome);
        vieworder = (RecyclerView) findViewById(R.id.menu);
        btnkembali.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(DaftarPesanan.this, Home.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                finish();
            }
        });
        orderAdapter = new OrderAdapter(this, listorder);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(this);
        vieworder.setLayoutManager(mLayoutManager);
        vieworder.setItemAnimator(new DefaultItemAnimator());
        loading = ProgressDialog.show(mediaCtxt, null, "Harap Tunggu...", true, false);
        mApiInterface.getDaftarPesan().enqueue(new Callback<ResponseMenu>()
        {
            @Override
            public void onResponse(Call<ResponseMenu> call, Response<ResponseMenu> response) {
                if (response.isSuccessful()) {
                    loading.dismiss();
                    final List<DaftarOrderItem> daftarOrderItems = response.body().getDaftarpesanan();
                    vieworder.setAdapter(new OrderAdapter(mediaCtxt, daftarOrderItems));
                    orderAdapter.notifyDataSetChanged();
                } else {
                    loading.dismiss();
                    Toast.makeText(mediaCtxt, "Gagal mengambil data pesanan", Toast.LENGTH_SHORT).show();
                }
            }
            @Override
            public void onFailure(Call<ResponseMenu> call, Throwable t) {
                loading.dismiss();
                Toast.makeText(mediaCtxt, "Koneksi internet bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }
}