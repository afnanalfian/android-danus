package com.example.danusimassi;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.example.danusimassi.API.Interface;
import com.example.danusimassi.API.Utils;
import com.google.android.material.textfield.TextInputEditText;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.IOException;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
public class OrderMenu extends AppCompatActivity {
    private TextInputEditText txtmenu_makanan, txtharga, txtjumlah;
    private Button btnAddMenu;
    private String Id, Usermenu, Menu_makanan, Harga;
    private ProgressDialog loading;
    private Context mediaCtxt;
    private Interface mApiInterface;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order_menu);
        txtmenu_makanan = (TextInputEditText) findViewById(R.id.foodset);
        txtharga = (TextInputEditText) findViewById(R.id.hargaset);
        txtjumlah = (TextInputEditText) findViewById(R.id.jumlahset);
        btnAddMenu = (Button) findViewById(R.id.menuset);
        mediaCtxt = this;
        mApiInterface = Utils.getAPIService();
        Intent intent = getIntent();
        Id = intent.getStringExtra("KEY_ID_MENU");
        Usermenu = intent.getStringExtra("KEY_USERNAME");
        Menu_makanan = intent.getStringExtra("KEY_MENU_MAKANAN");
        Harga = intent.getStringExtra("KEY_HARGA");
        txtmenu_makanan.setText(Menu_makanan);
        txtharga.setText(Harga);
        btnAddMenu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loading = ProgressDialog.show(mediaCtxt, null, "Harap Tunggu...", true, false);
                mApiInterface.addPesanMenu(Usermenu,
                        txtmenu_makanan.getText().toString(), txtharga.getText().toString(),
                        txtjumlah.getText().toString()).enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()) {
                            Log.i("debug", "onResponse: Berhasil");
                            loading.dismiss();
                            try {
                                JSONObject jsonRESULTS = new JSONObject(response.body().string());
                                if
                                (jsonRESULTS.getString("error").equals("false")) {
                                    Toast.makeText(mediaCtxt, "Menu berhasil dipesan", Toast.LENGTH_SHORT).show();
                                    startActivity(new Intent(mediaCtxt,
                                            Home.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP |
                                            Intent.FLAG_ACTIVITY_NEW_TASK));
                                    finish();
                                } else {
                                    String error_message = jsonRESULTS.getString("error_msg");
                                    Toast.makeText(mediaCtxt, error_message, Toast.LENGTH_SHORT).show();
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            } catch (IOException e) {
                                e.printStackTrace();
                            }
                        } else {
                            Log.i("debug", "onResponse: Gagal");
                            loading.dismiss();
                        }
                    }

                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {
                        Log.e("debug", "onFailure: ERROR > " + t.getMessage());
                        Toast.makeText(mediaCtxt, "Koneksi internet bermasalah", Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });
    }
}