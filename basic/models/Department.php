<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $dId
 * @property string $dName
 * @property string $dEmail
 *
 * @property BusService[] $busServices
 * @property DepartmentStaff[] $departmentStaff
 * @property Event[] $events
 * @property Healthcare[] $healthcares
 * @property Notification $notification
 * @property Safety[] $safeties
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dId', 'dName', 'dEmail'], 'required'],
            [['dId'], 'string', 'max' => 20],
            [['dName'], 'string', 'max' => 255],
            [['dEmail'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dId' => 'D ID',
            'dName' => 'D Name',
            'dEmail' => 'D Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusServices()
    {
        return $this->hasMany(BusService::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentStaff()
    {
        return $this->hasMany(DepartmentStaff::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHealthcares()
    {
        return $this->hasMany(Healthcare::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotification()
    {
        return $this->hasOne(Notification::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSafeties()
    {
        return $this->hasMany(Safety::className(), ['dId' => 'dId']);
    }
}
