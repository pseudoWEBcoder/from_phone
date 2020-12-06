<?php
session_start();
date_default_timezone_set('Europe/Moscow');
include_once $_SERVER['DOCUMENT_ROOT'] . '/cesar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/mysql.php';
function redirect($url = '/', $seconds)
{
    echo "<meta http-equiv='refresh' content='" . $seconds . ";" . $url . "'>";
}

if (isset($_COOKIE['face']) && Cesar(md5($_COOKIE['face']), 9) != $_COOKIE['face_hash']) unset($_COOKIE['face']);
if (!isset($_COOKIE['face'])) {
    $newface = "FACE2.0_" . Cesar(md5(uniqid()), 17) . "_" . date("dmY");
    SetCookie("face", $newface, time() + 3600 * 24 * 365 * 10, "/");
    SetCookie("face_hash", Cesar(md5($newface), 9), time() + 3600 * 24 * 365 * 10, "/");
    exit(redirect($_SERVER['REQUEST_URI'], 0));
}
function exit_account()
{
    setcookie("lsp_login", "", time() - 1, "/");
    setcookie("lsp_pass", "", time() - 1, "/");
    @session_destroy();
}

function user_auth($login, $password)
{
    $rows = R::getRow('SELECT id,username,password,mail,donate,admin,premium FROM accounts WHERE username=? AND password=?', [$login, $password]);
    if (!isset($rows['id'])) return 0;
    $_SESSION['id'] = $rows['id'];
    $_SESSION['username'] = $rows['username'];
    $_SESSION['password'] = $rows['password'];
    $_SESSION['admin'] = $rows['admin'];
    $_SESSION['donate'] = $rows['donate'];
    $_SESSION['mail'] = $rows['mail'];
    $_SESSION['premium'] = $rows['premium'];
    SetCookie("hash_a", md5($login . "LSP"), time() + 3600 * 24 * 365, "/");
    exit(redirect($_SERVER['REQUEST_URI'], 1));
}

function format_by_count($number, $one, $two, $five)
{
    if (($number - $number % 10) % 100 != 10) {
        if ($number % 10 == 1) {
            $result = $one;
        } elseif ($number % 10 >= 2 && $number % 10 <= 4) {
            $result = $two;
        } else {
            $result = $five;
        }
    } else {
        $result = $five;
    }
    return $result;
}

function assign_rand_value($num)
{
    switch ($num) {
        case "1"  :
            $rand_value = "a";
            break;
        case "2"  :
            $rand_value = "b";
            break;
        case "3"  :
            $rand_value = "c";
            break;
        case "4"  :
            $rand_value = "d";
            break;
        case "5"  :
            $rand_value = "e";
            break;
        case "6"  :
            $rand_value = "f";
            break;
        case "7"  :
            $rand_value = "g";
            break;
        case "8"  :
            $rand_value = "h";
            break;
        case "9"  :
            $rand_value = "i";
            break;
        case "10" :
            $rand_value = "j";
            break;
        case "11" :
            $rand_value = "k";
            break;
        case "12" :
            $rand_value = "l";
            break;
        case "13" :
            $rand_value = "m";
            break;
        case "14" :
            $rand_value = "n";
            break;
        case "15" :
            $rand_value = "o";
            break;
        case "16" :
            $rand_value = "p";
            break;
        case "17" :
            $rand_value = "q";
            break;
        case "18" :
            $rand_value = "r";
            break;
        case "19" :
            $rand_value = "s";
            break;
        case "20" :
            $rand_value = "t";
            break;
        case "21" :
            $rand_value = "u";
            break;
        case "22" :
            $rand_value = "v";
            break;
        case "23" :
            $rand_value = "w";
            break;
        case "24" :
            $rand_value = "x";
            break;
        case "25" :
            $rand_value = "y";
            break;
        case "26" :
            $rand_value = "z";
            break;
        case "27" :
            $rand_value = "0";
            break;
        case "28" :
            $rand_value = "1";
            break;
        case "29" :
            $rand_value = "2";
            break;
        case "30" :
            $rand_value = "3";
            break;
        case "31" :
            $rand_value = "4";
            break;
        case "32" :
            $rand_value = "5";
            break;
        case "33" :
            $rand_value = "6";
            break;
        case "34" :
            $rand_value = "7";
            break;
        case "35" :
            $rand_value = "8";
            break;
        case "36" :
            $rand_value = "9";
            break;
    }
    return $rand_value;
}

function get_rand_alphanumeric($length)
{
    if ($length > 0) {
        $rand_id = "";
        for ($i = 1; $i <= $length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1, 36);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}

function get_rand_numbers($length)
{
    if ($length > 0) {
        $rand_id = "";
        for ($i = 1; $i <= $length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(27, 36);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}

function get_rand_letters($length)
{
    if ($length > 0) {
        $rand_id = "";
        for ($i = 1; $i <= $length; $i++) {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1, 26);
            $rand_id .= assign_rand_value($num);
        }
    }
    return $rand_id;
}

function ucp_header()
{
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Los Santos Project</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="../assets/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/ionicons.min.css">
        <link rel="stylesheet" href="../assets/AdminLTE.min.css">
        <link rel="stylesheet" href="../assets/_all-skins.min.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="../profile/" class="logo">
                <span class="logo-mini"><b>LS</b>P</span>
                <span class="logo-lg"><b>LS</b>PROJECT</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            </nav>
        </header>';
}

function sidebar()
{
    echo '<aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"><i class="fa fa-user" style="margin-right: 5px;"></i>' . $_SESSION['username'] . '</li>';
    if ($_SESSION['admin'] > 1) {
        $requests = R::getCell('SELECT COUNT(*) FROM ucp_requests WHERE status=0');
        echo '<li class="treeview active">
        <a href="#"><i class="fa fa-shield"></i> <span>Администрирование</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        <ul class="treeview-menu">';
        echo '
            <li';
        $referer = explode("/", $_SERVER['SCRIPT_NAME']);
        if ($referer[1] . $referer[2] == 'adminrequests.php' || $referer[1] . $referer[2] == 'adminrequest_info.php' || $referer[1] . $referer[2] == 'adminseen_request_info.php') echo ' class="active"';
        echo '>
                <a href="../admin/requests.php">
                    <i class="fa fa-circle-o"></i> 
                    <span>Проверка UCP</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-gray">' . $requests . '</small>
                    </span>
                </a>
            </li>';
        echo '<li';
        if ($referer[1] . $referer[2] == 'adminsearch.php') echo ' class="active"';
        echo '>
                <a href="../admin/search.php">
                    <i class="fa fa-circle-o"></i> 
                    <span>Поиск аккаунта</span>
                </a>
            </li>';
        if($_SESSION['admin']>3) {
            echo '<li';
            if ($referer[1] . $referer[2] == 'adminck.php') echo ' class="active"';
            echo '>
                <a href="../admin/ck.php">
                    <i class="fa fa-circle-o"></i> 
                    <span>Управление CK</span>
                </a>
            </li>';
        }
        echo '<li';
        if ($referer[1] . $referer[2] == 'adminadmins.php') echo ' class="active"';
        echo '>
                <a href="../admin/admins.php">
                    <i class="fa fa-circle-o"></i> 
                    <span>Администрация</span>
                </a>
            </li>';
        echo '<li';
        if ($referer[1] . $referer[2] == 'adminlog.php') echo ' class="active"';
        echo '>
                <a href="../admin/log.php">
                    <i class="fa fa-circle-o"></i> 
                    <span>Лог действий</span>
                </a>
            </li>';
        echo '
        </ul>
    </li>';
    }
    echo '
                    <li>
                        <a href="http://forum.ls-project.ru" target="_blank">
                            <i class="fa fa-comments"></i> <span>Форум</span>
                        </a>
                    </li>
                    <li>
                        <a href="../profile/logout.php">
                            <i class="fa fa-sign-out"></i> <span>Выход</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>';
}