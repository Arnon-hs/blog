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

        <h1>Добавить пост</h1>
        <form method="post" class="pure-form pure-form-stacked">
            <textarea id="editorLabel" name="label">
                <p><?= $post{'label'}?></p>
            </textarea>
            <br>
            <textarea id="editor" name="text">
                <p><?= $post{'text'}?></p>
            </textarea>
            <br>
            <select name="status" id="state">
                <option value="1" selected="selected">Отображается</option>
                <option value="0">Скрыт</option>
            </select>
            <br>
            <p><input type="submit" value="Обновить" name="submit" class="pure-button"></p>
        </form>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editorLabel' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

<?php include ROOT . '/views/layouts/footer.php'; ?>