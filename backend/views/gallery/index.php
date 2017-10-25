<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
