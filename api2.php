<?php
require __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
 use GuzzleHttp\HandlerStack;
 use GuzzleHttp\Middleware;
 use GuzzleHttp\MessageFormatter;

 function getApiTest() {
	$stack = HandlerStack::create();
 	$stack->push( Middleware::log( new Logger('Logger'), new MessageFormatter('{req_body} - {res_body}') ) );
 	$client = new \GuzzleHttp\Client( [ 
'cookies' => true,
// 'base_uri' => 'http://apitesting.test/api/', 
'handler' => $stack ] );
	$host = 'https://idaprikol.ru';
	$data = array(
 'p' . 'ass' . 'word' => '49714971Hh',
 'username' => 'eupseu@mail.ru',
);
	$response = $client->request('POST', $host . '/oauth/login', [
//'cookies' => true,
'headers' => [':authority:'=>' idaprikol.ru',
':method:'=>' POST',
':path:'=>' /oauth/login',
//':scheme:'=>' https'
],
'json' => $data
]);
$methods= get_class_methods($client);

	print_r(compact('request','response','stack'));
	echo PHP_EOL.PHP_EOL.'-----------'.PHP_EOL.PHP_EOL;
 	echo (string) $client->get($host . '/api/news?limit=490')->getBody();
 }
getApiTest();
?>