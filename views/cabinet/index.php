<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="content">
    <div class="pure-g">
        <div class="pure-u-1-1">
            <h2 class="pure-u-">Кабинет пользователя <?php echo $user{'name'} ?></h2>
        </div>

        <div class="pure-u-1-1">    
            <ul class=" list-unstyled h_m">
                <li><a href="/post/create"><img src="/template/images/icons/icons8-edit-50.png">Добавить пост</a></li>
                <li><a href="/cabinet/edit"><img src="/template/images/icons/icons8-edit-50.png">Редактировать личные данные</a></li>
                <li><a href="/user/history"><img src="/template/images/icons/icons8-order-history-50.png"> История заказов</a></li>
            </ul>
        </div>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>