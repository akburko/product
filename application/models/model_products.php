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
    private $sql = null;
    private $result = null;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->db = DB::getConnection();
    }

    /**
     * Получение списка всех продуктов с рейтингом и комментарием для указанного пользователя
     *
     * @param $user_id
     * @return bool
     */
    public function getProducts($user_id) {
        $this->sql = "select `products`.`id`,`name`,`rating`,`comment` FROM products LEFT JOIN (SELECT * FROM ratings_comments WHERE user_id = :user_id) as a ON products.id = a.product_id";
        $this->result = $this->db->prepare($this->sql);
        $this->result->execute(["user_id"=>$user_id]);
        $this->result->setFetchMode(PDO::FETCH_OBJ);
        return $this->result->fetchAll();
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
        //for($i=0,$n=count($id);$i<$n;$i++) {
        foreach( $id as $i => $product_id) {
            // Проверяем есть ли запись для данной комбинации $product_id и $user_id
            if ($this->checkData($id[$i],$user_id)) {
                // Если есть, то обновляем
                $this->sql = "UPDATE ratings_comments SET rating = :rating, comment = :comment WHERE product_id = :product_id AND user_id = :user_id";
            } else {
                // если нет - вставляем запись
                $this->sql = "INSERT INTO ratings_comments SET user_id = :user_id, product_id = :product_id, rating = :rating, comment = :comment";
            }
            $this->result = $this->db->prepare($this->sql);
            $this->result->execute(["product_id"=>$product_id,"rating"=>$rating[$i],"comment"=>$comment[$i],"user_id"=>$user_id]);
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

        $this->sql = "SELECT * FROM ratings_comments WHERE product_id = :product_id AND user_id = :user_id";
        $this->result = $this->db->prepare($this->sql);
        $this->result->execute(["product_id"=>$product_id,"user_id"=>$user_id]);
        return $this->result->rowCount();

    }

    /**
     * Функция получения информации о рейтнге и комментариях пользователей для указанного продукта
     *
     * @param $product_id
     * @return array
     */
    public function getInfo($product_id) {
        $sql = "SELECT login,rating,comment FROM users JOIN ratings_comments ON users.id = ratings_comments.user_id WHERE ratings_comments.product_id=:product_id";
        $this->result= $this->db->prepare($sql);
        $this->result->execute(["product_id"=>$product_id]);
        $this->result->setFetchMode(PDO::FETCH_OBJ);
        return $this->result->fetchAll();
    }

    /**
     * Функция получения наименования продукта по его идетификатору
     *
     * @param $product_id
     * @return string
     */
    public function getName($product_id) {
        $sql = "SELECT name FROM products WHERE id = :product_id";
        $this->result = $this->db->prepare($sql);
        $this->result->execute(["product_id"=>$product_id]);
        return $this->result->fetchColumn();
    }

    /**
     * Функция получения суммы рейтингов и среднего занчения для указанного продукта
     *
     * @param $product_id
     * @return mixed
     */
    public function getStat($product_id){
        $sql = "SELECT sum(rating) as amount, (sum(rating)/count(*)) as average FROM users JOIN ratings_comments ON users.id = ratings_comments.user_id WHERE ratings_comments.rating <> 0 AND ratings_comments.product_id=:product_id";
        $this->result = $this->db->prepare($sql);
        $this->result->execute(["product_id"=>$product_id]);
        $this->result->setFetchMode(PDO::FETCH_OBJ);
        return $this->result->fetch();
    }
}