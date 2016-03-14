<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 1:01 AM
 */
class Controller_Register extends Controller
{
    private $data = null;
    private $user = null;

    public function index()
    {
        if ($_POST['task'] == 'create') {
            $login = $_POST['login'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            if (($login=="") OR ($pass1=="") OR ($pass2=="")) {
                $this->data['info'] = 'Не введены данные!';
            } else {
                $this->user = new User();
                if ($this->user->isLogin($login)) {
                    $this->data['info'] = 'Логин существует!';
                } elseif ($pass1!=$pass2) {
                    $this->data['info'] = 'Пароли не совпадают!';
                } else {
                    // Создание пользователя
                    $this->user->Register($login,$pass1);
                    //header('Location: Auth');
                    //exit;
                    $this->data['info'] = 'Пользователь создан! <a href="Auth">Авторизация</a>';
                }
            }
            $this->view->generate('register_view.php', 'template_view.php',$this->data);
        } else {
            $this->data['info'] = 'Пройдите регистрацию!';
            $this->view->generate('register_view.php', 'template_view.php',$this->data);
        }

    }
}