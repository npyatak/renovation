<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

use common\models\District;
use common\models\Region;;
?>

<div class="start_place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(District::find()->all(), 'id', 'name'), ['id'=>'district-id', 'prompt' => 'Выберите...']) ?>

    <?=$form->field($model, 'region_id')->widget(DepDrop::classname(), [
        'data' => $model->district_id ? ArrayHelper::map(Region::find()->all(), 'id', 'name') : [],
		'pluginOptions'=>[
			'depends'=>['district-id'],
			'placeholder' => 'Выберите...',
			'url' => Url::toRoute(['/site/regions'])
		]
	]);?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_address')->textInput(['maxlength' => true]) ?>

    <a href="" id="get-coords" class="btn btn-primary">Обновить координаты</a>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = "
    $('#get-coords').click(function() {
        if(!$('#start_place-address').val()) {
            alert('Необходимо заполнить адрес');
        } else if(!$('#start_place-region_id').find(':selected').val()) {
            alert('Необходимо выбрать район');
        } else {
            $.ajax({
                type: 'GET',
                url: '/site/get-coords',
                data: 'region='+$('#start_place-region_id').find(':selected').val()+'&address='+$('#start_place-address').val(),
                success: function (data) {
                    data = eval('(' + data + ')');
                    console.log(data);
                    $('#start_place-lat').val(data.lat);
                    $('#start_place-lng').val(data.lng);
                }
            });
        }

        return false;
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>