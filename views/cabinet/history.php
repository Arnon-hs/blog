<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="content">
        <div class="pure-g">       
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/cabinet/">Кабинет</a></li>
                    <li class="active">Просмотр постов</li>
                </ol>
            </div>

            <div class="pure-u-1-1 title-page">
                <h2>История публикаций</h2>
            </div>
            <? foreach($blogItems as $item):?>
                <div class="pure-u-1-1">
                    <div class="post">
                        <div class="title-post content-subhead">
                            <span>
                                <?php echo $item{'label'};?>
                            </span>
                            <a href="/cabinet/redact/<?= $item{'_id'}?>">Редактировать</a>
                        </div>
                        <section class="post">
                            <div class="post-description">
                                <p> <?php echo $item{'text'};?></p>
                            </div>
                        </section>
                    </div>
                </div>
            <? endforeach;?>
        </div>
    </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>

