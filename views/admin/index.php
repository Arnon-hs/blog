<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <br />
            <div class="col-12">
                <h4>Вы находитесь в панели администратора!</h4>
            </div>
            <br />
            <div class="col-12">
                <p>Вам доступны такие возможности:</p>
            </div>
            <br />
            <div class="col-12">
                <ul class="list-unstyled">
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

