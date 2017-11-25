<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%compare}}".
 *
 * @property integer $id
 * @property integer $number
 * @property string $title
 * @property string $image
 * @property string $new_text
 * @property string $old_text
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Compare extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;
    
    public $imageFile;
    public $imageFileOld;
    public $imageFileNew;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%compare}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'status'], 'required'],
            [['number', 'status', 'created_at', 'updated_at'], 'integer'],
            [['new_text', 'old_text'], 'string'],
            [['title', 'image', 'image_old', 'image_new'], 'string', 'max' => 255],
            [['imageFile', 'imageFileOld', 'imageFileNew'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    public function afterDelete() {
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->image) && is_file($path.$this->image)) {
            unlink($path.$this->image);
        }
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->image_old) && is_file($path.$this->image_old)) {
            unlink($path.$this->image_old);
        }
        $path = $this->imageSrcPath;
        if(file_exists($path.$this->image_new) && is_file($path.$this->image_new)) {
            unlink($path.$this->image_new);
        }
        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Порядковый номер',
            'title' => 'Заголовок',
            'imageFile' => 'Изображение',
            'imageFileNew' => 'Изображение новостройки',
            'imageFileOldld' => 'Изображение хрущевки',
            'new_text' => 'Текст про новостройки',
            'old_text' => 'Текст про хрущевки',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/compare/';
    }

    public function getImageUrl() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/compare/'.$this->image);
    }

    public function getImageUrlOld() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/compare/'.$this->image_old);
    }

    public function getImageUrlNew() {
        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl('/uploads/compare/'.$this->image_new);
    }

    public function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивна',
            self::STATUS_ACTIVE => 'Активна',
        ];
    }
}
