<?php include ROOT . '/views/layouts/header.php'; ?>
<!-- <script src="jquery.simplecolorpicker.js"></script>
<link rel="stylesheet" href="jquery.simplecolorpicker.css"> -->
<script src="https://cdn.jsdelivr.net/npm/jquery-simplecolorpicker@0.3.1/jquery.simplecolorpicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-simplecolorpicker@0.3.1/jquery.simplecolorpicker.css">
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
            <input type="text" name="tags" id="tags">
            <span id="saveTag">C</span>
            <select name="colorpicker">
                <option value="#7bd148">Green</option>
                <option value="#5484ed">Bold blue</option>
                <option value="#a4bdfc">Blue</option>
                <option value="#46d6db">Turquoise</option>
                <option value="#7ae7bf">Light green</option>
                <option value="#51b749">Bold green</option>
                <option value="#fbd75b">Yellow</option>
                <option value="#ffb878">Orange</option>
                <option value="#ff887c">Red</option>
                <option value="#dc2127">Bold red</option>
                <option value="#dbadff">Purple</option>
                <option value="#e1e1e1">Gray</option>
            </select>
            <ul id="tag__wrapper"></ul>
            <br>
            <br>
            <br>
            <p><input type="submit" value="Сохранить" name="submit" class="pure-button"></p>
        </form>
    </div>
    <script>
    $('#saveTag').on('click', function(){
        let tagName = $('#tags').val();
        let color = $('select[name="colorpicker"]').val();
        var newdiv = document.createElement("li");
        newdiv.innerHTML = "<div class='tag tag__simple' name='tag' style='background-color:"+color+"'>"+tagName+"<span id='deleteTag'>X</span></div>";
        //newdiv.appendTo('div#quest');
        document.getElementById("tag__wrapper").appendChild(newdiv);
        $('#tags').val('');
        
        // var els = document.getElementById("deleteTag");
        //     els.addEventListener("click", function(){
        //         els.parentNode.removeChild(els.parentNode);
        //     });
        var elem =  document.getElementById('deleteTag');
        elem.addEventListener('click', function(e) { 
            var dsf = e.target.parentNode;
            elem.removeChild(dsf);
        });
    });

    $('select[name="colorpicker"]').simplecolorpicker();
    $('select[name="colorpicker"]').simplecolorpicker('selectColor', '#7bd148');
    $('select[name="colorpicker"]').simplecolorpicker('destroy');
    $('select[name="colorpicker"]').simplecolorpicker({ picker: true });
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