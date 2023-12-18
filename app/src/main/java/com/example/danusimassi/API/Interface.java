package com.example.danusimassi.API;

import com.example.danusimassi.ResponseMenu;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;

public interface Interface {
    @FormUrlEncoded
    @POST("android/login")
    Call<ResponseBody> loginRequest(@Field("email") String email,
                                    @Field("password") String password);
    @FormUrlEncoded
    @POST("android/register")
    Call<ResponseBody> registerRequest(@Field("Username") String username,
                                       @Field("Email") String email, @Field("Nama") String nama, @Field("Alamat")
                                       String alamat, @Field("Password") String password,
                                       @Field("Konfirmasi_Password") String konfpassword);
    @FormUrlEncoded
    @POST("android/update")
    Call<ResponseBody> updateRequest(@Field("Username") String username,
                                     @Field("Email") String email, @Field("Nama") String nama, @Field("Alamat")
                                     String alamat, @Field("Password") String password,
                                     @Field("Konfirmasi_Password") String konfpassword);
    @GET("android/listmenu")
    Call<ResponseMenu> getDaftarMenu();
    @FormUrlEncoded
    @POST("android/addfood")
    Call<ResponseBody> addPesanMenu(@Field("username") String username,
                                    @Field("menu_makanan") String menu_makanan, @Field("harga") String harga,
                                    @Field("Jumlah") String jumlah);
    @GET("android/listorder")
    Call<ResponseMenu> getDaftarPesan();
}
