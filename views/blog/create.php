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
                        <div class="pure-button-group" role="toolbar" aria-label="Выбор стилей">
                            <button class="pure-button button-small" id="h1Add" onclick="hAdd(20);">h1</button>
                            <button class="pure-button button-small" id="h2Add" onclick="hAdd(18);">h2</button>
                            <button class="pure-button button-small" id="h3Add" onclick="hAdd(16);">h3</button>
                            <button class="pure-button button-small" id="h4Add" onclick="hAdd(14);">h4</button>
                            
                                <input class="pure-button color-button" type="color" list="colorList" name="idColor" id="idColor" value="#000000">
                        </div>
                            <output id="rezultatColor"></output>
                        <div class="pure-button-group" role="toolbar">
                            <button id="toHTML" onclick="transformToHTML();">to html</button>
                            <button id="toCode" onclick="transformToCode();">to code</button>
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data" class="pure-form">
                            <!-- <p>Изображение товара</p>
                            <input type="file" name="image" placeholder="" value="" class="form-control mb-2"> -->
                            <!-- <script>
                                function hAdd(){
                                    let a = document.selection.createRange().text;
                                    conslol.log(a);
                                    return true;

                                }
                            </script> -->
                            <fieldset class="pure-group">
                                <input type="text" name="label" class="pure-input-1-2" placeholder="Заголовок">
                                
                                    <textarea class="pure-input-1-2" id="textarea-add" placeholder="Основной текст" name="text">
                                    </textarea>
                                <div class="div-input pure-input-1-2" contenteditable="true" id="div-input"></div>
                                </div>
                            </fieldset>

                            <p>Статус</p><br>
                            <select name="status" class="form-control mb-4">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <input type="submit" name="submit" class="pure-button pure-button-primary" value="Сохранить">
                                <script>
                                    function transformToCode(){
                                        text = document.getElementById('textarea-add');
                                        text.innerText = text.innerHTML;
                                    }
                                    function transformToHTML(){
                                        textHTML = document.getElementById('div-input');
                                        textCode = document.getElementById('textarea-add');
                                        textHTML.style.position ="absolute";
                                        textHTML.style.display ="inherit";
                                        textHTML.style.height ="min-content";
                                        textHTML.style.z-index = 100 ;  
                                        textHTML.innerHTML= textCode.value;
                                        textCode.value='';
                                    }
                                    function hAdd(size){
                                        var colorText = document.getElementById('idColor').value;
                                        var text = document.getElementById('textarea-add');
                                        if (text.selectionStart != undefined) {
                                            var startPos = text.selectionStart;
                                            var endPos = text.selectionEnd;
                                            var selectedText = text.value.substring(startPos, endPos);
                                        if (selectedText) {
                                            var v = text.value.substring(0, startPos);
                                            v += '<font'+' size="'+size+ '" '+'color="'+colorText+'">' + selectedText + '</font>';
                                            v += text.value.substring(endPos);
                                            text.value = v;
                                        }
                                        };
                                    }
                                
                                </script>

                        </form>
                        </div>
                    </div>

                </div>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>