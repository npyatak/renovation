<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
?>

<div class="add-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => false,
                'wrapper' => 'form-container',
            ],
        ]
    ]);?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_page')->dropDownList($model->isPageArray, ['class'=>'']) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',
        [
            'preset' => 'full',
            'allowedContent' => true,
        ]),
    ]);
    ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->statusArray, ['class'=>'']) ?>

    <div class="add-form-buttons">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn green-btn save-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
