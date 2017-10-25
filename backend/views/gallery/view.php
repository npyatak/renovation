<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = $gallery->title;
$this->params['breadcrumbs'][] = ['label' => 'Галереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить слайд', ['create-slide', 'gId' => $gallery->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'number',
                'title',
                [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->imageUrl, ['width' => '200px']);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update-slide} {delete-slide}',
                    'buttons' => [
                        'update-slide' => function ($url, $model) use($gallery) {
                            $url = Url::toRoute(['/gallery/update-slide', 'gId' => $gallery->id, 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                'title' => 'Обновить',
                            ]);
                        },
                        'delete-slide' => function ($url, $model) use($gallery) {
                            $url = Url::toRoute(['/gallery/delete-slide', 'gId' => $gallery->id, 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => 'Удалить',
                                'data-confirm' => 'Удалить?',
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
