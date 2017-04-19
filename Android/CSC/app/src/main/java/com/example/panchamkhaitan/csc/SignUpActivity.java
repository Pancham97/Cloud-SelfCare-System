package com.example.panchamkhaitan.csc;

import android.content.Context;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.io.BufferedWriter;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class SignUpActivity extends AppCompatActivity {

    EditText e_firstName, e_lastName, e_email, e_password, e_repassword, e_phoneNumber;
    String firstName, lastName, email, password, repassword, phoneNumber;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        e_firstName = (EditText) findViewById(R.id.firstName);
        e_lastName = (EditText) findViewById(R.id.lastName);
        e_email = (EditText) findViewById(R.id.email);
        e_password = (EditText) findViewById(R.id.password);
        e_repassword = (EditText) findViewById(R.id.password);
        e_phoneNumber = (EditText) findViewById(R.id.phoneNumber);

    }

    public void registerStudent(View view) {
        firstName = e_firstName.getText().toString();
        lastName = e_lastName.getText().toString();
        email = e_email.getText().toString();
        password = e_password.getText().toString();
        repassword = e_repassword.getText().toString();
        phoneNumber = e_phoneNumber.getText().toString();

        String method = "register";
        BackgroundTask backgroundTask = new BackgroundTask(this);
        backgroundTask.execute(method, firstName, lastName, email, password, repassword, phoneNumber);
        finish();
    }


    public class BackgroundTask extends AsyncTask<String, Void, String> {
        Context context;

        BackgroundTask(Context context) {
            this.context = context;
        }

        @Override
        protected String doInBackground(String... params) {
            String reg_url = "https://svfitnessclub.000webhostapp.com/selfcare/signup.php";
            String method = params[0];

            if (method.equals("register")) {
                String firstName = params[1];
                String lastName = params[2];
                String email = params[3];
                String password = params[4];
                String repassword = params[5];
                String phone = params[6];

                try {
                    URL url = new URL(reg_url);
                    HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream os = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));

                    String data = URLEncoder.encode("firstName", "UTF-8") + "=" + URLEncoder.encode(firstName, "UTF-8") + "&" +
                            URLEncoder.encode("lastName", "UTF-8") + "=" + URLEncoder.encode(lastName, "UTF-8") + "&" +
                            URLEncoder.encode("email", "UTF-8") + "=" + URLEncoder.encode(email, "UTF-8") + "&" +
                            URLEncoder.encode("password", "UTF-8") + "=" + URLEncoder.encode(password, "UTF-8") + "&" +
                            URLEncoder.encode("repassword", "UTF-8") + "=" + URLEncoder.encode(repassword, "UTF-8") + "&" +
                            URLEncoder.encode("phone", "UTF-8") + "=" + URLEncoder.encode(phone, "UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    os.close();

                    InputStream is = httpURLConnection.getInputStream();
                    is.close();
                    return "Registered successfully!";
                } catch (Exception e) {
                    return new String("Exception: " + e.getMessage());
                }
            }
            return null;
        }

        @Override
        protected void onPostExecute(String result) {
            Toast.makeText(context, result, Toast.LENGTH_SHORT).show();
            super.onPostExecute(result);
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

    }
}