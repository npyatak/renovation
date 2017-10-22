<?php

use yii\helpers\Html;

$this->title = 'Добавить сравнение';
$this->params['breadcrumbs'][] = ['label' => 'Хрущевки VS новые дома', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
