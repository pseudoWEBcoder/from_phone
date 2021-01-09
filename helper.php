<?php
//$c = file('C:\Users\alal\Desktop\curl --help.txt');
$c = file('help.txt');
$tree = array(
    array('name' => 'Уровень 1', 'id' => 1, 'pid' => 0),
    array('name' => 'Уровень 1.1', 'id' => 2, 'pid' => 1),
    array('name' => 'Уровень 1.2', 'id' => 3, 'pid' => 1),
    array('name' => 'Уровень 1.3', 'id' => 4, 'pid' => 1),
    array('name' => 'Уровень 2', 'id' => 5, 'pid' => 0),
    array('name' => 'Уровень 2.1', 'id' => 6, 'pid' => 5),
    array('name' => 'Уровень 2.2', 'id' => 7, 'pid' => 5),
    array('name' => 'Уровень 3', 'id' => 8, 'pid' => 0),
    array('name' => 'Уровень 3.1', 'id' => 9, 'pid' => 8),
    array('name' => 'Уровень 3.1.1', 'id' => 10, 'pid' => 9),
    array('name' => 'Уровень 3.1.2', 'id' => 11, 'pid' => 9),
);

echo get_tree($tree, 0);

/**
 * Возвращает html код дерева
 * @param array $tree - массив в формате array(array('name' => .., 'id' => .., 'pid' => ..), array(..))
 * @param integer $pid - id родителя
 */
function get_tree($tree, $pid)
{
    $html = '';

    foreach ($tree as $row) {
        if ($row['pid'] == $pid) {
            $html .= '<li>' . "\n";
            $html .= ' ' . $row['name'] . "\n";
            $html .= ' ' . get_tree($tree, $row['id']);
            $html .= '</li>' . "\n";
        }
    }

    return $html ? '<ul>' . $html . '</ul>' . "\n" : '';
}

echo '<hr>';
$pid = 0;
$ul[] = array('name' => 'Уровень 1', 'id' => 1, 'pid' => 0);
foreach ($c as $index => $item) {
    if (preg_match('/(^\s*)(-\w+),? (.*?)\s{2,}(.+)$/', $item, $matches)) {
        //$ul[] = $matches;
        $li = implode(' ', [
            '<strong>' . trims($matches[2]) . '</strong>',
            '<span class="text-muted">' . trims($matches[3]) . '</span>',
            '<span>' . trims($matches[4]) . '</span>'
        ]);
    } else {
        $li = $item;
    }
    $ul[] = '<li>' . $li . '<li>';
    // $ul [] = ['name' => htmlspecialchars(trim($item)), 'id' => $index, 'pid' => $pid];
}
$parsed = '<ul>' . implode(PHP_EOL, $ul) . '</ul>';
$raw = '<pre>' . print_r($c, 1) . '</pre>';
$body = '<div class="container"><div class="row"><div class="col">' . $parsed . '</div><!--/col-->'
    . '<div class="col">' . $raw . '</div><!--/col-->
</div><!--/row-->
</div><!--/container-->';
$title = ' справка cmd  в  цвете';
require 'bootstrap.tpl.php';
function trims($var)
{
    return htmlspecialchars(trim($var ? $var : ''));
}

?>