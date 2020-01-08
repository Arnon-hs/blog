<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container mt-2 mb-4">
        <div class="row">       
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/cabinet">Кабинет</a></li>
                    <li class="active">Просмотр заказов</li>
                </ol>
            </div>

            <div class="col-12">
                <h4>История заказов</h4>
            </div>
            <?php foreach ($ordersList as $order): ?>
            <table class="table-bordered table-striped table">
                <table class="table-bordered table-striped table"> 
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Дата оформления</th>
                    <th>Статус</th>
                    <th>Комментарий</th>
                    
                </tr>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                        <td><?php echo $order['user_comment'];?></td>
                        
                        
                    </tr>
                </table>
                    
                    <?php $sum=0;?>
                    <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Количество, шт</th>
                                <th>Стомость, р</th>
                            </tr>
                            
                                <?php          $productsQuantity = json_decode($order['products'], true);

// Получаем массив с индентификаторами товаров
$productsIds = array_keys($productsQuantity);


// Получаем список товаров в заказе
$products = Product::getProductsByIds($productsIds);

                                foreach ($products as $product): ?>
                                    <tr>
                                        <td><?php echo $product['code'];?></td>
                                        <td>
                                            <a href="/product/<?php echo $product['id'];?>">
                                                <?php echo $product['name'];?>
                                            </a>
                                        </td>
                                        <td><?php echo $productsQuantity[$product['id']];?></td> 
                                        <td><?php echo $product['price'];?></td>  
                                        <?php 
                                        $sum=$sum+($product['price']*$productsQuantity[$product['id']])?>                   
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3">Общая стоимость:</td>
                                    <td><?php echo $sum;?></td>
                                </tr>   
                        </table>
                    </table> 
                <?php endforeach; ?>
                
            

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

