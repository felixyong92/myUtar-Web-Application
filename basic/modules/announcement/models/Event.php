<?php

namespace app\modules\announcement\models;

use Yii;
use app\models\Department;
/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $description
 * @property string $publishDate
 * @property string $image
 * @property string $attachment
 * @property string $expiryDate
 * @property string $dId
 *
 * @property Department $d
 */
class Event extends \yii\db\ActiveRecord
{

    public $images_Temp;
    public $attachments_Temp;

    public function getExpired(){
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentDate = date("Y-m-d");

        if($currentDate > $this->expiryDate){
            return 0;
        }else if($currentDate == $this->expiryDate){
            return 1;
        }else if($currentDate < $this->expiryDate){
            return 2;
        }
    }

    public function getExpiredText(){

        if($this->expired==0)
            return 'Archived';
        else if($this->expired==1)
            return 'Today';
        else if($this->expired==2)
            return 'Upcoming';
    }

    public function getTypes() {
            return array(
                    'Competition' => 'Competition',
                    'Talk' => 'Talk',
                    'Seminar/Course/Workshop' => 'Seminar/Course/Workshop',
                    'Campaign/Festival' => 'Campaign/Festival',
                    'Others' => 'Others',


            );
    }
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'expiryDate', 'dId'], 'required'],
            [['description'], 'string'],
            [['publishDate', 'expiryDate'], 'safe'],
            [['title', 'type'], 'string', 'max' => 200],
            [['image', 'attachment'], 'string', 'max' => 1000],
            [['dId'], 'string', 'max' => 20],
            [['dId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dId' => 'dId']],
            [['images_Temp', 'attachments_Temp'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'description' => 'Description',
            'publishDate' => 'Publish Date',
            'image' => 'Image',
            'attachment' => 'Attachment',
            'expiryDate' => 'Expiry Date',
            'dId' => 'Department',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['dId' => 'dId']);
    }
}
