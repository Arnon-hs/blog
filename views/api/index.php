<?
function Error($e){
    exit('Error: '.$e);
}
// var_dump($params);
if(($params)){
    if($params != 'all'){
        echo 'ok ';
        $paramEx = explode('.',$params);
        var_dump($paramEx);
        $res = Blog::getBlogItemById($paramEx[0]);
        // json_decode($res);
        var_dump($res);
    }else{
        $posts = Blog::getBlogList();//работает вывод и разбирается объект, надо доделать  проверки и вывод одного поста
        ?>
        <?php foreach ($posts as $post):?>
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
        <?php endforeach;
    }
   
} else Error('Параметры указаны неверно');