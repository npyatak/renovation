<?php

use yii\helpers\Html;

$this->title = 'Изменить слайд '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Галереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $gallery->title, 'url' => ['view', 'id' => $gallery->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-slide', [
        'model' => $model,
    ]) ?>

</div>
