<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$url = Url::canonical();
$imageUrl = Url::toRoute(['images/items/share.png'], true);
$title = 'Nokia 8: покажи свою историю с обеих сторон';
$desc = 'Создай свое бози и выиграй Nokia 8 #fridaybothie #бозинапятнице #bothie';

$this->title = 'Закон о реновациях';

$this->registerJsFile(Url::toRoute('js/history.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/history.css'));
?>

<div class="history">
    <?=$this->render('_top_block', ['class' => ' white']);?>
    <div class="history-header">
        <div class="container_inner">
            <h1>Московские пятиэтажки: История вопроса</h1>
            <p>Зачем Советскому Союзу нужны были «хрущевки», какие серии строились в разные периоды «индустриального домостроения», чем они отличались друг от друга.</p>
            <div class="btn-wrap">
                <span class="btn-down"><i class="fa fa-angle-down"></i></span>
            </div>
            <div class="social-wrap">
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
        </div>
    </div>

    <div class="history-content">
        <?=$this->render('_history_'.$page);?>
    </div>

    <ul class="pagination">
        <li <?=$page == 1 ? 'class="active"' : '';?>><a href="<?=Url::toRoute(['site/history', 'page' => 1]);?>">1</a></li>
        <li <?=$page == 2 ? 'class="active"' : '';?>><a href="<?=Url::toRoute(['site/history', 'page' => 2]);?>">2</a></li>
    </ul>
</div>