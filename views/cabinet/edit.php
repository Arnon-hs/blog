<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="content">
    <form method="post" action="#" class="pure-form pure-form-stacked">
        <?php if ($result): ?>
            <div class="row justify-content-center">
                <div class="col text-center">
                    <h3>Данные успешно изменены!</h3>
                </div>
                
            </div>
        <?php else: ?>
        <h3 class="text-center">Редактирование данных пользователя</h3>
        <div class="row mt-3">
            <?php if(isset($errors)&& is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?> </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            
            <div class="col-lg-6 offset-lg-3 col-sm-12  mb-3">
                <label>Имя</label>
                <input type="text" class="form-control" value="<?php echo $firstname;?>" name="name">
                
            </div>
        
            <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
                    <label>Пароль</label>
                    <input type="password" class="form-control" value="" name="password">
            </div>
            <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3 ">    
                <input type="submit" name="submit" class="pure-button" value="Сохранить">
            </div>
        </div> 
        <?php endif ?>
    </form>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>