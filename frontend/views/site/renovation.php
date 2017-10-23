<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use common\models\District;
use common\models\Region;

$this->title = 'Реновация';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;onload=app.objectMap.ymapsInit');?>
<?php $this->registerJsFile('/js/map.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<?=$page->text;?>

<div>
    Отобразить
    <?=Html::a('Дома, включенные в программу', Url::toRoute(['site/renovation', 'type' => 'house']), ['class' => 'btn btn-primary']);?>
    <?=Html::a('Страртовые площадки', Url::toRoute(['site/renovation']), ['class' => 'btn btn-primary']);?>
</div>

<div class="" id="object-map" style="width: 100%; height: 500px;"></div>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'district_id',
                'value' => function($data) {
                    return $data->district->name;
                },
                'filter' => Html::activeDropDownList($searchModel, 'district_id', ArrayHelper::map(District::find()->all(), 'id', 'name'), ['prompt' => '', 'id' => 'district_id']),
            ],
            [
                'attribute' => 'region_id',
                'value' => function($data) {
                    return $data->region->name;
                },
                'filter' => DepDrop::widget([
                    'name' => '\yii\helpers\StringHelper::basename(get_class($searchModel))[region_id]',
                    'value' => $searchModel->attributes['region_id'],
                    'data' => [null => 'Выберите...'] + ($searchModel->attributes['district_id'] ? ArrayHelper::map(Region::find()->where(['district_id' => $searchModel->attributes['district_id']])->all(), 'id', 'name') : $regionArr),
                    'pluginOptions' => [
                        'depends' => ['district_id'],
                        'placeholder' => 'Выберите...',
                        'url' => Url::toRoute(['/site/regions'])
                    ],
                ]),
            ],
            'address',
        ],
    ]); ?>
<?php Pjax::end(); ?>

<?php $pm = [];
if($houses) {
    foreach ($houses as $obj) {
        /* Содержимое балунов. Тут надо использовать по минимуму html потому что этих объектов больше 5 тысяч*/
        $content = '<div id="obj_'.$obj['id'].'" class="bln"><p>'.$districtsArr[$obj['district_id']].'</p><p>'.$regionArr[$obj['region_id']].'</p><p>'.$obj['address'].'</p></div>';

        $pm[] = "{
            coords: [".$obj['lat'].", ".$obj['lng']."],
            type: 'H',
            content: '".$content."'
        }";
    }
} elseif($startPlaces) {
    foreach ($startPlaces as $obj) {
        $content = '<div id="obj_'.$obj['id'].'" class="bln"><p>'.$districtsArr[$obj['district_id']].'</p><p>'.$regionArr[$obj['region_id']].'</p><p>'.$obj['address'].'</p></div>';

        $pm[] = "{
            coords: [".$obj['lat'].", ".$obj['lng']."],
            type: 'SP',
            content: '".$content."'
        }";
    }
} ?>

<script>
    window.mapsImagesPath = '/images/';
    window.objectPlacemarks = [
        <?=implode(',', $pm);?>
    ];
</script>

<?php 
$script = $this->render('_map-script');
$this->registerJs($script, yii\web\View::POS_END);
?>
