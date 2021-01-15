<?
function phone($phone = '', $convert = true, $trim = true)
{
    global $phoneCodes; // только для примера! При реализации избавиться от глобальной переменной.
    if (empty($phone)) {
        return '';
    }
    // очистка от лишнего мусора с сохранением информации о «плюсе» в начале номера
    $phone=trim($phone);
    $plus = ($phone[ 0] == '+');
    $phone = preg_replace("/[^0-9A-Za-z]/", "", $phone);
    $OriginalPhone = $phone;

    // конвертируем буквенный номер в цифровой
    if ($convert == true && !is_numeric($phone)) {
        $replace = array('2'=>array('a','b','c'),
            '3'=>array('d','e','f'),
            '4'=>array('g','h','i'),
            '5'=>array('j','k','l'),
            '6'=>array('m','n','o'),
            '7'=>array('p','q','r','s'),
            '8'=>array('t','u','v'),
            '9'=>array('w','x','y','z'));

        foreach($replace as $digit=>$letters) {
            $phone = str_ireplace($letters, $digit, $phone);
        }
    }

    // заменяем 00 в начале номера на +
    if (substr($phone,  0, 2)=='00')
    {
        $phone = substr($phone, 2, strlen($phone)-2);
        $plus=true;
    }

    // если телефон длиннее 7 символов, начинаем поиск страны
    if (strlen($phone)>7)
        foreach ((array) $phoneCodes as $countryCode=>$data)
        {
            $codeLen = strlen($countryCode);
            if (substr($phone,  0, $codeLen)==$countryCode)
            {
                // как только страна обнаружена, урезаем телефон до уровня кода города
                $phone = substr($phone, $codeLen, strlen($phone)-$codeLen);
                $zero=false;
                // проверяем на наличие нулей в коде города
                if ($data['zeroHack'] && $phone[ 0]=='0')
                {
                    $zero=true;
                    $phone = substr($phone, 1, strlen($phone)-1);
                }

                $cityCode=NULL;
                // сначала сравниваем с городами-исключениями
                if ($data['exceptions_max']!= 0)
                    for ($cityCodeLen=$data['exceptions_max']; $cityCodeLen>=$data['exceptions_min']; $cityCodeLen--)
                        if (in_array(intval(substr($phone,  0, $cityCodeLen)), $data['exceptions']))
                        {
                            $cityCode = ($zero? «0»: "").substr($phone,  0, $cityCodeLen);
                            $phone = substr($phone, $cityCodeLen, strlen($phone)-$cityCodeLen);
                            break;
                        }
                // в случае неудачи с исключениями вырезаем код города в соответствии с длиной по умолчанию
                if (is_null($cityCode))
                {
                    $cityCode = substr($phone,  0, $data['cityCodeLength']);
                    $phone = substr($phone, $data['cityCodeLength'], strlen($phone)-$data['cityCodeLength']);
                }
                // возвращаем результат
                return ($plus? "+": "").$countryCode.'('.$cityCode.')'.phoneBlocks($phone);
            }
        }
    // возвращаем результат без кода страны и города
    return ($plus? "+": "").phoneBlocks($phone);
}

// функция превращает любое число в строку формата XX-XX-... или XXX-XX-XX-... в зависимости от четности кол-ва цифр
function phoneBlocks($number){
    $add='';
    if (strlen($number)%2)
    {
        $add = $number[ 0];
        $add .= (strlen($number)<=5? "-": "");
        $number = substr($number, 1, strlen($number)-1);
    }
    return $add.implode("-", str_split($number, 2));
}

// тесты
echo phone("2147483647")."<br /><hr/>";
echo phone("+38 (044) 226-22-04")."<br />";
echo phone('0038 (044) 226-22-04')."<br />";
echo phone("+79263874814")."<br />";
echo phone('4816145')."<br />";
echo phone("+44 (0) 870 770 5370")."<br />";
echo phone('0044 (0) 870 770 5370')."<br />";
echo phone("+436764505509")."<br />";
echo phone("(+38-048) 784-15-46 ")."<br />";
echo phone("(38-057) 706-34-03 ")."<br />";
echo phone("+38 (044) 244 12 01 ")."<br />";
?>