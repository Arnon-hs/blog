<?php include_once(ROOT . '/views/layouts/header.php');?>
<div class="content pure-u-3-4 pure-u-md-3-4">
    <!-- A wrapper for all the blog posts -->
    <?php foreach ($posts as $post):
        if(!empty($post{'label'})|| !empty($post{'text'})):?>
        <div class="pure-u-1-2">
            <div class="post">
                <h1 class="content-subhead"><?php echo $post{'label'};?></h1>

                <!-- A single blog post -->
                
                <section class="post">
                    <div class="post-description">
                        <p>
                            <?php echo $post{'text'};?>
                        </p>
                    </div>
                </section>
            </div>
        </div>
    <?php endif;
    endforeach;?>
    <!-- <div>
        <ul>
            <?php 
            // перебираем результаты
            foreach ($cursor as $document) {
                echo ("<li>" . $document["_id"] . "</li>");
            }?>
        </ul>
    </div> -->
</div>
<script>
    //работает
    // // 1. Создаём новый объект XMLHttpRequest
    // var xhr = new XMLHttpRequest();

    // // 2. Конфигурируем его: GET-запрос на URL
    // xhr.open('GET', 'http://blog/api/users/5e15afbf1e2600007e007af6', false);

    // // 3. Отсылаем запрос
    // xhr.send();

    // // 4. Если код ответа сервера не 200, то это ошибка
    // if (xhr.status != 200) {
    // // обработать ошибку
    // alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
    // } else {
    // // вывести результат
    // alert( xhr.responseText ); // responseText -- текст ответа.
    // }
</script>
<?php include_once(ROOT."/views/layouts/footer.php"); ?> 