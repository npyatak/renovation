<?php

namespace common\models;

use Yii;
use vitalik74\geocode\Geocode;

/**
 * This is the model class for table "{{%house}}".
 *
 * @property integer $id
 * @property integer $district_id
 * @property integer $region_id
 * @property string $address
 * @property string $lat
 * @property string $lng
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property District $district
 * @property Region $region
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%house}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id', 'region_id'], 'required'],
            [['district_id', 'region_id', 'created_at', 'updated_at'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['address'], 'string', 'max' => 255],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        if(!$this->lat && !$this->lng) {
            $coords = self::parseCoords($this->region->name, $this->address);

            $this->lat = $coords['lat'];
            $this->lng = $coords['lng'];

            $this->save(false, ['lat', 'lng']);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_id' => 'Округ',
            'region_id' => 'Район',
            'address' => 'Адрес',
            'lat' => 'Широта',
            'lng' => 'Долгота',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public static function parseCoords($region, $address) {
        $geo = new Geocode;

        $data = $geo->get('Москва, '.$region.', '.$address, ['kind' => 'house']);
        
        if($data && isset($data['response']['GeoObjectCollection']['featureMember'][0])) {
            $exp = explode(' ', ($data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']));

            $lat = $exp[1];
            $lng = $exp[0];

            return ['lat' => $lat, 'lng' => $lng];
        }
    }
}
