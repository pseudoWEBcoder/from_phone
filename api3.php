<?php
require __DIR__ . '/vendor/autoload.php';
ORM::configure('sqlite:' . realpath('./request.db'));
ORM::configure('logger', function ($log_string, $query_time) {
    echo '<div><pre>' . $log_string . ' in ' . '</pre>' . $query_time . '</div>';
});

function cURLcheckBasicFunctions()
{
    if (
        !function_exists("curl_init") &&
        !function_exists("curl_setopt") &&
        !function_exists("curl_exec") &&
        !function_exists("curl_close")
    ) {
        return false;
    } else {
        return true;
    }
}

/*
 * Returns string status information.
 * Can be changed to int or bool return types.
 */
function cURLdownload($url, $file, array $data = [])
{
    $request = ORM::for_table('requests3')->create();
    $split = PHP_EOL . '##' . PHP_EOL;
    if (!cURLcheckBasicFunctions()) {
        return "UNAVAILABLE: cURL Basic Functions";
    }
    $ch = curl_init();
    if ($ch) {
        $fp = fopen($file, "a+");
        $COOKIEFILE = realpath('api_cookiefile.txt');
        $COOKIEJAR = $COOKIEFILE;
        if ($fp) {
            fwrite($fp, PHP_EOL . PHP_EOL . $url . PHP_EOL . PHP_EOL . PHP_EOL);

            $opts = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => true,
                CURLOPT_COOKIEFILE => $COOKIEFILE,
                CURLOPT_COOKIEJAR => $COOKIEFILE,
                CURLINFO_HEADER_OUT => true
            ];
            foreach ($opts as $opt => $val) {
                if (!curl_setopt($ch, $opt, $val)) {
                    return "FAIL: curl_setopt(" . $opt . ")";
                }
            }
            if (
            $data) {
                if (
                !curl_setopt(
                    $ch, CURLOPT_POSTFIELDS,
                    $fields = json_encode($data)
                )
                ) {
                    return "FAIL: CURLOPT_POSTFIELDS[]" . $fields . ']';
                }
            }
            if (!($response = curl_exec($ch))) {

                return "FAIL: curl_exec()";
            }
            $group_id = ORM::getDb()->query('SELECT MAX(group_id) as max FROM requests')->fetchAll()[0]['max'];
            $errno = curl_errno($ch);
            $error = curl_error($ch);
            $curl_info = curl_getinfo($ch);
            $header_size = $curl_info['header_size'];
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $request_headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
            fwrite($fp, 'запрос:' . PHP_EOL . $request_headers . ($fields ? 'fields:' . var_export($fields, 1) : '') . $split . 'ответ:' . PHP_EOL . $response);
            $info = curl_getinfo($ch);
            curl_close($ch);
            fclose($fp);
            $info['file'] = __FILE__;
            $method = preg_match('/^(\w+)/', $request_headers, $matches);
            $request->url = $url;
            $request->error = implode(PHP_EOL, [$errno, $error]);
            $request->method = $matches[1];
            $request->request_headers = var_export($request_headers, 1);
            $request->request_body = var_export($fields, 1);
            $request->response_status = $info['http_code'];
            $request->response_headers = $header;
            $request->response_body = $body;
            $request->group_id = $group_id;
            $request->data = json_encode($info);
            $request->save();
            return "SUCCESS: $file [$url]";
        } else {
            return "FAIL: fopen()";
        }
    } else {
        return "FAIL: curl_init()";
    }
}

// Download from 'example.com' to 'example.txt'
$host = 'https://idaprikol.ru';
$data = array(
    'p' . 'ass' . 'word' => '49714971Hh',
    'username' => 'eupseu@mail.ru'
);
$url['login'] = '/oauth/login';
$url['api'] = '/api/news?limit=490';
echo '<ul>';
date_default_timezone_set("Europe/Samara");
file_put_contents(
    "example.txt",
    PHP_EOL . PHP_EOL . date('d.m.Y h:i:s') . PHP_EOL . PHP_EOL
);
echo '<li>' .
    cURLdownload($host . $url['login'], "example.txt", $data) .
    '</li>';
echo '<li>' . cURLdownload($host . $url['api'], "example.txt") . '</li>';
die('</ul><hr/>');
?>


<hr/>');
?>
