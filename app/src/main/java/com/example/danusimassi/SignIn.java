package com.example.danusimassi;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
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

public class SignIn extends AppCompatActivity {

    private Button btnLogin;
    private TextInputEditText txtEmail, txtPassword;
    private TextView txtsignup;
    private Context mediaCtxt;
    private Interface mApiInterface;
    private ProgressDialog loading;
    private SharedPrefManager spManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);
        mediaCtxt = this;
        mApiInterface = Utils.getAPIService();
        spManager = new SharedPrefManager(this);
        btnLogin = (Button) findViewById(R.id.buttonin);
        txtEmail = (TextInputEditText) findViewById(R.id.emailin);
        txtPassword = (TextInputEditText) findViewById(R.id.passwordin);
        txtsignup = (TextView) findViewById(R.id.linkin);
        if (spManager.getSPSudahLogin()){
            startActivity(new Intent(SignIn.this, Home.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
            finish();
        }
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loading = ProgressDialog.show(mediaCtxt, null, "Mohon tunggu sebentar...", true, false);
                mApiInterface.loginRequest(txtEmail.getText().toString(),
                        txtPassword.getText().toString()).enqueue(new Callback<ResponseBody>() {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()){
                            loading.dismiss();
                            try {
                                JSONObject jsonRESULTS = new
                                        JSONObject(response.body().string());
                                if
                                (jsonRESULTS.getString("error").equals("false")){
                                    Toast.makeText(mediaCtxt, "Berhasil login", Toast.LENGTH_SHORT).show();
                                            String json_username = jsonRESULTS.getJSONObject("user").getString("username");

                                    spManager.saveSPString(SharedPrefManager.SP_USERNAME, json_username);
                                    String json_email = jsonRESULTS.getJSONObject("user").getString("email");

                                    spManager.saveSPString(SharedPrefManager.SP_EMAIL, json_email);
                                    String json_nama =
                                            jsonRESULTS.getJSONObject("user").getString("nama");

                                    spManager.saveSPString(SharedPrefManager.SP_NAMA, json_nama);
                                    String json_alamat =
                                            jsonRESULTS.getJSONObject("user").getString("alamat");

                                    spManager.saveSPString(SharedPrefManager.SP_ALAMAT, json_alamat);

                                    spManager.saveSPBoolean(SharedPrefManager.SP_SUDAH_LOGIN, true);
                                    startActivity(new Intent(mediaCtxt, Home.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                                    finish();
                                } else {
                                    String error_message =
                                            jsonRESULTS.getString("error_msg");
                                    Toast.makeText(mediaCtxt, error_message, Toast.LENGTH_SHORT).show();
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            } catch (IOException e) {
                                e.printStackTrace();
                            }
                        } else {
                            loading.dismiss();
                            Toast.makeText(mediaCtxt, "Gagal Login",
                                    Toast.LENGTH_SHORT).show();
                        }
                    }
                    @Override
                    public void onFailure(Call<ResponseBody> call, Throwable t) {
                        Log.e("debug", "onFailure: ERROR > " + t.toString());
                        loading.dismiss();
                    }
                });
            }
        });
    }
    public void txtInClick(View view) {
        Intent RegisIntent = new Intent(this, SignUp.class);
        startActivity(RegisIntent);
    }
}