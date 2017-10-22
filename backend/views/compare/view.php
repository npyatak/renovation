<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Хрущевки VS новые дома', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="compare-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'title',
            [
                'attribute' => 'image',
                'value' => function($model) {
                    return $model->image ? Html::img($model->imageUrl, ['width' => '200px']) : '';
                },
                'format' => 'raw',
                'filter' => false,
            ],

            [
                'attribute' => 'new_text',
                'format' => 'raw',
            ],

            [
                'attribute' => 'old_text',
                'format' => 'raw',
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return date('d.m.Y H:i', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
