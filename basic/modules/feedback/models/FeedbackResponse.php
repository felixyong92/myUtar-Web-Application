<?php

namespace app\modules\feedback\models;

use Yii;
use app\models\Department;
/**
 * This is the model class for table "feedback_response".
 *
 * @property string $frId
 * @property string $fResponse
 * @property string $frDateTime
 * @property string $fId
 * @property string $dId
 *
 * @property Department $d
 * @property Feedback $f
 */
class FeedbackResponse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback_response';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fResponse', 'fId', 'dId'], 'required'],
            [['fResponse'], 'string'],
            [['frDateTime'], 'safe'],
            [['fId'], 'integer'],
            [['dId'], 'string', 'max' => 20],
            [['dId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dId' => 'dId']],
            [['fId'], 'exist', 'skipOnError' => true, 'targetClass' => Feedback::className(), 'targetAttribute' => ['fId' => 'fId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frId' => 'Fr ID',
            'fResponse' => 'Feedback Response',
            'frDateTime' => 'Fr Date Time',
            'fId' => 'F ID',
            'dId' => 'D ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getD()
    {
        return $this->hasOne(Department::className(), ['dId' => 'dId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getF()
    {
        return $this->hasOne(Feedback::className(), ['fId' => 'fId']);
    }
}
