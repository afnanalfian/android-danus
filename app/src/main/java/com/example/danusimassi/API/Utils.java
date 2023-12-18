package com.example.danusimassi.API;

public class Utils {
    public static final String BASE_URL =
            "http://127.0.0.1:8000/";
    // Mendeklarasikan Interface BaseApiService
    public static Interface getAPIService(){
        return Client.getClient(BASE_URL).create(Interface.class);
    }
}
