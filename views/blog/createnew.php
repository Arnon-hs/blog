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
        <form action="create" method="post" class="pure-form pure-form-stacked">
            <textarea id="editorLabel"  name="label">
                <p>Enter label here.</p>
            </textarea>
            <br>
            <textarea id="editor"  name="text">
                <p>This is some sample content.</p>
            </textarea>
            <br>
            <select name="status" id="state">
                <option value="1" selected="selected">Отображается</option>
                <option value="0">Скрыт</option>
            </select>
            <br>
            <p><input type="submit" value="Сохранить" name="submit" class="pure-button"></p>
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
<?// $data = $_POST['content'];
//$data = str_replace( '&', '&amp;', $_POST[ 'content' ] );
//var_dump($data);