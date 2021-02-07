<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "addresses".
 *
 * @property int $id
 * @property int $client_id
 * @property string $zip_code
 * @property string $country
 * @property string $city
 * @property string $street
 * @property string $house_number
 * @property string|null $office_number
 *
 * @property Clients $client
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'zip_code', 'country', 'city', 'street', 'house_number'], 'required'],
            [['client_id'], 'integer'],
            [['zip_code', 'house_number', 'office_number'], 'string', 'max' => 10],
            [['country'], 'string', 'max' => 2],
            [['city', 'street'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'zip_code' => 'Zip Code',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'house_number' => 'House Number',
            'office_number' => 'Office Number',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }
}
