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
<?php $this->registerJsFile(Url::toRoute('js/map.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);?>
<div class="renovation">
    <div class="container_inner top_block">
        <img class="tass_logo" src="<?=Url::to('images/tass_logo.png');?>"/>
        <a class="go_front" href="/">На главную</a>
        <div class="social">
            <a class="fb" href="#"></a>
            <a class="vk" href="#"></a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="container_inner">
        <h1>Стартовые площадки 1 этапа реновации. Карта</h1>
        <div class="top_text">
            <p>
                1 августа Сергей Собянин утвердил программу реновации. Вместо квартир в ветхих пятиэтажках москвичи получат жилье в новых монолитных и панельных домах.<br>
                26 сентября опубликован список стартовых площадок программы реновации. При выборе учитывалось мнение москвичей и дальнейшее осуществление квартальной застройки.
            </p>
            <!--
            <?=$page->text;?>
            -->
        </div>
        <div class="select_area">
            Отобразить
            <?=Html::a('Дома, включенные в программу', Url::toRoute(['site/renovation', 'type' => 'house']), ['class' => 'btn btn-primary include']);?>
            <?=Html::a('Страртовые площадки', Url::toRoute(['site/renovation']), ['class' => 'btn btn-primary start']);?>
        </div>
    </div>


    <div class="" id="object-map" style="width: 100%; height: 500px;"></div>

    <div class="container_inner areas_table">
        <div class="title_table">Дома, включенные в программу реновации</div>
        <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
</div>