<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Закон о реновациях';

$this->registerJsFile(Url::toRoute('js/history.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Url::toRoute('uw/stylesheets/history.css'));
?>

<div class="history">
    <?=$this->render('_top_block', ['class' => ' white']);?>
    <div class="history-header">
        <div class="container_inner">
            <h1>Московские пятиэтажки: История вопроса</h1>
            <p>Качество жизни современного человека во многом определяется качеством и комфортностью его жилья.</p>
            <div class="btn-wrap">
                <span class="btn-down"><i class="fa fa-angle-down"></i></span>
            </div>
        </div>
    </div>

    <div class="history-content">
        <?=$this->render('_history_'.$page);?>
    </div>

    <ul class="pagination">
        <li <?=$page == 1 ? 'class="active"' : '';?>><a href="<?=Url::toRoute(['site/history', 'page' => 1]);?>"></a></li>
        <li <?=$page == 2 ? 'class="active"' : '';?>><a href="<?=Url::toRoute(['site/history', 'page' => 2]);?>"></a></li>
    </ul>
</div>