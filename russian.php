<?php

require __DIR__ . '/vendor/autoload.php';

$db = new SQLite3($dbfile = __DIR__ . '/russian-tolk1.sqlite3');
$desktop = 'C:\Users\alal\Downloads\russian.dic (1)\russian.dic';
$desktop = 'C:\Users\alal\Downloads\avidreaders.ru__tolkovyy-slovar-russkogo-yazyka-1.txt\avidreaders.ru__tolkovyy-slovar-russkogo-yazyka-1.txt';
$mobile = '/storage/emulated/0/Download/russian.dic/russian.dic/russian.dic';
$file = realpath(is_file($desktop) ? $desktop : $mobile);
$mobile='/storage/emulated/0/Download/avidreaders.ru__tolkovyy-slovar-russkogo-yazyka-1.txt/avidreaders.ru__tolkovyy-slovar-russkogo-yazyka-1.txt';
ini_set('memory_limit', '1024M');
///$file=realpath('line.txt'); 
$lines = file($file);
$query = $db->query('PRAGMA table_info(russian);');
while ($row = $query->fetchArray()) $info [$row['name']] = $row['type'];
$group = implode('_', [(is_file($desktop) ? 'DESKTOP' : 'MOBILE'), uniqid(), date('d.m.Y H:i')]);
$ok = $db->query('CREATE TABLE IF NOT EXISTS "russian-tolk" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "created" integer NOT NULL,
  "word" text NOT NULL,
  "info" text NOT NULL,
  "explanation" text NOT NULL,
  "group" text NULL
);');
$superok = $ok->finalize();
echo '<pre>';
ORM::configure('sqlite:' . realpath($dbfile));
ORM::configure('logging', true);
ORM::configure('logger', function ($log_string, $query_time) {
    echo '<div><pre>' . $log_string . ' in ' . '</pre>' . $query_time . '</div>';
});
$request = ORM::for_table('russian-tolk')->create();
foreach ($chunks = array_chunk($lines, 400) as $chunk_num => $chunk) {
	var_dump($chunk);
die('denied'.__LINE__);
    foreach ($chunk as $num => $i) {
        if (preg_match('/^([А-Я]+)(.*?)\.(.+)$/', $i, $matches)) {
	
            $request = ORM::for_table('russian-tolk')->create();
            $request->created = time();
            $request->word = $matches[1];
            $request->info = $matches[2];
            $request->explanation = $matches[3];
            $request->group = $group;
            $ok = $request->save();
            echo 'item' . $num . ' at ' . ($cn = count($chunk)) . PHP_EOL;

        } else {
            echo 'item' . $num . ' at ' . ($cn = count($chunk)) . '.. skipt' . PHP_EOL;

        }
    }
    echo 'CHUNK ' . $chunk_num . ' at ' . ($cnn = count($chunks)) . '  .. ' . (count($matches) ? 'skit' : ($ok ? 'OK' : 'FAIL')) . PHP_EOL;
}
echo PHP_EOL . PHP_EOL . 'ok' . PHP_EOL;
//foreach (array_chunk($lines, 400) as $chunk) {
//    { $sql = [];
//        foreach ($chunk as $index => $word) {
//            foreach ($info as $i => $v) {
//         /*       $sql['fields'][$i] = $i;
//                $sql['values'][$i] = $word;*/
//            }
//            $sql = 'INSERT INTO russian('.implode(',', $sql['fields']).') VALUES (' . implode(',', $sql['values']) . ');';
//        }
//
//
//    }
//}
//var_export(compact('db', 'file', 'lines'));
echo '</pre>';
?>