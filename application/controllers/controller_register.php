<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 1:01 AM
 */
class Controller_Register extends Controller
{
    public function index()
    {
        $data = "";
        if ($_POST['task'] == 'create') {
            $login = $_POST['login'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            if (($login=="") OR ($pass1=="") OR ($pass2=="")) {
                $data['error_msg'] = 'Не введены данные!';
            } else {
                $user = new User();
                if ($user->isLogin($login)) {
                    $data['error_msg'] = 'Логин существует!';
                } elseif ($pass1!=$pass2) {
                    $data['error_msg'] = 'Пароли не совпадают!';
                } else {
                    // Создание пользователя
                    $user->Register($login,$pass1);
                    $data['info'] = 'Пользователь создан! <a href="Auth">Авторизация</a>';
                }
            }
        }
        $this->view->generate('register_view.php', 'template_view.php',$data);
    }
}