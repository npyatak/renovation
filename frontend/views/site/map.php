<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use common\models\District;
use common\models\Region;

$this->title = ($type == 'house') ? 'Дома, включенные в программу' : 'Стартовые площадки'. ' 1 этапа реновации.';
?>

<?php $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;onload=app.objectMap.ymapsInit');?>
<?php $this->registerJsFile(Url::toRoute('js/map.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);?>

<div class="renovation blue_top_bg">
    <?=$this->render('_top_block', ['class' => ' white']);?>

    <div class="container_inner">
        <h1 class="purple_text"><span>Карта</span><?=$this->title;?></h1>
        <div class="top_text">
            <p>
                <?=$page->text;?>
            </p>
        </div>
        <div class="select_area">
            Отобразить
            <a class="btn btn-warning <?=$type == 'house' ? 'active' : 'start';?>" href="<?=Url::toRoute(['site/map', 'type' => 'house'])?>">Дома, включенные в программу</a>
            <a class="btn btn-transparent <?=$type != 'house' ? 'active' : '';?>" href="<?=Url::toRoute(['site/map', 'type' => null])?>">Стартовые площадки</a>
        </div>
    </div>

    <div id="object-map" style="width: 100%; height: 500px;"></div>

    <div class="container_inner areas_table <?=$type == 'house' ? 'yellow' : 'blue';?>">
        <div class="title_table"><?=$type == 'house' ? 'Дома' : 'Стартовые площадки';?>, включенные в программу реновации</div>
        <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => [
                    'id' => 'grid_'.$type,
                ],
                'columns' => [
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
                            'name' => \yii\helpers\StringHelper::basename(get_class($searchModel)).'[region_id]',
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
    </div>

    <?php $pm = [];
    if($houses) {
        foreach ($houses as $obj) {
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
</div>

<?php 
$script = $this->render('_map-script', ['pm' => $pm, 'type' => $houses ? 'houses' : 'places']);
$this->registerJs($script, yii\web\View::POS_END);
?>