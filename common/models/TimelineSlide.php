<?php

namespace common\models;

use Yii;

class TimelineSlide extends \yii\db\ActiveRecord
{ 
    const WIDTH_PRESET_NARROW = 1;
    const WIDTH_PRESET_WIDE = 2;

    public $dateFormatted;
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
            [['dateFormatted'], 'required'],
            [['number', 'width_preset'], 'integer'],
            [['text'], 'string'],
        ];
    }

    public function beforeSave($insert) {
        $this->date = strtotime($this->dateFormatted);

        return parent::beforeSave($insert);
    }

    public function afterFind() {
        $this->dateFormatted = date('d.m.Y', $this->date);

        return parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dateFormatted' => 'Дата',
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
