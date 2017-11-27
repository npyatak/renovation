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
        <div class="container_inner">
            <ul class="urls">
                <li><a href="">Кризис на рынке жилья</a></li>
                <li><a href="">Хрущевки</a></li>
                <li><a href="">"Брежневки"</a></li>
                <li><a href="">Лужковская программа</a></li>
                <li><a href="">Конец первой волны</a></li>
            </ul>
            <div class="history-text">
                <div class="h-t_top">
                    <p>Даже в последние – постсоветские – годы, когда частная собственность и личное пространство перестали быть привилегией, представители старшего поколения вспоминают, как ютились на квадратных метрах коммунальных комнат, стояли в очереди в ванную или к газовой конфорке, становились невольными свидетелями соседских внутрисемейных разборок.</p>
                    <p><strong>В 50-х годах прошлого столетия</strong> власти приняли решение менять ситуацию на рынке жилья и развивать типовое строительство. Тогда же появилась первая хрущевка. Жилье, которое возводилось по типовым проектам, обходилось дешевле и строилось быстрее. Это позволило быстро расселить коммунальные квартиры, в которых на тот момент жили 70% москвичей, обеспечить жильем переселенцев из сел и деревень, а также обитателей временных строений.</p>
                </div>
            </div>
        </div>
    </div>
</div>