<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $gender
 * @property string $login
 * @property string $password
 * @property string $created_at
 *
 * @property Addresses[] $addresses
 */
class Clients extends \yii\db\ActiveRecord
{
    const GENDERS = [
        'No Information',
        'Male',
        'Female',
    ];

    public $passport_confirm;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'login', 'password', 'passport_confirm', 'gender'], 'required'],
            [['gender'], 'integer'],
            [['created_at'], 'safe'],
            [['first_name', 'last_name', 'email', 'login', 'password'], 'string', 'max' => 255],
            ['login', 'string', 'min' => 4],
            ['password', 'string', 'min' => 6],
            ['login', 'unique'],
            ['email', 'email'],
            ['passport_confirm', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Passwords don't match"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'login' => 'Login',
            'password' => 'Password',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Addresses::className(), ['client_id' => 'id']);
    }
}
