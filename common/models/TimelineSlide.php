<?php

namespace common\models;

use Yii;

class TimelineSlide extends \yii\db\ActiveRecord
{ 
    const WIDTH_PRESET_NARROW = 1;
    const WIDTH_PRESET_WIDE = 2;

    public $imageFile;

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
            [['date_1', 'date_2', 'imageFile'], 'required'],
            [['number', 'width_preset'], 'integer'],
            [['text', 'date_1', 'date_2'], 'string'],
            [['imageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
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
            'imageFile' => 'Изображение',
        ];
    }

    public function afterDelete() {
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->image) && is_file($path.$this->image)) {
            unlink($path.$this->image);
        }
        return parent::afterDelete();
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/timeline/';
    }

    public function getImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/timeline/'.$this->image);
    }

    public static function getWidthPresetArray() {
        return [
            self::WIDTH_PRESET_NARROW => 'Узкий',
            self::WIDTH_PRESET_WIDE => 'Широкий'
        ];
    }
}
