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

public class SignUp extends AppCompatActivity {

    private Button btnSignUp;
    private TextInputEditText txtNama, txtUserName, txtEmail, txtAlamat, txtPassword, txtKonfPassword;
    private ProgressDialog loading;
    private Context mediaCtxt;
    private Interface mApiInterface;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        mediaCtxt = this;
        mApiInterface = Utils.getAPIService();
        btnSignUp = (Button) findViewById(R.id.buttonup);
        txtNama = (TextInputEditText) findViewById(R.id.nameup);
        txtUserName = (TextInputEditText) findViewById(R.id.usernameup);
        txtEmail = (TextInputEditText) findViewById(R.id.emailup);
        txtAlamat = (TextInputEditText) findViewById(R.id.alamatup);
        txtPassword = (TextInputEditText) findViewById(R.id.passwordup);
        txtKonfPassword = (TextInputEditText) findViewById(R.id.confpasswordup);
        btnSignUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loading = ProgressDialog.show(mediaCtxt, null, "Harap Tunggu...", true, false);

                mApiInterface.registerRequest(txtUserName.getText().toString(),
                        txtEmail.getText().toString(), txtNama.getText().toString(),
                        txtAlamat.getText().toString(), txtPassword.getText().toString(),
                        txtKonfPassword.getText().toString()).enqueue(new Callback<ResponseBody>()
                {
                    @Override
                    public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                        if (response.isSuccessful()){
                            Log.i("debug", "onResponse: Berhasil");
                            loading.dismiss();
                            try {
                                JSONObject jsonRESULTS = new
                                        JSONObject(response.body().string());
                                if
                                (jsonRESULTS.getString("error").equals("false")){
                                    Toast.makeText(mediaCtxt, "Berhasil registrasi", Toast.LENGTH_SHORT).show();
                                            startActivity(new Intent(mediaCtxt,
                                                    SignIn.class).addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP |
                                                    Intent.FLAG_ACTIVITY_NEW_TASK));
                                    finish();
                                } else {
                                    String error_message =
                                            jsonRESULTS.getString("error_msg");
                                    Toast.makeText(mediaCtxt,
                                            error_message, Toast.LENGTH_SHORT).show();
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
                    public void onFailure(Call<ResponseBody> call,Throwable t) {
                        Log.e("debug", "onFailure: ERROR > " +
                                t.getMessage());
                        Toast.makeText(mediaCtxt, "Koneksi internet bermasalah", Toast.LENGTH_SHORT).show();
                    }
                });
            }
        });
    }
    public void txtUpClick(View view) {
        Intent intent = new Intent(this, SignIn.class);
        startActivity(intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP |
                Intent.FLAG_ACTIVITY_NEW_TASK));
    }
}