<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="content">

    <?php if (isset($errors) && is_array($errors)): ?>
        <div class="pure-u-1">
            <ul class="text-center">
                <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

                <div class="pure-g">
                    <div class="pure-u-1">
                        <h1>Создать пост</h1>
                        <form action="#" method="post" enctype="multipart/form-data" class="pure-form">

                            <!-- <p>Изображение товара</p>
                            <input type="file" name="image" placeholder="" value="" class="form-control mb-2"> -->

                            <fieldset class="pure-group">
                                <input type="text" name="label" class="pure-input-1-2" placeholder="Заголовок">
                                <textarea class="pure-input-1-2" placeholder="Основной текст" name="text"></textarea>
                            </fieldset>

                            <p>Статус</p>
                            <select name="status" class="form-control mb-4">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <input type="submit" name="submit" class="pure-button pure-button-primary" value="Сохранить">

                        </form>
                    </div>
                </div>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>