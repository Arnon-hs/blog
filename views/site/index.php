<?php include_once(ROOT . '/views/layouts/header.php');
    
    ?>
<div class="content pure-u-1 pure-u-md-3-4"></div>
    <!-- A wrapper for all the blog posts -->
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
    <?php endforeach;?>
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
<?php include_once(ROOT."/views/layouts/footer.php"); ?> 