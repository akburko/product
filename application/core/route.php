<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:00 AM
 */
class Route
{

    public static function start() {

        // контроллер и действие по умолчанию
        $controller_name = 'Auth';
        $action_name = 'index';
        $data = null;

        $routes = explode('/', $_GET['route']);

        // получаем имя контроллера
        if ( !empty($routes[0]) )
        {
            $controller_name = $routes[0];
        }

        // получаем имя экшена
        if ( !empty($routes[1]) )
        {
            $action_name = $routes[1];
        }

        // получаем значение переменной
        if ( !empty($routes[2]) )
        {
            $data = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        //$action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            if (!isset($data)) {
                $controller->$action();
            } else {
                $controller->$action($data);
            }
        }
        else
        {
            Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location: http://'.URL_SITE.'/Auth/error404');
    }

}