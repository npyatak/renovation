<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $text
 * @property string $keywords
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class Page extends \yii\db\ActiveRecord {

    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;

    const IS_PAGE_YES = 1;
    const IS_PAGE_NO = 0;

    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'title'], 'required'],
            [['keywords', 'description'], 'string'],
            [['created_at', 'updated_at', 'status', 'is_page'], 'integer'],
            [['url', 'title'], 'string', 'max' => 255],
            [['text', 'text_additional'], 'safe'],
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'text' => 'Текст',
            'description' => 'Описание',
            'is_page' => 'Отдельная страница',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
            'status' => 'Статус',
            'text_additional' => 'Дополнительный текст',
        ];
    }

    public static function findByUrl($url) {
        return self::findOne(['url'=>$url]);
    }

    public function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивна',
            self::STATUS_ACTIVE => 'Активна',
        ];
    }

    public function getIsPageArray() {
        return [
            self::IS_PAGE_YES => 'Да',
            self::IS_PAGE_NO => 'Нет',
        ];
    }
}
