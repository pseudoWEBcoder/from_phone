<?php
require __DIR__ . '/vendor/autoload.php';
$db = new SQLite3(__DIR__.'russian.sqlite3');
$file=realpath ('/storage/emulated/0/Download/russian.dic/russian.dic/russian.dic');
ini_set('memory_limit', '1024M');
///$file=realpath('line.txt'); 
$lines=file_get_contents($file);
$db->query('CREATE TABLE IF NOT EXISTS "russian" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "created" integer NOT NULL,
  "word" text NOT NULL,
  "group" text NULL
);');
echo '<pre>'; 

var_export(compact('db','file','lines'));
echo '</pre>';
?>