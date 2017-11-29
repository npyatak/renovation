<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

use common\models\Gallery;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php if($_SERVER['HTTP_HOST'] !== 'renovation.local'):?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KX9ZXT');</script>
    <!-- End Google Tag Manager -->
    <?php endif;?>

</head>
<body>
    <div id="preloader"></div>
    
    <?php $this->beginBody() ?>

    <?php if($_SERVER['HTTP_HOST'] !== 'renovation.local'):?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX9ZXT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php endif;?>

    <div class="wrap">
        <div class="header">
            <a href="/"><img class="logo" src="<?=Url::toRoute('images/logo_new.png');?>" /></a>
            <div class="container_inner">
                <ul class="menu">
                    <?php
                    $menuItems = [
                        ['label' => 'Закон о реновации', 'action' => 'law'],
                        ['label' => 'Карта', 'action' => 'map'],
                        ['label' => 'Даты реализации', 'action' => 'timeline'],
                        ['label' => 'Герои', 'url' => 'http://pyatiehtazhki.tass.ru/?_ga=2.127206541.1082805625.1511712625-56336648.1505299740'],
                        ['label' => 'История вопроса', 'action' => 'history'],
                        ['label' => 'Хрущевки VS новые дома', 'action' => 'compare'],
                    ];
                    foreach ($menuItems as $item):?>
                        <li>
                            <?=Html::a($item['label'], isset($item['action']) ? Url::toRoute('site/'.$item['action']) : $item['url'], [
                                'class' => isset($item['action']) && Yii::$app->controller->action->id === $item['action'] ? 'active' : null,
                                'target' => isset($item['action']) ? null : '_blank'
                            ]);?>
                        </li>
                    <?php endforeach;?>
                </ul>
                <div class="menu-btn">
                    <div class="open-menu-btn show"><span></span><span></span><span></span></div>
                    <div class="close-menu__btn"><span></span><span></span></div>
                </div>
            </div>
            <div class="logo_tass">
                <a href="https://tass.ru/" target="_blank"><img class="tass_logo" src="<?=Url::to('images/Logo_TASS.svg');?>"/></a>
            </div>
        </div>

        <?= $content ?>

        <?php if(!in_array(Yii::$app->controller->action->id, ['index', 'gallery'])):?>
            <?php $galleries = Gallery::find()->all();?>
            <div class="bottom_select_gallery">
            <?php foreach ($galleries as $gal):?>
                <a href="<?=Url::toRoute(['site/gallery', 'id' => $gal->id]);?>" class="select_gallery">
                    <img src="<?=$gal->imageUrl;?>"/>
                </a>
            <?php endforeach;?>
            </div>
        <?php endif;?>

        <?php if(!in_array(Yii::$app->controller->action->id, ['index'])):?>
<!--        <div class="bottom_gallery">-->
<!--            <div class="bottom_gallery_img">-->
<!--                <a href="#" class="bottom_gallery_video"><img src="--><?//=Url::toRoute('images/footer_gallery_img_new.jpg');?><!--"/></a>-->
<!--                <iframe width="100%" height="790" src="https://www.youtube.com/embed/ZStqzGWEBGw" frameborder="0" allowfullscreen></iframe>-->
<!--            </div>-->
<!--        </div>-->
        <div id="footer-video"></div>
        <?php endif;?>

        <div class="footer">
            <div class="text_wrap">
                <p>
                    ТАСС информационное агентство(св-во о регистрации СМИ №03247 выдано 02 апреля 1999 г. Государственным комитетом Российской Федерации по печати)<br/>
                    Отдельные публикации могут содержать информацию, не предназначенную для пользователей до 16 лет.
                </p>

                <p>
                    Подробнее на ТАСС:<br/>
                    http://tass.ru/
                </p>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
