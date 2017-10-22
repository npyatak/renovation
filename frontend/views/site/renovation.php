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

<?php $this->registerJsFile('/js/map-options.js', ['depends' => [\yii\web\JqueryAsset::className()]]);?>
<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;onload=app.houseMap.ymapsInit');?>

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
if($houses):?>
    <?php foreach ($houses as $obj):?>
        <?php /* Содержимое балунов. Тут надо использовать по минимуму html потому что этих объектов больше 5 тысяч*/ ?>
        <div id="obj_<?=$obj['id'];?>" style="display: none">
            <p><?=$regionArr[$obj['region_id']];?></p>
            <p><?=$districtsArr[$obj['district_id']];?></p>
            <p><?=$obj['address'];?></p>
        </div>

        <?php $pm[] = "{
            coords: [".$obj['lat'].", ".$obj['lng']."],
            type: 'type_house',
            content: document.getElementById('obj_".$obj['id']."').innerHTML
        }";?>
    <?php endforeach;?>

    <script>
        window.mapsImagesPath = '/images/';
        window.objectPlacemarks = [
            <?=implode(',', $pm);?>
        ];
    </script>

<?php elseif($startPlaces):?>
    <?php foreach ($startPlaces as $obj):?>
        <?php /* Содержимое балунов. Тут надо использовать по минимуму html потому что этих объектов больше 5 тысяч*/ ?>
        <div id="obj_<?=$obj['id'];?>" style="display: none">
            <p><?=$regionArr[$obj['region_id']];?></p>
            <p><?=$districtsArr[$obj['district_id']];?></p>
            <p><?=$obj['address'];?></p>
        </div>

        <?php $pm[] = "{
            coords: [".$obj['lat'].", ".$obj['lng']."],
            type: 'type_start_place',
            content: document.getElementById('obj_".$obj['id']."').innerHTML
        }";?>
    <?php endforeach;?>

    <script>
        window.mapsImagesPath = '/images/';
        window.objectPlacemarks = [
            <?=implode(',', $pm);?>
        ];
    </script>
<?php endif;?>

<?php 
$script = $this->render('_map-script');
$this->registerJs($script, yii\web\View::POS_END);
?>
