<div class="container">
    <div class="page-header">
        <h1>Пользователь:<?php echo $name; ?></h1>
    </div>
    <form action="products/save" method="post">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование продукта</th>
                <th>Рейтинг</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if (isset($products)) {
                    foreach($products as $product) {
                    ?>
                        <tr>
                            <td><?php echo $product->id;?><input type="hidden" name="id[]" value="<?php echo $product->id;?>"></td>
                            <td><a href="http://<?php echo URL_SITE; ?>/products/info/<?php echo $product->id;?>"><?php echo $product->name;?></a></td>
                            <td><select name="rating[]">
                                    <option value=""></option>
                                    <?php
                                    for($i=1;$i<6;$i++) {
                                        if ($product->rating==$i) {
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        } else {
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    }
                                    ?>
                                </select></td>
                            <td><textarea name="comment[]"><?php echo htmlentities($product->comment,ENT_QUOTES, "UTF-8");?></textarea></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                        <tr>
                            <td colspan="4">
                                Список пуст
                            </td>
                        </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-default">Сохранить</button>
        <a href="http://<?php echo URL_SITE.'/Auth/logout'; ?>">Выйти</a>
    <form>
</div>