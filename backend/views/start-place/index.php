<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\District;
use common\models\Region;

$this->title = 'Стартовые площадки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить стартовую площадку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                [
                    'attribute' => 'district_id',
                    'value' => function($data) {
                        return $data->district->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'district_id', ArrayHelper::map(District::find()->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'region_id',
                    'value' => function($data) {
                        return $data->region->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'region_id', ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['prompt'=>'']),
                ],
                'address',
                'new_address',
                'lat',
                'lng',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
