<?php

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 3/14/16
 * Time: 8:08 PM
 */
class Model_Products extends Model
{
    private $db = null;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * Получение списка всех продуктов с рейтингом и комментарием для указанного пользователя
     *
     * @param $user_id
     * @return bool
     */
    public function getProducts($user_id) {
        $sql = "select `products`.`id`,`name`,`rating`,`comment` FROM products LEFT JOIN (SELECT * FROM ratings_comments WHERE user_id = :user_id) as a ON products.id = a.product_id";
        return $this->db->query($sql,["user_id"=>$user_id])->fetchAll();
    }

    /**
     * @param $id
     * @param $rating
     * @param $comment
     * @param $user_id
     * @internal param $prod_id
     * @return bool
     */
    public function putData($id, $rating, $comment, $user_id) {

        foreach( $id as $i => $product_id) {
            // Проверяем есть ли запись для данной комбинации $product_id и $user_id
            if ($this->checkData($id[$i],$user_id)) {
                // Если есть, то обновляем
                $sql = "UPDATE ratings_comments SET rating = :rating, comment = :comment WHERE product_id = :product_id AND user_id = :user_id";
            } else {
                // если нет - вставляем запись
                $sql = "INSERT INTO ratings_comments SET user_id = :user_id, product_id = :product_id, rating = :rating, comment = :comment";
            }
            $this->db->query($sql,["product_id"=>$product_id,"rating"=>$rating[$i],"comment"=>$comment[$i],"user_id"=>$user_id]);
        }
        return true;
    }

    /**
     * Функция поиска строки рейтинга и комментария для указанного продукта и пользователя
     *
     * @param $product_id
     * @param $user_id
     * @return int
     */
    private function checkData($product_id, $user_id) {
        $sql = "SELECT * FROM ratings_comments WHERE product_id = :product_id AND user_id = :user_id";
        return $this->db->query($sql,["product_id"=>$product_id,"user_id"=>$user_id])->rowCount();
    }

    /**
     * Функция получения информации о рейтнге и комментариях пользователей для указанного продукта
     *
     * @param $product_id
     * @return array
     */
    public function getInfo($product_id) {
        $sql = "SELECT login,rating,comment FROM users JOIN ratings_comments ON users.id = ratings_comments.user_id WHERE ratings_comments.product_id=:product_id";
        return $this->db->query($sql,["product_id"=>$product_id])->fetchAll();
    }

    /**
     * Функция получения наименования продукта по его идетификатору
     *
     * @param $product_id
     * @return string
     */
    public function getName($product_id) {
        return $this->db->query("SELECT name FROM products WHERE id = :product_id",["product_id"=>$product_id])->fetchColumn();
    }

    /**
     * Функция получения суммы рейтингов и среднего значения для указанного продукта
     *
     * @param $product_id
     * @return mixed
     */
    public function getStat($product_id){
        $sql = "SELECT sum(rating) as amount, (sum(rating)/count(*)) as average FROM users JOIN ratings_comments ON users.id = ratings_comments.user_id WHERE ratings_comments.rating <> 0 AND ratings_comments.product_id=:product_id";
        return $this->db->query($sql,["product_id"=>$product_id])->fetch();
    }
}