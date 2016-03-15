<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:00 AM
 */
class Controller
{
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function index()
    {
    }

    /**
     * Функция загрузки файлов классов
     *
     * @param $class
     */
    function loadModel($model) {

        $model_file = 'application/models/'.strtolower($model).'.php';

        if(file_exists($model_file))
        {
            require_once $model_file;
        }
        else
        {
            new My_Exception("Ошибка создания страницы. Файл подключаемой модели ".$model." не существует.");
            exit;
        }

    }

}