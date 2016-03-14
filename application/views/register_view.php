<div class="container">
    <?php if (isset($info)) { ?>
        <div class="row">
            <div class="col-xs-6 col-md-4 col-xs-offset-6 col-md-offset-4">
                <div class="alert alert-info"><?php echo $info; ?></div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-xs-6 col-md-4 col-xs-offset-6 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    <form action="register" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputLogin" class="col-sm-2 control-label">Логин</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Логин">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="pass1" placeholder="Пароль">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPassword" name="pass2" placeholder="Повторите пароль">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Создать</button>
                                <a href="Auth">Авторизация</a>
                            </div>
                        </div>
                        <input type="hidden" name="task" value="create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>