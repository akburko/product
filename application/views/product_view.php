<div class="container">
    <div class="page-header">
        <h1>Наименование продукта:<?php echo $name; ?></h1>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Пользователь</th>
            <th>Рейтинг</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($ratings_comments)) {
            foreach($ratings_comments as $row) {
                if (($row->rating!=0)OR(!empty($row->comment))) {
                    ?>
                    <tr>
                        <td><?php echo $row->login; ?></td>
                        <td><?php
                            if ($row->rating == 0) {
                                echo "";
                            } else {
                                echo $row->rating;
                            }
                            ?>
                        </td>
                        <td><?php echo $row->comment; ?></td>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="3">
                    Список пуст
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Показатель</th>
                <th>Значение</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Сумма всех рейтингов</td>
                <td><?php echo $amount;?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Среднее значение рейтинга</td>
                <td><?php echo number_format($average,1,'.','');?></td>
            </tr>
        </tbody>
    </table>
    <a href="http://<?php echo URL_SITE.'/products'; ?>" class="btn btn-default" role="button">В список продуктов</a>
    <a href="http://<?php echo URL_SITE.'/Auth/logout'; ?>">Выйти</a>
</div>
