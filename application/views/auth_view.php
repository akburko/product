<div class="container">
    <div class="row">
        <div class="col-xs-6 col-md-4 col-xs-offset-6 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Авторизация</div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputLogin" class="col-sm-2 control-label">Логин</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Логин">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="pass" placeholder="Пароль">
                            </div>
                        </div>
                        <?php if (isset($error_msg)) { ?>
                            <p class="text-danger"><?php echo $error_msg; ?></p>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Войти</button>
                                <a href="register">Регистрация</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>