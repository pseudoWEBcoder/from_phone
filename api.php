<?php
// Create a stream
 $opts = array(  
'http'=>array( 
'method'=>"GET", 
'header'=>"Accept-language: en\r\n" . 
"Cookie: SID=s%3AwGXGSUKqT82Ht6gsaeI7rVspm8LQkt2D.fnauFNMSzvsLP8hD5q9AxWFydfFzCLq%2FUwitnj0ZNqg\r\n"
 ) );
 $context = stream_context_create($opts);
 // Open the file using the HTTP headers set above 
$file = file_get_contents('https://idaprikol.ru/api/news?limit=490', false, $context);
echo $file;
?>