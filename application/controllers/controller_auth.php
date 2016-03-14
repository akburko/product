<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:24 AM
 */
class Controller_Auth extends Controller
{
    private $login = null;
    private $pass = null;
    private $user = null;
    private $data = null;

    public function __construct()
    {
        parent::__construct();

    }

    public function index() {

        $this->login = $_POST['login'];
        $this->pass = $_POST['pass'];
        $this->user = new User($this->login,$this->pass);
        switch($this->user->status){
            case 0:
                // Неверный пароль
                $this->data['info'] = 'Неверный пароль!';
                break;
            case 1:
                // Пользователь успешно авторизован
                $_SESSION["user_id"] = $this->user->id;
                header('Location: products');
                exit;
                break;
            case 2:
                // Пользователь не найден
                $this->data['info'] = 'Пользователь не найден! <a href="register">Регистрация</a>';
                break;
            case 3:
                // Логин и пароль пустые
                $this->data['info'] = 'Введите логин/пароль';
                break;
        }

        $this->view->generate('auth_view.php', 'template_view.php',$this->data);

    }

    public function logout() {

        unset($_SESSION['user_id']);
        header('Location: http://'.URL_SITE);
        exit;
    }

    public function error404() {
        $this->view->generate('error404_view.php', 'template_view.php');
    }
}