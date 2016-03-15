<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/15/16
 * Time: 11:48 PM
 */
class My_Exception extends Controller
{
    public function __construct($message="Ошибка отображения страницы", $code=0)
    {
        parent::__construct();

        $data['info'] = $message;
        $this->view->generate('exception_view.php','template_view.php',$data);
    }

}