<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container mb-5">
<form method="post" action="#" class="mr-3 ml-3 mt-3 mb-3">
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
            <input type="text" class="form-control" value="<?php echo $firstname;?>" name="firstname">
            
        </div>
         <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
            <label>Фамилия</label>
            <input type="text" class="form-control" value="<?php echo $secondname;?>" name="secondname">
            
        </div>
        <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
            <label>Отчество</label>
            <input type="text" class="form-control" value="<?php echo $lastname;?>" name="lastname" >
            
        </div>
    
    
        <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3">
                <label>Пароль</label>
                <input type="password" class="form-control" value="" name="password">
        </div>
        <div class="col-lg-6 offset-lg-3 col-sm-12 mb-3 ">    
            <input type="submit" name="submit" class="btn btn-primary mb-2" value="Сохранить">
        </div>
    </div> 
    <?php endif ?>
</form>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>