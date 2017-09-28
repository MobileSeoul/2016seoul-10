package kr.webox.app01;

import android.app.Activity;
import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.net.http.SslError;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.JsPromptResult;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class MainActivity extends Activity {
    String TAG = "MainActivity";
    private WebView webView;

    public static final String INTENT_PROTOCOL_START = "intent:";
    public static final String INTENT_PROTOCOL_INTENT = "#Intent;";
    public static final String INTENT_PROTOCOL_END = ";end;";
    public static final String GOOGLE_PLAY_STORE_PREFIX = "market://details?id=";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        webView = (WebView) this.findViewById(R.id.webView);

        webView.loadUrl("http://www.webox.kr/");


        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setLoadWithOverviewMode(true);
        webView.getSettings().setUseWideViewPort(true);
        webView.getSettings().setJavaScriptCanOpenWindowsAutomatically(true); // javascript가 window.open()을 사용할 수 있도록 설정
        webView.getSettings().setPluginState(WebSettings.PluginState.ON); // 플러그인을 사용할 수 있도록 설정
        webView.getSettings().setSupportMultipleWindows(true); // 여러개의 윈도우를 사용할 수 있도록 설정


        webView.setWebViewClient(new WebViewClient() {
            @Override
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                Log.i(TAG, "url : "+url);
                if(url.startsWith("mailto:")
                        || url.startsWith("geo:")
                        || url.startsWith("tel:")) {
                    Intent call_phone = new Intent(Intent.ACTION_VIEW , Uri.parse(url)) ;
                    startActivity(call_phone) ;
                    return true ;
                }else if (url.startsWith(INTENT_PROTOCOL_START)) {
                    final int customUrlStartIndex = INTENT_PROTOCOL_START.length();
                    final int customUrlEndIndex = url.indexOf(INTENT_PROTOCOL_INTENT);
                    if (customUrlEndIndex < 0) {
                        return false;
                    } else {
                        final String customUrl = url.substring(customUrlStartIndex, customUrlEndIndex);
                        try {
                            startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse(customUrl)));
                        } catch (ActivityNotFoundException e) {
                            final int packageStartIndex = customUrlEndIndex + INTENT_PROTOCOL_INTENT.length();
                            final int packageEndIndex = url.indexOf(INTENT_PROTOCOL_END);

                            final String packageName = url.substring(packageStartIndex, packageEndIndex < 0 ? url.length() : packageEndIndex);
                            startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse(GOOGLE_PLAY_STORE_PREFIX + packageName)));
                        }
                        return true;
                    }
                }else{
                    view.loadUrl(url);
                }
                return true;
            }

        });

        webView.setWebChromeClient(new WebChromeClient(){
            @Override
            public boolean onJsAlert(WebView view, String url,
                                     String message, JsResult result) {
                return super.onJsAlert(view, url, message, result);
            }

            @Override
            public boolean onJsBeforeUnload(WebView view, String url,
                                            String message, JsResult result) {
                return super.onJsBeforeUnload(view, url, message, result);
            }

            @Override
            public boolean onJsConfirm(WebView view, String url,
                                       String message, JsResult result) {
                return super.onJsConfirm(view, url, message, result);
            }

            @Override
            public boolean onJsPrompt(WebView view, String url,
                                      String message, String defaultValue,
                                      JsPromptResult result) {
                return super.onJsPrompt(view, url, message, defaultValue, result);
            }

            @Override
            public boolean onJsTimeout() {
                // TODO Auto-generated method stub
                return super.onJsTimeout();
            }

        });



    }

    Handler mHandler = new Handler(){
        public void handleMessage(Message msg){
            isFinish = false;
        }
    };
    boolean isFinish;
    @Override
    public void onBackPressed() {
//		super.onBackPressed();
        if(isFinish == false){
            isFinish = true;
            Toast.makeText(this, "뒤로 버튼을 한번 더 누르면 종료됩니다.", Toast.LENGTH_SHORT).show();
            mHandler.sendEmptyMessageDelayed(0, 3000);
        }else{
            super.onBackPressed();
        }


    }
}
