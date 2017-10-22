<?php

use yii\helpers\Html;

$this->title = 'Изменить стартовую площадку: ' . $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Стартовые площадки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->address, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
