package kr.webox.app01;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;

/**
 * Created by jwkim on 2016-10-25.
 */
public class Intro_Activity extends Activity{
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.intro_layout);

        new Handler().postDelayed(new Runnable(){
            public void run(){
                Intent t = new Intent(Intro_Activity.this, MainActivity.class);
                finish();
                startActivity(t);
            }
        }, 3000);

    }
}
