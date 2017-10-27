<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

use common\models\TimelineSlide;
?>

<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dateFormatted')->widget(
        DatePicker::className()
    );?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',
        [
            'preset' => 'full',
            'allowedContent' => true,
        ]),
    ]);
    ?>

    <?= $form->field($model, 'width_preset')->dropDownList(TimelineSlide::getWidthPresetArray()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
