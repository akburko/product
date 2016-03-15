<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:24 AM
 */
class Controller_Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index() {

        $data = "";
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if (count($_POST)>0) {
            $user = new User($login,$pass);
            switch($user->status){
                case 0:
                    // Неверный пароль
                    $data['error_msg'] = 'Неверный пароль!';
                    break;
                case 1:
                    // Пользователь успешно авторизован
                    $_SESSION["user_id"] = $user->id;
                    header('Location: products');
                    exit;
                    break;
                case 2:
                    // Пользователь не найден
                    $data['error_msg'] = 'Пользователь не найден!';
                    break;
                case 3:
                    // Логин и пароль пустые
                    $data['error_msg'] = 'Введите логин/пароль';
                    break;
            }
        }

        $this->view->generate('auth_view.php', 'template_view.php',$data);

    }

    public function logout() {

        unset($_SESSION['user_id']);
        header('Location: http://'.URL_SITE);
        exit;
    }

}