<?php
session_start();
/*вспомогательный класс для отрисовки таблицы */

class Table {
	static $tr = [];

	// собирает таблицу
 	public static function render() {
		array_unshift(self::$tr, '<table>');
 		self::$tr[] = '</table>';
 		return implode(PHP_EOL, self::$tr);
 	}

 	//render
 	// добавляет строку в таблице
 	public static function tr($tds, $attrs = '') {
		self::$tr[] = '<tr' . (mb_strlen($attrs) ? ' ' . $attrs :'') . '>';
 		foreach ($tds as $i)
 if (is_array($i))
 			self::td($i[0], $i[1], $i[2]);
 		else
			
 self::td($i);
 		self::$tr[] = '</tr>';
 	}

 	//tr
 	// добавляет заголовок
 	public static function header() {
		$arg = func_get_args();
 		self::$tr[] = '<tr>';
 		foreach ($arg as $i)
 if (is_array($i))
 			self::td($i[0], $i[1], 'h');
 		else
			
 self::td($i, null, 'h');
 		self::$tr[] = '</tr>';
 	}

 	//render
 	// добавляет столбец
 	public static function td($str, $attrs = '', $h = 'd') {
		self::$tr[] = '<t' . $h . ($attrs ? ' ' . $attrs :'') . '>' . $str;
 		self::$tr[] = '</t' . $h . '>';
 	}
}

//class
// функция создает поле ввода 
function input($name, $default = null, $attrs = null) {
	return '<input name="' . $name .
 '" value="' .
 (isset($_REQUEST[$name]) ? $_REQUEST[$name] :$default) .
 '"' . $attrs . '/>';
}

// функция проверяет есть ли такой ключ в массиве если массив не задан ищет в $_REQUEST
function get($key, $arr = null, $default = null) {
	$arr = is_null($arr) ? $_REQUEST :$arr;
 	return (isset($arr[$key]) ? $arr[$key] :$default);
}

// редирект + выход
function away($string) {
	header($string);
 	exit();
}

// рисует элемент select
function select($array, $name) {
	$sel[] = '<select name="' . $name . '">';
 	foreach ($array as $v) {
		$checked = get($name);
 		$checked = $checked == $v ? ' selected="selected"' :'';
 		$sel[] = '<option value="' . $v . '"' . $checked . '>' . $v . '</option>';
 	}
 	$sel[] = '</select>';
 	//var_dump($_REQUEST);
 	return implode(PHP_EOL, $sel);
}
$users = [ [ 'login'=> 'super', 'password'=> 'super'], [ 'login'=> 'super2', 'password'=> 'super2'] ];
 

 if (get('auth',$_SESSION)) {
	header( "Location:http://google.com/" );
 
	exit;
 
}
 $login = get('login');
 
$password =get('password');
 echo var_export($login,1). '<hr>'.__LINE__;
foreach ($users as $user) {
	$indexed[$user['login']]=$user;
 
	if ($user['login'] == $login) {
		if ($user['password'] == $password) {
			$_SESSION['auth']=true;
 
			away( "http://google.com/" );
 		} else {
			$result = "Неправильный пароль";
 
		}
 	}
 }



$resut= "Пользователь не найден";
 error_reporting(0);
 
Table::tr([['login', null,'h'], input('login')]);
Table::tr([['password', null,'h'], input('password')]);
Table::tr([[input('send', 'отправить','type="submit"'),'colspan="2"','d']]);
var_dump($result);
echo  '<form>'.$result.Table::render().'</form>';
?>