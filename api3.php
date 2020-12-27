<?php

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
<<<<<<< HEAD
$headers = [
':authority:'=>' idaprikol.ru',
':method:'=>' POST',
':path:'=>' /oauth/login',
':scheme:'=>' https',
'accept'=>' application/json, text/plain, accept-encoding: gzip, deflate, br',
'accept-language'=>' ru',
'content-length'=>mb_strlen($fields),
'content-type'=>' application/json;charset=UTF-8'];
if(!curl_setopt($ch,CURLOPT_HTTPHEADER,$headers))
	    return "FAIL: CURLOPT_HTTPHEADER";
            
if(!curl_setopt($ch,CURLOPT_HEADER,true))
	    return "FAIL: CURLOPT_HEADER";
=======
                $headers = [
                    ':authority:' => ' idaprikol.ru',
                    ':method:' => ' POST',
                    ':path:' => ' /oauth/login',
                    ':scheme:' => ' https',
                    'accept' => ' application/json, text/plain, accept-encoding: gzip, deflate, br',
                    'accept-language' => ' ru',
                    'content-length' => mb_strlen($fields),
                    'content-type' => ' application/json;charset=UTF-8'];
                if (!curl_setopt($ch, CURLOPT_HTTPHEADER, $headers))
                    return "FAIL: CURLOPT_HTTPHEADER";

                if (!curl_setopt($ch, CURLOPT_HEADER, $headers))
                    return "FAIL: CURLOPT_HEADER";
>>>>>>> b0667df74986f96551921e90f536fe2313765e61
            }
            if (!($response = curl_exec($ch))) {
                $errno =  curl_errno($ch);
                $error =  curl_error($ch);
                return "FAIL: curl_exec()";
            }
            $curl_info = curl_getinfo($ch);
            $header_size = $curl_info['header_size'];
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $request_headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
            fwrite($fp, 'запрос:' . PHP_EOL . $request_headers . ($fields ? 'fields:' . var_export($fields, 1) : '') . $split . 'ответ:' . PHP_EOL . $response);
            curl_close($ch);
            fclose($fp);

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
$data = [
<<<<<<< HEAD
    'p' . 'ass' . 'word' => '49714971Hh',
    //'username' => 'eupseu@mail.ru',
'email'=> 'eupseu@mail.ru'
=======
    'username' => 'eupseu@mail.ru',
    'p' . 'ass' . 'word' => '49714971Hh'
>>>>>>> b0667df74986f96551921e90f536fe2313765e61
];
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
