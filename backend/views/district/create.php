<?php

use yii\helpers\Html;

$this->title = 'Добавить округ';
$this->params['breadcrumbs'][] = ['label' => 'Округа', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
