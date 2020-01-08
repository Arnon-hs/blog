<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
    <div class="row ">
    <form action="#" method="post" style="width: 100%">
            <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3 mt-3 text-center">
                <h5>Вход на сайт</h5>
                <?php if(isset($errors)&& is_array($errors)): ?>
                <ul class="mt-2">
                    <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?> </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            </div>
            
            <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
                <label>E-mail</label>
                <input type="email"  name="email" placeholder="qwerty12345@mail.ru" value="" class="form-control">
                
            </div>
            <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
                <label>Пароль</label>
                <input type="password" name="password" value="" class="form-control">
                
            </div>
            <div class="col-lg-6 offset-lg-3 col-sm-12">
                <input type="submit" name="submit" class="btn btn-primary mb-2" type="submit" value="Войти">
                <a href="/user/register" class="ml-3 offset-md-3 ">Регистрация</a>
            </div>
        </form>
    </div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>