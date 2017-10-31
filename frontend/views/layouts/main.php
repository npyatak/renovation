<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

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
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="header">
        <img class="logo" src="<?=Url::toRoute('images/logo.png');?>" />
        <div class="container_inner">
            <a class="map_link" href="#">Карта</a>
            <ul class="menu">
                <?php
                $menuItems = [
                    ['label' => 'Закон о реновациях', 'action' => 'law'],
                    ['label' => 'Карта', 'action' => 'map'],
                    ['label' => 'Даты реализации', 'action' => 'timeline'],
                    ['label' => 'Герои', 'url' => 'http://pyatiehtazhki.tass.ru/'],
                    ['label' => 'История реноваций', 'action' => 'history'],
                    ['label' => 'Хрущевки VS новые дома', 'action' => 'compare'],
                ];
                foreach ($menuItems as $item):?>
                    <li>
                        <?=Html::a($item['label'], isset($item['action']) ? Url::toRoute('site/'.$item['action']) : $item['url'], [
                            'class' => isset($item['action']) && Yii::$app->controller->action->id === $item['action'] ? 'active' : '',
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
    </div>

    <?= $content ?>

    <div class="bottom_gallery">
        <div class="title_bottom_gallery">Социальные обязательства: детские площадки, садики, школы и поликлиники</div>
        <div class="bottom_gallery_img">
            <a href="#" class="bottom_gallery_video"><img src="<?=Url::toRoute('images/footer_gallery_img.jpg');?>"/></a>
            <iframe width="100%" height="790" src="https://www.youtube.com/embed/ZStqzGWEBGw" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

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
