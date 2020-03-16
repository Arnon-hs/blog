<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="content">
    <div class="pure-g">
        <form action="#" method="post" class="pure-form pure-form-stacked">
            <div class="pure-u-1">
                <h2>Вход на сайт</h2>
                <?php if(isset($errors)&& is_array($errors)): ?>
                    <ul class="mt-2">
                        <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?> </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <div class="pure-u-1">
                <label>E-mail</label>
                <input type="email"  name="email" placeholder="qwerty12345@mail.ru" value="" class="form-control">
            </div>
            <div class="pure-u-1">
                <label>Пароль</label>
                <input type="password" name="password" value="" class="form-control">
            </div>
            <div class="pure-u-1">
                <input type="submit" name="submit" class="pure-button" type="submit" value="Войти">
                <a href="/user/register" class="pure-button">Регистрация</a>
            </div>
        </form>
    </div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>