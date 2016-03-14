<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:19 AM
 */
// константы для подключени к БД
define('DB_HOST', 'localhost'); //сервер
define('DB_USER', 'root'); //пользователь
define('DB_PASS', ''); //пароль
define('DB_NAME', 'catalog');//база

define('DIR_SITE', 'products'); //  Подкаталог размещения сайта на сервере
define('URL_SITE',$_SERVER['HTTP_HOST'].'/'.DIR_SITE); // URL сайта