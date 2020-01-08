<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
<form method="post" action="#" class="reg mt-3 mb-3">
<?php if ($result): ?>
    <div class="row justify-content-center">
        <div class="col text-center">
            <h3 >Вы зарегестрированы!</h3>
        </div>
        <div class="w-100"></div>
        <div class="col text-center">
            <!-- <input type="button" class="btn btn-primary " onclick="showWindow();" value="Войти"> -->
            <a href="/user/login/" class="voiti">Войти в личный кабинет</a> 
        </div>
    </div>
<?php else: ?>
    <h3 class="text-center">Регистрация нового пользователя</h3>
    <div class="row">
        <?php if(isset($errors)&& is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?> </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="col-lg-6 col-sm-12 offset-lg-3 mb-3">
            <label>Имя</label>
            <input type="text" class="form-control"  placeholder="Иван" value="" name="name">
            
        </div>

        <div class="col-lg-6 col-sm-12 offset-lg-3 mb-3">
            <label >Email</label>
            <input type="text" class="form-control" placeholder="qwerty12345@mail.ru" value="" name="email">
            
        </div>

        <div class="col-lg-3 offset-lg-3 col-sm-12 mb-3">
                <label>Пароль</label>
                <input type="password" class="form-control" placeholder="" name="password">
                
        </div>

        <div class="col-lg-3 col-sm-12 mb-3">
                <label >Повторите пароль</label>
                <input type="password" class="form-control" id="confirm_password" placeholder="" name="password_confirm" >
                
        </div>
        <div class="col-lg-6 col-sm-12 offset-lg-3 mb-2">
            <input type="submit" name="submit" class="btn btn-primary mb-2 " value="Регистрация">
        </div>
    </div> 
    <?php endif ?>
</form>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>