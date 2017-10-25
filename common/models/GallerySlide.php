<?php

namespace common\models;

use Yii;

class GallerySlide extends \yii\db\ActiveRecord
{ 

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gallery_slide}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'gallery_id'], 'required'],
            [['number', 'gallery_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
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
            'title' => 'Заголовок',
            'image' => 'Изображение',
            'number' => 'Порядок',
            'gallery_id' => 'Галерея',
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
        return __DIR__ . '/../../frontend/web/uploads/gallery/';
    }

    public function getImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/gallery/'.$this->image);
    }
}
