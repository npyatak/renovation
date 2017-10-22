<?php

use yii\helpers\Html;

$this->title = 'Изменить сравнение: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Хрущевки VS новые дома', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
