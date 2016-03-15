<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 12:55 AM
 */

class Controller_Products extends Controller
{
    private $user_id = null;
    private $product = null;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $_SESSION['user_id'];
        $this->loadModel('Model_Products');
        $this->product = new Model_Products();
    }

    /**
     * Генерация страницы продуктов
     */
    public function index()
    {
        $data = "";
        if (!$this->user_id) {
            $data['info'] = 'Доступ запрещен! <a href="http://' . URL_SITE . '">Авторизация</a>';
            $this->view->generate('access_view.php', 'template_view.php', $data);
        } else {
            $data['products'] = $this->product->getProducts($this->user_id);
            $data['user_id'] = $this->user_id;
            $data['name'] = User::getName($this->user_id);
            $this->view->generate('products_view.php', 'template_view.php', $data);
        }
    }

    /**
     * Сохранение рейтинга и комментариев продуктов
     */
    public function save()
    {
        $this->product->putData($_POST['id'],$_POST['rating'],$_POST['comment'],$this->user_id);
        header('Location: http://'.URL_SITE.'/products');
        exit;
    }

    /**
     * Генерация страницы продукта с рейтингом и комментариями пользователей
     * @param null $id
     */
    public function info($id = null) {
        $data ="";
        if (!$this->user_id) {
            $data['info'] = 'Доступ запрещен! <a href="http://' . URL_SITE . '">Авторизация</a>';
            $this->view->generate('access_view.php', 'template_view.php', $data);
        } else {
            $data['ratings_comments'] = $this->product->getInfo($id);
            $data['name'] = $this->product->getName($id);
            $stat_data = $this->product->getStat($id);
            $data['amount'] = $stat_data->amount;
            $data['average'] = $stat_data->average;
            $this->view->generate('product_view.php', 'template_view.php', $data);
        }
    }

}