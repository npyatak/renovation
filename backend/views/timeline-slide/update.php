<?php

use yii\helpers\Html;

$this->title = 'Изменить слайд: ' . $model->date_1.' '.$model->date_2;
$this->params['breadcrumbs'][] = ['label' => 'История реноваций', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date_1.' '.$model->date_2, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
