<?php


require __DIR__ . '/vendor/autoload.php';

use Curl\Curl;

//https://idiormru.readthedocs.io/ru/latest/querying.html русская дока
ORM::configure('sqlite:' . realpath('./request.db'));
ORM::configure('logger', function ($log_string, $query_time) {
    echo '<div><pre>' . $log_string . ' in ' . '</pre>' . $query_time . '</div>';
});
$request = ORM::for_table('requests')->create();
$group_id =ORM::getDb()->query('SELECT MAX(group_id) as max FROM requests')->fetchAll()[0]['max'];
$request->created_time = time();
$request->url = '';
$request->method = '';
$request->request_headers = '';
$request->request_body = '';
$request->response_status = -1;
$request->response_headers = '';
$request->response_body = '';

$saved = $request->save();

$host = 'https://idaprikol.ru';
$curl = new Curl();
$curl->setCookieFile($f = realpath('./api_cookiefile.txt'));
$data = array(
    'p' . 'ass' . 'word' => '49714971Hh',
    'username' => 'eupseu@mail.ru',
);
//$curl->setHeader('Content-Type', 'application/json');
<<<<<<< HEAD
$headers = [
    ':authority:' => ' idaprikol.ru',
    ':method:' => ' POST',
    ':path:' => ' /oauth/login',
    ':scheme:' => ' https',
    'accept' => ' application/json, text/plain, accept-encoding: gzip, deflate, br',
    'accept-language' => ' ru',
//'content-length'=>' ',
    'content-type' => ' application/json;charset=UTF-8',
    'cookie' => 'CID=8b6b278d64021980400d8d2d115665f30b90ca0704e495f9fd95abc2215f1896; LAST_VISIT_AT=1607896882957',
    'origin' => ' https://idaprikol.ru',
    'referer' => ' https://idaprikol.ru/',
    'sec-fetch-dest' => ' empty',
    'sec-fetch-mode' => ' cors',
    'sec-fetch-site' => ' same-origin',
    "user-agent" => " Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36 OPR/71.0.3770.284",
    "x-requested-with" => " XMLHttpRequest"];

foreach ($headers as $i => $v) {
<<<<<<< HEAD
   
    $curl->setHeader($v[0], $V[1]);
=======
$headers = ':authority: idaprikol.ru
:method: POST
:path: /oauth/login
:scheme: https
accept: application/json, text/plain, */*
accept-encoding: gzip, deflate, br
accept-language: ru
content-length: 53
content-type: application/json;charset=UTF-8
cookie: CID=8b6b278d64021980400d8d2d115665f30b90ca0704e495f9fd95abc2215f1896; LAST_VISIT_AT=1607896882957
origin: https://idaprikol.ru
referer: https://idaprikol.ru/
sec-fetch-dest: empty
sec-fetch-mode: cors
sec-fetch-site: same-origin
user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36 OPR/71.0.3770.284
x-requested-with: XMLHttpRequest';

$explode = explode("\n", $headers);
foreach ($explode as $i => $v) {
    $V = explode(':', $v);
    if (count($V) > 2) {
        $curl->setHeader(':'._trim($V[1].':'), _trim($V[2]));
    } else {
        $curl->setHeader(_trim($V[0]), _trim($V[1]));
    }
>>>>>>> 5285938dde0a6657269bf5c32b4607ad7ea41a42
=======

    $curl->setHeader($i, $v);
>>>>>>> b0667df74986f96551921e90f536fe2313765e61
}
$curl->post($host . '/oauth/login', $data);
$response = $curl->response;
loggit($response, $request, $curl,  $group_id+1);

$curl->get($host . '/api/news?limit=490');
$response1 = $curl->response;
loggit($response1, $request, $curl,  $group_id+1);
die(var_export(['$curl->getInfo' => $curl->getInfo(), '$response1' => $response1, 'Curl->getRawResponseHeaders()' => $curl->getRawResponseHeaders()], 1));

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
function loggit($response, ORM $request, Curl $curl, $group_id)
{
    $info = $curl->getInfo();
    $info['file'] = __FILE__;
    $request->url = $curl->getUrl();
    $request->error = implode (PHP_EOL, [$curl->getCurlErrorMessage(), $curl->getHttpErrorMessage()]);
    $request->method = $curl->curl;
    $request->request_headers = var_export($curl->getRequestHeaders(), 1);
    $request->request_body = $curl->getRawResponse();
    $request->response_status = $curl->getHttpStatusCode();
    $request->response_headers = $curl->getRawResponseHeaders();
    $request->response_body = $response;
    $request->group_id = $group_id;
    $request->data = json_encode($info);
    $request->save();

}

?>


aprikol.ru/api/news?limit=490', false, $context);
echo $file;
<<<<<<< HEAD
?>


ho $file;
?>


=======
function _trim($str ,$charlist = "\r\n\s\t " )
{
    return mb_strlen($str) ? trim($str,  $charlist) : $str;
}
?>
>>>>>>> 5285938dde0a6657269bf5c32b4607ad7ea41a42
