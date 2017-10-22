<?php

use yii\helpers\Html;

$this->title = 'Изменить страницу' .': '. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div class="page-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
	    'model' => $model,
	]) ?>
</div>