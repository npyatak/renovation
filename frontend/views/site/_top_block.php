<?php
use yii\helpers\Url;
use yii\helpers\Html;

$url = Url::canonical();
$imageUrl = Url::toRoute(['images/items/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$desc = 'Создай свое бози и выиграй Nokia 8 #fridaybothie #бозинапятнице #bothie';

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $imageUrl], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
$this->registerMetaTag(['property' => 'fb:app_id', 'content' => '1704949819546160'], 'fb:app_id');
?>

<div class="container_inner top_block<?=isset($class) ? $class : '';?>">
    <img class="tass_logo" src="<?=Url::to('images/Logo_TASS.svg');?>"/>

    <?php if(Yii::$app->controller->action->id !== 'index'):?>
    <a class="go_front" href="/"><i class="fa fa-angle-left" aria-hidden="true"></i>На главную</a>
    <?php endif;?>

    <div class="social white">
        <?=Html::a('<i class="fa fa-facebook"></i>', '', [
            'data-type' => 'fb',
            'data-url' => $url,
            'data-title' => $title,
            'data-image' => $imageUrl,
            'data-desc' => $desc,
        ]);?>
        <?=Html::a('<i class="fa fa-vk"></i>', '', [
            'data-type' => 'vk',
            'data-url' => $url,
            'data-title' => $title,
            'data-image' => $imageUrl,
            'data-desc' => $desc,
        ]);?>
        <?=Html::a('<i class="fa fa-twitter"></i>', '', [
            'data-type' => 'tw',
            'data-url' => $url,
            'data-title' => $title,
        ]);?>
        <?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
            'data-type' => 'ok',
            'data-url' => $url,
            'data-desc' => $desc,
        ]);?>
    </div>
    <div class="clear"></div>
</div>