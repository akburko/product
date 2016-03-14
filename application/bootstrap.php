<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/13/16
 * Time: 11:58 PM
 */
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/db.php';
require_once 'core/user.php';
require_once 'config.php';
session_start();
Route::start(); // запускаем маршрутизатор