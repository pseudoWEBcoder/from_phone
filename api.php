<?php


require __DIR__ . '/vendor/autoload.php';

use Curl\Curl;

$host = 'https://idaprikol.ru';
$curl = new Curl();
$curl->setCookieFile($f = realpath('./api_cookiefile.txt'));
$data = array(
    'p' . 'ass' . 'word' => '49714971Hh',
    'username' => 'eupseu@mail.ru',
);
//$curl->setHeader('Content-Type', 'application/json');
$headers = [
':authority:'=>' idaprikol.ru',
':method:'=>' POST',
':path:'=>' /oauth/login',
':scheme:'=>' https',
'accept'=>' application/json, text/plain, accept-encoding: gzip, deflate, br',
'accept-language'=>' ru',
//'content-length'=>' ',
'content-type'=>' application/json;charset=UTF-8',
'cookie'=> 'CID=8b6b278d64021980400d8d2d115665f30b90ca0704e495f9fd95abc2215f1896; LAST_VISIT_AT=1607896882957',
'origin'=>' https://idaprikol.ru',
'referer'=>' https://idaprikol.ru/',
'sec-fetch-dest'=>' empty',
'sec-fetch-mode'=>' cors',
'sec-fetch-site'=>' same-origin',
"user-agent"=>" Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36 OPR/71.0.3770.284",
"x-requested-with"=>" XMLHttpRequest"];

foreach ($headers as $i => $v) {
   
    $curl->setHeader($v[0], $V[1]);
}
$curl->post($host . '/oauth/login', $data);
$response = $curl->response;
$curl->get($host . '/api/news?limit=490');
$response1 = $curl->response;
die(var_export(['$curl->getInfo'=>$curl->getInfo(), '$response1'=>$response1,'Curl->getRawResponseHeaders()'=>$curl->getRawResponseHeaders()],1));
/*// Create a stream
$opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "Accept-language: en\r\n" .
            "Cookie: SID=4Qd81VfwXqIAvAkKUsmunLqxqMRmWeZChCy0ZYwmohgSg9Ht6Buab5BONenNuS0HgOTG0w.\r\n"
    ));
$context = stream_context_create($opts);
// Open the file using the HTTP headers set above
$file = file_get_contents('https://idaprikol.ru/api/news?limit=490', false, $context);*/
echo $file;
?>


aprikol.ru/api/news?limit=490', false, $context);
echo $file;
?>


ho $file;
?>


