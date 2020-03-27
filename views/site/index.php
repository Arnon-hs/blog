<?php include_once(ROOT . '/views/layouts/header.php');?>
<div class="content pure-u-3-4 pure-u-md-3-4">
    <?php foreach ($posts as $post):
    $post{'label'} = str_replace('<p>&nbsp;</p>','',$post{'label'});
    if(!empty($post{'tags'})) $tags = explode(',',$post{'tags'});
        if(!empty($post{'label'}) && !empty($post{'text'})):?>
        <div class="pure-u-1-1">
            <div class="post">
                <div class="title-post content-subhead">
                    <a href="/post/view/<?= $post{'_id'}?>/">
                        <span>
                            <?= $post{'label'};?>
                        </span>
                    </a>
                </div>
                <? foreach($tags as $tag){ ?>
                    <span style="background-color:<?=Blog::randomColorTags();?>" class="tag"><?= $tag; ?></span>
                <? }?>
                <section class="post">
                    <div class="post-description">
                        <p><?= $post{'text'};?></p>
                    </div>
                </section>
            </div>
        </div>
    <?php endif;
    endforeach;?>
    
</div>
<?php include_once(ROOT."/views/layouts/footer.php"); ?> 