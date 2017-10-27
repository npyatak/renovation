<?php

use yii\helpers\Html;

$this->title = 'Изменить слайд: ' . $model->dateFormatted;
$this->params['breadcrumbs'][] = ['label' => 'История реноваций', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dateFormatted, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
