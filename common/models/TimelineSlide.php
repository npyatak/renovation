<?php

namespace common\models;

use Yii;

class TimelineSlide extends \yii\db\ActiveRecord
{ 
    const WIDTH_PRESET_NARROW = 1;
    const WIDTH_PRESET_WIDE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%timeline_slide}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_1', 'date_2'], 'required'],
            [['number', 'width_preset'], 'integer'],
            [['text', 'date_1', 'date_2'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_1' => 'Дата 1',
            'date_2' => 'Дата 2',
            'text' => 'Текст',
            'number' => 'Порядок',
            'width_preset' => 'Ширина',
        ];
    }

    public static function getWidthPresetArray() {
        return [
            self::WIDTH_PRESET_NARROW => 'Узкий',
            self::WIDTH_PRESET_WIDE => 'Широкий'
        ];
    }
}
