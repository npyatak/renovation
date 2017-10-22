<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Дома', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-view">

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
            'address',
            [
                'attribute' => 'district_id',
                'value' => function($data) {
                    return $data->district->name;
                },
            ],
            [
                'attribute' => 'region_id',
                'value' => function($data) {
                    return $data->region->name;
                },
            ],
            'lat',
            'lng',
        ],
    ]) ?>

</div>
